<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillCustomer_Controller extends CI_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library('xendit_api');
        $this->load->model('Bill_Model');
        $this->load->model('FileModel');
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Login_Controller/index"));
		}
	}

	public function index()
	{
		// $this->load->view('customer/listCustomer');
	}

    // Old Function, ada di menu bill
    public function createBill()
    {
        //Get Data from ajax
        $customerId = $this->input->post('customerId');
        // $amount = $this->input->post('amount');
        $periode = $this->input->post('periode');
        $dueDate = $this->input->post('dueDate');
        $status = $this->input->post('status');
        $descriptions = $this->input->post('descriptions');
        $resultCustomerId = '';
        $dueDateTimestamp = strtotime($dueDate);

        //Ambil tanggal dari due date untuk periode
        if ($dueDateTimestamp !== false) {
            $formattedDueDate = date('d', $dueDateTimestamp);
            // echo $formattedDueDate;
        } else {
            echo "Invalid due date format";
        }
            // echo $formattedDueDate;

        // apply tanggal
        $getDueDate = $this->getDueDateInvSet();
        $periodeBill = $periode.'-'.$getDueDate;

        // jika ada data all maka allnya di remove
        $dataCustomerIdArray = explode(',', $customerId);
        if($dataCustomerIdArray[0] == 'all' && count($dataCustomerIdArray) > 1){
            // Memisahkan string menjadi array berdasarkan koma
            $dataCustomerId = explode(',', $customerId);
            // Menghilangkan elemen pertama (index 0)
            array_shift($dataCustomerId);
            // Menggabungkan kembali array menjadi string dengan koma sebagai pemisah
            $dataCustomerId = implode(',', $dataCustomerId);
            // ubah kembali menjadi array
            $resultCustomerId = explode(',', $dataCustomerId);
        }
        if($dataCustomerIdArray[0] !== 'all' && count($dataCustomerIdArray) > 1){
            $resultCustomerId = explode(',', $customerId);
        }
        if($dataCustomerIdArray[0] !== 'all' && count($dataCustomerIdArray) == 1){
            $resultCustomerId = explode(',', $customerId);
        }
        // var_dump($customerId,$periodeBill);

        $checkBill   = $this->checkBill($resultCustomerId,$periodeBill);
        if($checkBill){
            $response = array('status' => 'error', 'message' => 'Data gagal di Simpan');
            echo json_encode($response);
            return;
        }else{
            $customerData   = $this->getCustomer($resultCustomerId);
            $userId         = $this->getUserId();
            $siteId         = $this->getSiteId();

            $arrInvoiceData = array();
            $arrBillId      = array();
            foreach($customerData AS $data) 
            {
                // Mapping Data Bill untuk insert ke table bill
                $billData = array(
                    'CustomerId' => $data->Id,
                    'SiteId' => $siteId,
                    'Amount' => $data->Price, 
                    'Periode' => $periodeBill, 
                    'DueDate' => $dueDate.' 00:00:00',
                    'StatusId' => $status,
                    'PaymentDate' => null,
                    'Creator' => $userId,
                    'CreateDate' => date('Y-m-d H:i:s'),
                    'Modifier' => $userId,
                    'ModifyDate' => date('Y-m-d H:i:s')
                );

                // Save Data Bill
                $newBillId='';
                $newBillId = $this->Bill_Model->createBill($billData);
                $arrBillId[] = $newBillId;
                // var_dump($newBillId);
                
                $customer = array(
                    'GivenNames' => $data->GivenName,
                    'Surname'   => $data->SurName,
                    'Email'     => $data->Email,
                    'MobileNumber' => $data->MobileNumber
                );

                // Mapping data PaymentMethods
                $PaymentMethods = ["CREDIT_CARD", "BCA", "BNI", "BSI", "BRI", "MANDIRI", "PERMATA", "SAHABAT_SAMPOERNA", "BNC", "ALFAMART", "INDOMARET", "OVO", "DANA", "SHOPEEPAY", "LINKAJA", "JENIUSPAY", "DD_BRI", "DD_BCA_KLIKPAY", "KREDIVO", "AKULAKU", "UANGME", "ATOME", "QRIS"];

                // Mapping data items
                $items = array(
                    "name" => $data->ProductName,
                    "quantity" => 1,
                    "price" => $data->Price,
                    "category" => "Internet Service Provider",
                );

                // Mapping data fees
                $fees = array(
                    "type" => "ADMIN",
                    "value" => 5000
                );

                // Mapping data untuk create invoice
                $invoiceData = [];
                if($descriptions !== ''){
                    $invoiceData = array(
                        'external_id' => 'INV-'.date("Ymd").'-'.$newBillId.$data->ProductId.$data->Id,
                        'amount' => $data->Price, 
                        'payer_email' => $data->Email, 
                        'description' => $descriptions,
                        'customer' => $customer,
                        'currency' => 'IDR',
                        'invoice_duration' => '2629056',
                        'payment_methods' => $PaymentMethods,
                        "items" => [$items],
                        "fees" => [$fees]
                    );
                }
                if($descriptions == ''){
                    $invoiceData = array(
                        'external_id' => 'INV-'.date("Ymd").'-'.$newBillId.$data->ProductId.$data->Id,
                        'amount' => $data->Price, 
                        'payer_email' => $data->Email, 
                        'customer' => $customer,
                        'currency' => 'IDR',
                        'invoice_duration' => '2629056',
                        'payment_methods' => $PaymentMethods,
                        "items" => [$items],
                        "fees" => [$fees]
                    );
                }
                
                $arrInvoiceData[] = $invoiceData;
                
                // Memanggil service untuk generate payment link


            }
            
            // var_dump('arrInvoiceData',$arrInvoiceData);
            $parentArr[] = $arrInvoiceData;
            // $arrBillId[] = $newBillId;

            // var_dump('arrInvoiceData',$newBillId);
            // var_dump('arrInvoiceData',$resultCustomerId);
            $countData = count($resultCustomerId);
            // var_dump('arrInvoiceData',$resultCustomerId);
            $dataArr = array(
                'index' => $countData,
                'data' => $arrInvoiceData,
            );
            // var_dump('arrInvoiceData',$dataArr['index']);

            $responeInvoice = $this->generatePayment($dataArr);
            // $dataInvoice = json_decode($responeInvoice);
            // $resultInvoice = json_encode($responeInvoice);
            $results = array();
            $dataUpdate = array();
            
            foreach($responeInvoice as $item){
                // Mapping Data Respone JSON untuk di insert
                $mappingJSON = array(
                    'Id'            => $item->id,
                    'ExternalId'    => $item->external_id,
                    'Status'        => $item->status,
                    'ExpiryDate'    => $item->expiry_date,
                    'MerchantName'  => $item->merchant_name,
                    'InvoiceUrl'    => $item->invoice_url
                );
                $contentText = json_encode($mappingJSON);
                
                    $updateBillData = array(
                        'PaymentLink' => $item->invoice_url,
                        'ExternalId' => $item->external_id,
                        'ReferenceId' => $item->id,
                        'ExpiryDate' => $item->expiry_date, 
                        'ContentText' => $contentText, 
                        'Modifier' => $userId,
                        'ModifyDate' => date('Y-m-d H:i:s')
                    );
                $dataUpdate[] = $updateBillData;


            }

            for ($i=0; $i < count($arrBillId); $i++) { 
                $dataUpdate[$i]['Id'] = $arrBillId[$i];
            }
            // var_dump($dataUpdate);
            // die();
            $resultUpdate = [];
            // for ($i=0; $i < count($dataUpdate); $i++) { 
                # code...
            
                $resultUpdate[] = $this->Bill_Model->updateBill($arrBillId,$dataUpdate);

            // }
            // var_dump($resultUpdate);

            // $results = array();
            // foreach($responeInvoice as $item){
            //     // Mapping Data Respone JSON untuk di insert
            //     $mappingJSON = array(
            //         'Id'            => $item->id,
            //         'ExternalId'    => $item->external_id,
            //         'Status'        => $item->status,
            //         'ExpiryDate'    => $item->expiry_date,
            //         'MerchantName'  => $item->merchant_name,
            //         'InvoiceUrl'    => $item->invoice_url
            //     );
            //     $contentText = json_encode($mappingJSON);

            //     var_dump($responeInvoice);
            //     $updateBillData = array(
            //         'PaymentLink' => $item->invoice_url,
            //         'ExternalId' => $item->external_id,
            //         'ReferenceId' => $item->id,
            //         'ExpiryDate' => $item->expiry_date, 
            //         'ContentText' => $contentText, 
            //         'Modifier' => $userId,
            //         'ModifyDate' => date('Y-m-d H:i:s')
            //     );

            //     $resultUpdate = $this->Bill_Model->updateBill($resultCustomerId,$billData);

            //     $results[] = $resultUpdate;
            // }

            // Cek apakah ada setidaknya satu yang gagal
            $hasFailed = in_array('error', array_column($resultUpdate, 'status'));

            // Berikan respons berdasarkan hasil update keseluruhan
            if ($hasFailed) {
                echo json_encode(array('status' => 'error', 'message' => 'Failed to update data.'));
            } else {
                echo json_encode(array('status' => 'success', 'message' => 'All data updated successfully.'));
            }
        }
    }

    public function createBillInv()
    {
        //Get Data from ajax
        $periode = $this->input->post('Periode');
        $customerIdArr = $this->input->post('CustomerId');
        $resultCustomerId = '';
        $timeDueDate = '23:59:59';
        // Get data duedate bill
        $getDueDate = '07';
        // $getDueDate = $this->getDueDateInvSet();
        $periodeBill = $periode.'-'.$getDueDate;

        // Gabungkan periode dengan tanggal due date
        $periodeBill = $periode.'-'.$getDueDate;
        // Check apakah customer id array?
        if (is_array($customerIdArr)) {
            $customerId = implode(',', $customerIdArr);
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
        // Persiapkan data
        // Get Data Customer by Id
        $customerData   = $this->getCustomer($customerIdArr);
        $userId         = $this->getUserId();
        $siteId         = $this->getSiteId();
        $arrInvoiceData = array();
        $arrBillId      = array();
        $arrInvoicePdfData      = array();
        foreach($customerData AS $data) 
        {
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

            // Mapping data untuk create invoice PaymentLink
            $invoiceData = [];
            $newBillId = $this->ramdomId();
            $invoiceData = array(
                'external_id' => 'INV-'.date("Ymd").'-'.$newBillId.$data->ProductId.$data->Id,
                'amount' => $data->Price, 
                'description' => '$descriptions',
                'customer' => $customer,
                'currency' => 'IDR',
                'invoice_duration' => '2629056',
                'payment_methods' => ["CREDIT_CARD", "BCA", "BNI", "BSI", "BRI", 
                "MANDIRI", "PERMATA", "SAHABAT_SAMPOERNA", "BNC", "ALFAMART", "INDOMARET", 
                "OVO", "DANA", "SHOPEEPAY", "LINKAJA", "JENIUSPAY", "DD_BRI", "DD_BCA_KLIKPAY",
                    "KREDIVO", "AKULAKU", "UANGME", "ATOME", "QRIS"],
                "items" => [$items]
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
                    'ExternalId'    => $item->external_id,
                    'Status'        => $item->status,
                    'ExpiryDate'    => $item->expiry_date,
                    'MerchantName'  => $item->merchant_name,
                    'InvoiceUrl'    => $item->invoice_url
                );
                $contentText = json_encode($mappingJSON);
                
                // Mapping Data Bill untuk insert ke table bill
                $billData = array(
                    'CustomerId' => $data->Id,
                    'SiteId' => $siteId,
                    'Amount' => $data->Price, 
                    'Periode' => $periodeBill, 
                    'DueDate' => $dateTimePeriode,
                    'StatusId' => 'BLS2',
                    'PaymentDate' => null,
                    'PaymentLink' => $item->invoice_url,
                    'ExternalId' => $item->external_id,
                    'ReferenceId' => $item->id,
                    'ExpiryDate' => $item->expiry_date, 
                    'ContentText' => $contentText, 
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
            echo json_encode(array('status' => 'success', 'message' => 'All data updated successfully.','data' => $resultsJson));
        }
    }

    public function getCustomer($customerId) {
        
        $siteId = $this->getSiteId();
        $select = 'c.Id as Id, c.FirstName AS GivenName, 
        c.LastName AS SurName, c.Whatsapp AS MobileNumber, 
        c.Email, c.Address, p.Id AS ProductId, 
        p.Name AS ProductName, p.Amount AS Price';
        $join   = ['Product AS p', 'c.ProductId = p.Id', 'left'];
        $where  = $customerId;
        $dataCustomer = $this->Customer_Model->getCustomer($select, $join, $where);

        return $dataCustomer;
    }

    public function getListBillData() {
        // $startDate = $this->input->post('startDate');
        // $endDate = $this->input->post('endDate');
        $siteId = $this->getSiteId();
        $select = 'b.ReferenceId, b.ExternalId AS ExternalId,
        c.FirstName AS FirstName, c.LastName AS LastName,
        pd.Name AS ProductName, b.Periode,
        b.DueDate, b.Amount, b.StatusId,
        b.PaymentLink, b.ExpiryDate';
        $join1   = ['Product AS pd', 'c.ProductId = pd.Id', 'left'];
        $join2   = ['Bill AS b', 'c.Id = b.CustomerId', 'left'];
        $arrJoin = array(
            'join1' => $join1,
            'join2' => $join2,
        );
        $where  = $siteId;
        $data = $this->Customer_Model->getBillCustomer($select, $arrJoin, $where);
        echo json_encode($data);
    }

    // Untuk Get Data yang akan digunakan sebagai Invoice PDF
    public function getInvBill($customerId) {
        
        $siteId = $this->getSiteId();
        $select = 'c.Id as Id, c.FirstName AS GivenName, c.LastName AS SurName, 
        c.Whatsapp AS MobileNumber, c.Email, c.Address, b.ExternalId, 
        b.Periode, b.DueDate';
        $join2   = ['Bill AS b', 'c.Id = b.CustomerId', 'inner'];
        $arrJoin = array(
            'join1' => $join1,
            'join2' => $join2,
        );
        $Where = $customerId;
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
        $max_length = 5;

        // Generate random ID
        $random_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $max_length);

        // Print the random ID
        return $random_id;
    }
}
