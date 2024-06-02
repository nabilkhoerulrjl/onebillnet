<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillCustomer_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library('Xendit_api');
        $this->load->model('Bill_Model');
        $this->load->model('FileModel');
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Login_Controller/index"));
		}
	}

	public function index()
	{
        $endDate = new DateTime();
        // Mengurangi interval 2 bulan dari startDate untuk mendapatkan endDate
        $startDate = clone $endDate;
        $startDate->modify('-2 months');
        // Format tanggal sesuai yang diinginkan
        $formattedStartDate = $startDate->format('Y-m-d H:i:s');
        $formattedEndDate = $endDate->format('Y-m-d H:i:s');
        $page = 1;
        $requestData = array(
            'startDate' => $formattedStartDate,
            'endDate' => $formattedEndDate,
            'page' => $page
        );
        $data['idTabMenu'] = 'billCustomer255';
        $data['dataBill']  = $this->getData($requestData);
        $data['totalPage']  = $this->getTotalPageBill($formattedStartDate,$formattedEndDate);
        $data['currentPage'] = $page;
        $this->load->view('customer/billCustomer/index',$data);
	}

    public function createBillInv()
    {
        //Get Data from ajax
        $periode = $this->input->post('Periode');
        $customerIdArr = $this->input->post('CustomerId');
        
        $resultCustomerId = '';
        $timeDueDate = '23:59:59';
        // Get data duedate bill
        $getDueDate = $this->getDueDateInvSet();
        $getPrefixInv = $this->getPrefixInv();
        $siteId = $this->getSiteId();

        // Gabungkan periode dengan tanggal due date
        $periodeBill = $periode.'-'.$getDueDate;
        // Check apakah customer id array?
        $customerId = $customerIdArr;
        // if (is_array($customerIdArr)) {
        //     $customerId = implode(',', $customerIdArr);
        // }
        if (is_string($customerIdArr)) {
            // Jika iya, ubah string menjadi array
            $customerId = $this->convertStringToArray($customerIdArr);
        }
        // Check Data customer yang akan di insert sudah tersedia atau belum?
        $isHasBill = $this->checkBill($customerId,$periodeBill);
        //Jika yaa return error
        if($isHasBill == true){
            echo json_encode(array('status' => 'info', 'message' => 'Data Invoice and bill sudah di generated sebelumnya!.'));
            return;
        }
        // Jika tidak lanjut insert
        // Gabungkan periode, tanggal, dan waktu
        $dateTimePeriode = date('Y-m-d H:i:s', strtotime("$periode-$getDueDate $timeDueDate"));
        $dateTimeDueDate = date("Y-m-d H:i:s", strtotime("+1 month", strtotime($dateTimePeriode)));; 
        $formatPeriodeDesc = date("j F Y", strtotime("$periode-$getDueDate"));
        // Persiapkan data
        // Get Data Customer by Id
        $customerData   = $this->getCustomer($customerId);
        $userId         = $this->getUserId();
        $siteId         = $this->getSiteId();
        $arrInvoiceData = array();
        $arrBillId      = array();
        $arrInvoicePdfData      = array();
        foreach($customerData AS $data) 
        {
            $tax = (11 / 100) * $data->Price;
            $totalPrice = $data->Price+$tax;
            // Mapping Data Customer for paymentlink
            $customer = array(
                'GivenNames' => $data->GivenName,
                'Surname'   => $data->SurName,
                'MobileNumber' => $data->MobileNumber
            );
            if (!empty($data->email)) {
                $customer['Email'] = $data->email;
            }

            // Mapping data PaymentMethods
            // Mapping data items
            $items = array(
                "name" => $data->ProductName,
                "quantity" => 1,
                "price" => $data->Price,
                "category" => "Internet Service Provider",
            );

            $fees = array(
                "type"=> "TAX",
                "value"=> $tax,
            );

            // Mapping data untuk create invoice PaymentLink
            // INV-{{Prefix Invoice}}-{{tanggal invoice dibuat}}-{{ProductId}}{{random Angka}}
            $invoiceData = [];
            $randomNumber = $this->ramdomId();
            $descriptions = $data->ProductName.' Periode '.$formatPeriodeDesc;
            $invoiceData = array(
                'external_id' => 'INV-'.$getPrefixInv.'-'.date("Ymd").'-'.$data->ProductId.$randomNumber,
                'amount' => floor($totalPrice), 
                'description' => $descriptions,
                'customer' => $customer,
                'currency' => 'IDR',
                'invoice_duration' => '432000',
                'payment_methods' => ["CREDIT_CARD", "BCA", "BNI", "BSI", "BRI", 
                "MANDIRI", "PERMATA", "SAHABAT_SAMPOERNA", "BNC", "ALFAMART", "INDOMARET", 
                "OVO", "DANA", "SHOPEEPAY", "LINKAJA", "JENIUSPAY", "DD_BRI", "DD_BCA_KLIKPAY",
                    "KREDIVO", "AKULAKU", "UANGME", "ATOME", "QRIS"],
                "items" => [$items],
                "fees" => [$fees],
            );
            // 
            if (!empty($data->email)) {
                $invoiceData['payer_email'] = $data->email;
            }   
            
            $responeInvoice = $this->generatePaymentLink($invoiceData);
            // var_dump($responeInvoice);
            // foreach ($responeInvoice as $invoice) {
            $billDueDate = date('j F Y', strtotime("$periode-$getDueDate $timeDueDate"));
            
            $arrInvoiceData[] = $invoiceData;

            $email = $data->Email;
            if($data->Email == ''){
                $email = '-';
            }

            foreach($responeInvoice as $item){
                // Mapping Data Respone JSON untuk di insert
                // Create new PDF document
                $mappingJSON = array(
                    'Id'            => $item->id,
                    'InvoiceId'    => $item->external_id,
                    'Status'        => $item->status,
                    'ExpiryDate'    => $item->expiry_date,
                    'MerchantName'  => $item->merchant_name,
                    'PaymentUrl'    => $item->invoice_url,
                    'InvoiceUrl'    => 'https://'.$_SERVER['SERVER_NAME'].'/BillController/getInvoicePdf/'.$item->id,
                );
                $contentText = json_encode($mappingJSON);
                
                // Mapping Data Bill untuk insert ke table bill
                $billData = array(
                    'CustomerId' => $data->Id,
                    'SiteId' => $siteId,
                    'ProductId' => $data->ProductId, 
                    'Product' => $data->ProductName, 
                    'Description' => $data->Description, 
                    'Amount' => $data->Price, 
                    'Periode' => $periodeBill, 
                    'DueDate' => $dateTimeDueDate,
                    'StatusId' => 'BLS2',
                    'PaymentDate' => null,
                    'PaymentLink' => $item->invoice_url,
                    'InvoiceId' => $item->external_id,
                    'ReferenceId' => $item->id,
                    'ExpiryDate' => $item->expiry_date, 
                    'ContentText' => $contentText, 
                    'InvoiceLink' => 'https://'.$_SERVER['SERVER_NAME'].'/BillController/getInvoicePdf/'.$item->id,
                    'Creator' => $userId,
                    'CreateDate' => date('Y-m-d H:i:s'),
                    'Modifier' => $userId,
                    'ModifyDate' => date('Y-m-d H:i:s')
                );
                // Save Data Bill
                // $newBillId='';
                $newBillId = $this->Bill_Model->createBill($billData);
                $arrBillId[] = $newBillId;
                // var_dump($newBillId);
            }
            // $arrInvoicePdfData[] = $invoicePdfData;
        }
        // Berikan respons berdasarkan hasil update keseluruhan
        if (count($arrBillId) == 0) {
            echo json_encode(array('status' => 'error', 'message' => 'Failed to update data.'));
        } else {
            echo json_encode(array('status' => 'success', 'message' => 'All data updated successfully.'));
        }
    }

    public function getCustomer($customerId) {
        
        $siteId = $this->getSiteId();
        $select = 'c.Id as Id, c.FirstName AS GivenName, 
        c.LastName AS SurName, c.Whatsapp AS MobileNumber, 
        c.Email, c.Address, p.Id AS ProductId, 
        p.Name AS ProductName, p.Description AS Description, p.Amount AS Price';
        $join   = ['Product AS p', 'c.ProductId = p.Id', 'left'];
        $where  = array(
            'customerId' => $customerId,
            'siteId' => $siteId,
            'statusId' => 'CRS5'
        );
        $dataCustomer = $this->Customer_Model->getCustomer($select, $join, $where);

        return $dataCustomer;
    }

    public function getData($requestData) {
        $startDate = $requestData['startDate'];
        $endDate = $requestData['endDate'];
        $page = $requestData['page'];
        if(is_array($page)){
            $page = intval($page);
        }

        $limit = 20;
        $offset = abs(($page - 1) * $limit);
        // var_dump($offset);
        // die();
        $siteId = $this->getSiteId();
        $select = 'b.ReferenceId, b.InvoiceId AS InvoiceId,
        c.FirstName AS FirstName, c.LastName AS LastName,
        b.Product AS ProductName, b.Periode,
        b.DueDate, b.Amount, b.StatusId,
        b.PaymentLink, b.ExpiryDate';
        $join1   = ['Customer AS c', 'b.CustomerId = c.Id', 'left'];
        $arrJoin = array(
            'join1' => $join1
        );
        $arrWhere = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'siteId' => $siteId,
        );
        // $where  = $siteId;
        $data = $this->Bill_Model->getBillCustomer($select, $arrJoin, $arrWhere, $limit, $offset);
        return $data;
    }

    // public function getRefreshBillData() {
    //     $page = $this->input->post('Page');
    //     // var_dump($page);
        
    //     $limit = 20;
    //     $offset = abs(($page - 1) * $limit);
    //     // var_dump($limit);
    //     // var_dump($offset);
    //     // $endDate = $this->input->post('endDate');
    //     $siteId = $this->getSiteId();
    //     $select = 'b.ReferenceId, b.InvoiceId AS InvoiceId,
    //     c.FirstName AS FirstName, c.LastName AS LastName,
    //     pd.Name AS ProductName, b.Periode,
    //     b.DueDate, b.Amount, b.StatusId,
    //     b.PaymentLink, b.ExpiryDate';
    //     $join1   = ['Product AS pd', 'c.ProductId = pd.Id', 'left'];
    //     $join2   = ['Bill AS b', 'c.Id = b.CustomerId', 'left'];
    //     $arrJoin = array(
    //         'join1' => $join1,
    //         'join2' => $join2,
    //     );
    //     $where  = $siteId;
    //     $data = $this->Bill_Customer->getBillCustomer($select, $arrJoin, $where, $limit, $offset);
    //     echo json_encode($data);
    // }

    // Untuk Get Data yang akan digunakan sebagai Invoice PDF
    public function getInvBill($customerId) {
        
        $siteId = $this->getSiteId();
        $select = 'c.Id as Id, c.FirstName AS GivenName, c.LastName AS SurName, 
        c.Whatsapp AS MobileNumber, c.Email, c.Address, b.InvoiceId, 
        b.Periode, b.DueDate';
        $join2   = ['Bill AS b', 'c.Id = b.CustomerId', 'inner'];
        $arrJoin = array(
            'join1' => $join1,
            'join2' => $join2,
        );
        $Where  = array(
            'customerId' => $customerId,
            'siteId' => $siteId,
            'statusId' => 'CRS5'
        );
        $dataCustomer = $this->Customer_Model->getCustomerBill($select, $arrJoin, $Where);

        return $dataCustomer;
    }

    public function generatePaymentLink($invoicesData) {
        $respone = $this->xendit_api->CreateInvoiceLink($invoicesData);
        return $respone;
    }

    public function expireInvoice($invoicesData) {
        $respone = $this->xendit_api->ExpireInvoice($invoicesData);
        // var_dump($respone); 

        return $respone;
    }

    public function deleteBill() {
        // Ambil ReferenceId dari post data
        $refId = $this->input->post('ReferenceId');
        
        // Panggil fungsi expireInvoice untuk mendapatkan respons dari API
        $responseApi = $this->expireInvoice($refId);
        // var_dump($responseApi);
        $responeType = gettype($responseApi);
        $refIdType = gettype($refId);
        $this->load->model('Bill_model');
        $apiData = null;
        $deleteResult = null;
        // var_dump('responeType',$responeType);
        // die();

        // Lakukan pemrosesan jika respons diterima
        if ($responeType == 'string') {
            $apiData = json_decode($responseApi,true);
            // var_dump($apiData['error_code']);
            // var_dump('refIdType',$refIdType);
            $referenceId = null;
            if($refIdType == 'string'){
                $referenceId = $refId;
            }
            if($refIdType == 'array'){
                // jika data berasal dari select box namun hanya ada 1 data
                $referenceId = $refId[0];
            }
            if(isset($apiData['error_code']) && $apiData['error_code'] == 'REQUEST_FORBIDDEN_ERROR'
            || isset($apiData['error_code']) && $apiData['error_code'] == 'INVALID_JSON_FORMAT'){
                $response = array('status' => 'error', 'message' => 'Bill gagal di hapus');
                echo json_encode($response);
                return;
            }else{
                $deleteResult = $this->Bill_model->deleteBill($referenceId);

                if ($deleteResult) {
                    $response = array('status' => 'success', 'message' => 'Bill berhasil dihapus');
                } else {
                    $response = array('status' => 'error', 'message' => 'Gagal menghapus Bill');
                }
                echo json_encode($response);
                return;
            }

        } elseif ($responeType == 'array') {
            // Jika $refId adalah array, loop dan kirim permintaan untuk setiap invoice
            $resultArray = array();
            for ($i=0; $i < count($responseApi); $i++) { 
            // foreach ($responseApi as $apiData) {
                $apiData = json_decode($responseApi[$i],true);
                if(isset($apiData['error_code']) && $apiData['error_code'] == 'REQUEST_FORBIDDEN_ERROR'
                || isset($apiData['error_code']) && $apiData['error_code'] == 'INVALID_JSON_FORMAT'){
                    $response = array('status' => 'error', 'message' => 'Bill gagal di hapus');
                    // echo json_encode($response);
                    // return;
                }else{
                    $deleteResult = $this->Bill_model->deleteBill($refId[$i]);
                    // Periksa hasil penghapusan
                    if ($deleteResult) {
                        $resultArray[] = array('status' => 'success', 'message' => 'Bill berhasil dihapus');
                    } else {
                        $resultArray[] = array('status' => 'error', 'message' => 'Gagal menghapus Bill');
                    }

                } 
            }
            echo json_encode($resultArray[0]);
            return;
            // echo json_encode($resultArray);
        }
    }

    public function checkBill($customerId,$periode)
    {
        $this->load->model('Bill_Model');
        $respone = $this->Bill_Model->checkExistingBill($customerId,$periode);
        return $respone;
    }

    public function getTotalPageBill($startDate,$endDate) {
        $siteId = $this->getSiteId();
        $this->load->model('Bill_Model');
        $where = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'siteId' => $siteId
        );
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $totalPage = $this->Bill_Model->getTotalPageBill($where);
        if($totalPage == '' || $totalPage == null){
            $totalPage = 1;
        }else{
            $totalPage = $totalPage[0]->TotalPage;
        }
        // var_dump($totalPage);
        // die();
        return $totalPage;
        
    }


    // public function generateInvoicePdf($InvPdfData)
    // {
    //     $this->load->library('pdf_co_api');

    //     // Load TCPDF library
    //     $mpdf = new \Mpdf\Mpdf();

    //     $companyData = $this->getCompanyProfile();
    //     $siteId = $this->getSiteId();
    //     $userId = $this->getUserId();
       
    //     // Mapping Data Company insert to Array var InvPdfData
    //     $InvPdfData['company_name'] = $companyData[0]->Name;
    //     $InvPdfData['company_address'] = $companyData[0]->Address;
    //     $InvPdfData['company_phone'] = $companyData[0]->Phone;
    //     $InvPdfData['company_email'] = $companyData[0]->Email;

    //     // for ($i=0; $i < $customerData; $i++) { 
    //     //     var_dump($customerData[$i]);
    //     // }
    //     // die();
    //     $this->pdf_co_api->HtmltoPdfTemplate($InvPdfData);
    // }

    private function getUserId()
	{
        // Check if the variable is defined
        $userId  ="0";
        $this->load->library('session');
        if ($this->session->has_userdata("id")) {
            // Retrieve its value
            $userId = $this->session->userdata("id");
        }
        
        return $userId;
	}

    public function getSiteId()
    {
		$siteId  ="0";
		// Load the session library
		$this->load->library('session');
        if ($this->session->has_userdata('siteid')) {
            // Retrieve its value
            $siteId = $this->session->userdata("siteid");
        }
        return $siteId;
	}

    public function getDueDateInvSet()
    {
        $siteId = $this->getSiteId();
        $code = 'DueDateInvoice';
        $this->load->model('Setting_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Setting_Model->getConfigSetting($siteId, $code);
        
        return $setting["Value"];
    }

    public function getPrefixInv()
    {
        $siteId = $this->getSiteId();
        $code = 'PrefixInvoice';
        $this->load->model('Setting_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Setting_Model->getConfigSetting($siteId, $code);
        
        return $setting["Value"];
    }

    public function getCompanyProfile(){
        $siteId = $this->getSiteId();
        // var_dump($siteId);
        $select = "Name,Phone,Email,Address";
        $where = $siteId;
        $this->load->model('Site_Model');
        // Panggil fungsi model untuk mendapatkan pengaturan berdasarkan siteid dan code
        $setting = $this->Site_Model->getCompanyData($select, $where);
        return $setting;
    }

    
    public function ramdomId()
    {
        // Mendefinisikan panjang maksimal ID
        $max_length = 3;

        // Generate random ID
        $random_id = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $max_length);

        // Print the random ID
        return $random_id;
    }

    public function getBillData(){
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        $page = $this->input->post('Page');
        $resutData = array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'page' => $page
        );
        $data = $this->getData($resutData);
        echo json_encode($data);
    }

    public function convertStringToArray($data) {
        // Cek apakah data adalah string
        if (is_string($data)) {
            // Memisahkan string menjadi array menggunakan koma sebagai pemisah
            $array = explode(',', $data);
            
            // Mengubah elemen-elemen array menjadi string
            foreach ($array as &$value) {
                $value = (string)$value;
            }
            
            return $array;
        }
        
        // Jika bukan string, kembalikan data tanpa perubahan
        return $data;
    }
}
