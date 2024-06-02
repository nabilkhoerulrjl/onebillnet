<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Fonnte_api');
        // $this->load->library('Fonnte_Controller');
        $this->load->library('session');

    }

    public function sendMessage()
	{
        //Init data dari form AJax
		$mediaId = $this->input->post('MediaId');
		$from = $this->input->post('From');
		$typeTarget = $this->input->post('TypeTarget');
		$toInput = $this->input->post('ToInput');
		$toContact = $this->input->post('ToContact');
		$toGroupContact = $this->input->post('ToGroupContact');
		$sendDate = $this->input->post('SendDate');
		$delay = $this->input->post('Delay');
		$subject = $this->input->post('Subject');
		$messageTemplate = $this->input->post('MessageTemplate');
		$typeTemplate = $this->input->post('TypeTemplate');
		$metaTemplate = $this->input->post('MetaTemplate');
		// $fixParamTemplate = $this->input->post('FixParamTemplate');
		$variableMessage = $this->input->post('VariableMessage');
		$message = $this->input->post('Message');
        $convertedVariable = $this->input->post('ConvertedVariable');
        // var_dump('Test convertedVariable',$convertedVariable);
        // var_dump('out if',$variableMessage);
        //call function getSiteId;
        // die();
        $dataBroadcast = array(
            'mediaId'           => $mediaId,
            'from'              => $from,
            'typeTarget'        => $typeTarget,
            'toInput'           => $toInput,
            'toContact'         => $toContact,
            'toGroupContact'    => $toGroupContact,
            'sendDate'          => $sendDate,
            'delay'             => $delay,
            'messageTemplate'   => $messageTemplate,
            'typeTemplate'      => $typeTemplate,
            'metaTemplate'      => $metaTemplate,
            'variableMessage'   => $variableMessage,
            'message'  => $message,
            'convertedVariable' => $convertedVariable,
        );
        
        $dataMessage = $this->mappingDataMessage($dataBroadcast);
		$siteId = $this->getSiteId();
        $userId = $this->getUserId();
        // var_dump($dataMessage);
        // die();
        //Get data contact sesuai input contact yang diberikan 
        // $targets = array();
        // $target = NULL;
        // $schedule = $sendDate;
        //Check input contact mana yang ada datanya
        // if(isset($toInput)) {
        //     if (strpos($toInput, '|') !== false) {
        //         $toInputArray = explode(',', $toInput);
        //         var_dump($toInput);
        //         foreach ($toInputArray as $item) {
        //             // Pisahkan data menggunakan pemisah (|)
        //             $itemArray = explode('|', $item);
        //             // Gunakan elemen pertama sebagai kunci, dan gabungkan elemen kedua dan ketiga sebagai nilai
        //             $key = array_shift($itemArray);
        //             if($itemArray !== '' || !$itemArray){
        //                 $value = implode('|', $itemArray);
        //                 // Tambahkan ke array $targets
        //                 $targets[$key] = $value;
        //             }
        //         }
        //     }else{
        //         // var_dump($toInput);
        //         $target = $toInput;
        //     }
            
        // }
        // if(isset($toContact) || isset($toGroupContact)){
        //     $dataContact = $this->getDataContact($toContact,$toGroupContact);
        //     $destContact = array();
        //     $contactName = array();
        //     $customerId = array();
        //     // var_dump($dataContact);
        //     // die('asdsad');
        //     if (!empty($dataContact)) {
        //         foreach ($dataContact as $contact) {
        //             $destContact[] = $contact->Whatsapp;
        //             $contactName[] = $contact->Name;
        //             $customerId[] = $contact->CustomerId;

        //         }
        //     }
        //     // Gabungkan nomor-nomor Whatsapp dengan koma
        //     $targetContact = implode(',', $destContact);
        //     // Gabungkan nama nama contact dengan koma
        //     $customerName = implode(',', $contactName);
        //     // Get Data Bill berdasarkan data customer yang diberikan
        //     $dataBill = $this->getDataParams($customerId);
            
        //     // var_dump($dataBill);
        //     if($dataBill == NULL || !$dataBill){
        //         $errMsg = 'Customer tersebut tidak memiliki data tagihan aktif';
        //         echo json_encode(['error' => $errMsg]);
        //         return;
        //     }

        //     $arrData = array(
        //         'variableMessage' => $variableMessage,
        //         'customerName' => $customerName,
        //         'dataBill' => $dataBill,
        //     );
            
        //     //Check apakah menggunakan template message apa tidak
        //     if($messageTemplate !== "" && $variableMessage !== "") {
        //         $valueVariable = $this->mapReplaceData($arrData);
        //     // var_dump('metaTemplate',$arrData);


        //     }
        //     $resultClearMessage = [];
        //     if(isset($variableMessage) && !empty($variableMessage)){

        //         foreach ($arrData['dataBill'] as $bill) {
        //             foreach (explode(',', $arrData['customerName']) as $customerName) {
        //                 $replaceData = [
        //                     'variableMessage' => $arrData['variableMessage'],
        //                     'customerName' => $customerName,
        //                     'bill' => $bill
        //                 ];
                
        //                 $resultClearMessage[] = $this->replaceMessageVariables($convertedVariable, $replaceData);
        //             }
        //         }
        //     }
        //     $target = $targetContact;
        //     // Menampilkan hasil
        //     // var_dump('Test',$replaceData);
        //     // var_dump('Test',$resultClearMessage[0]);
        //     // die();

        //     // var_dump('Test',$customerId);
        //     // var_dump('dataContact',$dataContact);
        //     // var_dump('$customerId',$customerId);

        //     // var_dump('dataBill',$dataBill);

            
        //     // Siapkan data untuk dikirim ke API

        //     // Pisahkan nomor telepon dalam string $target
            
        //     // var_dump($targets);

            

        //     // Hasilnya
        //     // var_dump($targets);
        //     // $targets = array(
        //     //     $target => $toInput,
        //     // );

        //     // $targets = array(
        //     //     '6281219013257' => 'Home Code Project|Rp 150.000|November 2023|1234589|25 November 2023 23:00',
        //     //     '6285943063646' => '2345675|Dede Muhammad|November 2023|Rp 150.000|25 November 2023 23:00',
        //     //     // '6282123002023' => 'Ahmad Saepudin|7895462|November 2023|Rp 150.000|25 November 2023 23:00',
        //     // );

        //     // var_dump($targets);
        // }

        // $phoneNumbers = explode(',', $target);
        // // var_dump($phoneNumbers);
        // // Buat array $targets dengan memetakan setiap nomor telepon ke nilai yang sesuai dalam $valueVariable
        // if(isset($valueVariable)){
        //     foreach ($phoneNumbers as $phoneNumber) {
        //         $targets[$phoneNumber] = array_shift($valueVariable);
        //     }
        // }else{
        //     $targets = $target;
        // }

        // if($schedule == '' || $schedule == null){
        //     $currentDateTime = new DateTime();
        //     $timestamp = $currentDateTime->getTimestamp();
        //     $schedule = $timestamp;
        // }

        // $apiData = array(
        //     'targets' => $targets,//$toInput,
        //     'sendDate' => $sendDate,
        //     'message' => $message,
        //     'schedule' => $schedule,
        //     'delay' => $delay,
        //     'countryCode' => '62', // Sesuaikan dengan kebutuhan
        // );

        if(isset($dataMessage['status']) && $dataMessage['status'] == 'error'){
            $errMsg = 'Customer tersebut tidak memiliki data tagihan aktif';
            echo json_encode(array('status' => 'error', 'message' => $errMsg));
            return;
        }
        //Send data to sendAPI
        $sendMessage = $this->sendMessageApi($dataMessage,$mediaId);
        // var_dump($sendMessage);
        //Check apakah status berhasil atau tidak
        if($sendMessage['status'] == 'true'){
            if($sendMessage['process'] == 'processing' && $sendMessage['process'] == true){
                $dataConn = $this->getMediaConnection($from);
                $totalTarget = count($sendMessage["target"]);
                $connId = $dataConn[0]->Id;
                $responseMessages = array();
                // die();
                for ($i=0; $i < $totalTarget; $i++) { 
                    $dataMessage = array(
                        'SiteId' => $siteId,
                        'ConnectionId' => $connId,
                        'ObjectName' => 'Message',
                        'ObjectId' => NULL,
                        'Subject' => $subject,
                        'Description' => 'Message Reminder Billing',
                        'Remarks' => '',
                        'SendDate' => date('Y-m-d H:i:s'),
                        'MediaId' => $mediaId,
                        'MethodId' => NULL,
                        'TypeId' => NULL,
                        'From' => $from,
                        'To' => $sendMessage["target"][$i],
                        'Cc' => NULL,
                        'Bcc' =>  NULL,
                        'StatusId' => 'MES1',
                        'Status' => $sendMessage["status"],
                        'State' => $sendMessage['detail'],
                        'StateId' => NULL,
                        'Retry' => 0,
                        'Attachment' => 0,
                        'Processing' => 1,
                        'RemoteId' => $sendMessage['id'][$i],
                        'CreateDate' => date('Y-m-d H:i:s'),
                        'Creator' => $userId,
                        'ModifyDate' => date('Y-m-d H:i:s'),
                        'Modifier' => $userId,
                    );
                    $messageBody = $message;
                    // var_dump($variableMessage);
                    // die();
                    if(isset($variableMessage) && !empty($variableMessage)){
                        $messageBody = $message;
                    }
    
                    // Data untuk dimasukkan ke tabel 'messagecontent'
                    $dataMessageContent = array(
                        'Id' => '',
                        'ObjectName' => 'Message',
                        'ObjectId' => $sendMessage['detail'],
                        'Body' => $messageBody,
                        'BodyText' => $messageBody,
                        'Meta' => json_encode($metaTemplate),
                        'TemplateId' => $messageTemplate,
                        'ContentType' => 'NULL',
                        'Encoding' => NULL,
                    );
                    // var_dump(json_encode($resultClearMessage[0]));
                    // die();
    
                    // Memanggil model 'Message_Model'
                    $this->load->model('Message_Model');
                    // Memanggil model 'MessageContent_Model'
                    $this->load->model('MessageContent_Model');
    
                    // Menyimpan data ke dalam tabel 'message' dan mendapatkan ID pesan
                    $messageId = $this->Message_Model->insertMessage($dataMessage);
                    // var_dump($messageId->Id);
                    // die();
    
                    if ($messageId !== false) {
                        // Jika penyimpanan pesan berhasil, tambahkan ID pesan ke data konten
                        $dataMessageContent['Id'] = $messageId;
            // var_dump(json_encode($metaTemplate));
                    // die();
                        // Menyimpan data ke dalam tabel 'messagecontent'
                        $responeMC = $this->MessageContent_Model->insertMessageContent($dataMessageContent);
            // var_dump($var);
                        
                        // Respon berhasil ke AJAX atau sesuaikan dengan kebutuhan
                        $responseMessages[] = array('status' => 'success', 'message' => 'Message sent successfully.');
                    } else {
                        // Respon gagal ke AJAX atau sesuaikan dengan kebutuhan
                        $responseMessages[] = array('status' => 'error', 'message' => 'Failed to send message.');
                    }
    
                }
                //Init dan mapping data respone from api
                
                $sendMessage['detail'];
                $sendMessage['id'];
                $sendMessage['process'];
                $sendMessage['status'];
                $sendMessage['target'];
                echo json_encode($responseMessages);
            }
        }else{
            if($sendMessage['reason'] == 'target invalid'){
                $errMsg = 'Nomor tujuan salah atau tidak terdaftar di Whatsapp';
                echo json_encode(['error' => $errMsg]);
                return;
            }else if($sendMessage['reason'] == 'unknown token'){
                $errMsg = 'Token API anda salah atau tidak diketahui';
                echo json_encode(['error' => $errMsg]);
            }
        }
        
        // var_dump($sendMessage);
    
            // Menampilkan hasil
                
        
	}

    public function saveMessage() {
        // Anda bisa menyesuaikan data yang akan di-insert sesuai kebutuhan
        $data = array(
            'SiteId' => 1,
            'ConnectionId' => 2,
            'ObjectName' => 'Example',
            'ObjectId' => 123,
            'Subject' => 'Test Subject',
            'Description' => 'Test Description',
            'Remarks' => 'Test Remarks',
            'SendDate' => date('Y-m-d H:i:s'),
            'MediaId' => 'SMS',
            'MethodId' => 'EMAIL',
            'TypeId' => 'INFO',
            'From' => 'sender@example.com',
            'To' => 'recipient@example.com',
            'Cc' => 'cc@example.com',
            'Bcc' => 'bcc@example.com',
            'StatusId' => 'PENDING',
            'Status' => 'Pending',
            'State' => 'NEW',
            'Retry' => 0,
            'Attachment' => 1,
            'Processing' => 0,
            'RemoteId' => 'remote123',
            'CreateDate' => date('Y-m-d H:i:s'),
            'Creator' => 'admin',
            'ModifyDate' => date('Y-m-d H:i:s'),
            'Modifier' => 'admin',
        );

        // Panggil model untuk menyisipkan data
        $this->Message_Model->insertMessage($data);

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        redirect('path/ke/halaman/tujuan');
    }




    public function getInfoDevice() {
        // Contoh penggunaan
        $url = 'https://api.fonnte.com/device';
        $headers = array(
            'Authorization: ooT5x+1Y4fcHCgtpFnQn',
            'Content-Type: application/x-www-form-urlencoded', // Sesuaikan dengan kebutuhan
        );

        $data = array(
            // Data yang akan dikirim, jika diperlukan
        );

        $response = $this->fonnte_api->sendPostRequest($url, $headers, $data);

        // Lakukan sesuatu dengan response
        echo $response;
    }

    public function getDataContact($toContact='',$toGroupContact='')
    {
        $select = 'Contact.Id,Contact.Name,Contact.Email,Contact.Phone,Contact.Whatsapp,Contact.Mobile,Contact.CustomerId';
        $where = array();

        // if ($toInput) {
        //     $where['Whatsapp'] = $toInput;
        // }
        if ($toContact) {
            $where['Id'] = explode(", ", $toContact);
        }
        if ($toGroupContact) {
            $where['GroupId'] = explode(", ", $toGroupContact);
        }


        

		$this->load->model('Contact_Model');
		$data['dataContact'] = $this->Contact_Model->getContactByAny($select, $where);
        return $data['dataContact'];
    }

    // function mapReplaceData($arrData) {
    //     // Variabel hasil
    //     $result = array();

    //     // Mendapatkan array customerName dari string
    //     $customerNames = explode(',', $arrData['customerName']);
        
    //     // Pemetaan dan penggantian data
    //     foreach ($arrData['dataBill'] as $bill) {
    //         foreach ($customerNames as $customerName) {
    //             // Mendapatkan nama variabel dari 'variableMessage'
    //             $variableNames = array_map('trim', explode(',', $arrData['variableMessage']));

    //             // Mengganti nilai yang sesuai dengan 'variableMessage'
    //             $replaceData = array_combine($variableNames, array(
    //                 trim($customerName),
    //                 'ID' . uniqid(),
    //                 date('F Y', strtotime($bill->Periode)),
    //                 date('d F Y H:i', strtotime($bill->DueDate)),
    //                 "Rp " . number_format($bill->Amount, 2, ',', '.')
    //             ));

    //             // Mengganti koma dengan pipa dan menghilangkan spasi
    //             $result[] = implode('|', array_map(function ($key, $value) {
    //                 return "$value";
    //             }, array_keys($replaceData), $replaceData));
    //         }
    //     }

    //     return $result;
    // }

    public function getDataParams($customerId,$contactName,$destContact,$variableMessage)
    {
		$siteId = $this->getSiteId();
        //ubah data variable jadi array
        $variable = explode(", ", $variableMessage);
        // Tentukan array alias
        $aliasData = array(
            "cs.Id" => "CustomerId",
            "CONCAT(cs.FirstName, ' ', cs.LastName)" => "CustomerName",
            "b.InvoiceId" => "InvoiceId",
            "b.Product" => "BillName",
            "b.Description" => "BillDesc",
            "b.Amount" => "BillAmount",
            "b.Periode" => "BillPeriode",
            "b.DueDate" => "BillDueDate",
            "b.PaymentLink" => "PaymentLink",
            "b.InvoiceLink" => "InvoiceLink",
            "b.ReferenceId" => "BillId",
            "st.Name" => "MerchantName",
            "st.BankType" => "MerchantBank",
            "st.AccounBank" => "MerchantBankAccount",
            "st.Phone" => "MerchantPhone",
            "st.Email" => "MerchantEmail",
        );
        // Mapping and check, hanya data yang ada di dalam $variable yang masuk kedalam select
        $selectFields = [];
        foreach ($variable as $alias) {
            foreach ($aliasData as $column => $aliasName) {
                if ($aliasName == $alias) {
                    $selectFields[] = "$column AS $alias";
                    break;
                }
            }
        }
        // define where customer table
        $where = array(
            'cs.SiteId' => $siteId,
            // 'cs.StatusId' => 'CRS1',
            'cs.CustomerId' => $customerId,
        );
        // define variable join
        $joinBill = null;
        $joinSite = null;
        // foreach data variable
        for ($i=0; $i < count($variable); $i++) {
            // Check if data has at teh same $variable define where and join value
            if($variable[$i] == 'InvoiceId' || $variable[$i] == 'BillName' || $variable[$i] == 'BillDesc'
            || $variable[$i] == 'BillAmount' || $variable[$i] == 'BillPeriode' || $variable[$i] == 'BillDueDate'
            || $variable[$i] == 'PaymentLink' || $variable[$i] == 'BillId'){
                $joinBill = ["(SELECT b1.* FROM Bill b1 
                INNER JOIN (SELECT ProductId, CustomerId, MAX(Periode) AS MaxPeriode 
                        FROM Bill 
                        WHERE CustomerId IN (".implode(',', $customerId).")
                        GROUP BY ProductId, CustomerId) b2 
                ON b1.ProductId = b2.ProductId AND b1.CustomerId = b2.CustomerId AND b1.Periode = b2.MaxPeriode) b",
                'cs.Id = b.CustomerId',
                'INNER'];
                $orderClause = "FIELD(CONCAT(cs.FirstName, ' ', cs.LastName), '" . implode("', '", $contactName) . "')";
            }
            if($variable[$i] == 'MerchantName' || $variable[$i] == 'MerchantPhone' || $variable[$i] == 'MerchantEmail'){
                $joinSite = ['Site AS st', 'cs.SiteId = st.Id', 'left'];
            }
        }
        // Load model
		$this->load->model('Customer_Model');
        // Passing data to model
		$dataRespone = $this->Customer_Model->getDataParamTemplate($selectFields,$joinBill,$joinSite,$orderClause, $where);
        $formattedTargets = array();
        $toTargets;
        $formattedTargets = [];
        for ($i = 0; $i < count($dataRespone); $i++) {
            if ($dataRespone[$i]['CustomerName'] == $contactName[$i]) {
                $dataTarget = [];
                // Tambahkan $destnumber ke dalam $dataTarget
                $dataTarget[] = $destContact[$i];
                // Loop melalui setiap key yang ada di $variable
                for ($j = 0; $j < count($variable); $j++) {
                    // echo $variable[$j] . ": " . $dataRespone[$i][$variable[$j]] . "\n";
                    if($variable[$j] == 'BillPeriode'){
                        $dataRespone[$i][$variable[$j]] = date("F Y", strtotime($dataRespone[$i][$variable[$j]]));
                    }
                    if($variable[$j] == 'BillAmount'){
                        $billAmount = $dataRespone[$i][$variable[$j]];
                        $ppn = $billAmount * 0.11;
                        $totalAmount = $billAmount + $ppn;
                        $formattedTotal = "Rp " . number_format($totalAmount, 0, ',', '.');
                        $dataRespone[$i][$variable[$j]] = $formattedTotal;
                        // $dataRespone[$i][$variable[$j]] = "Rp " . number_format($dataRespone[$i][$variable[$j]]=$dataResponse[$i][$variable[$j]]+$dataResponse[$i][$variable[$j]]*0.11, 0, ',', '.');
                    }
                    if($variable[$j] == 'BillDueDate'){
                        $dataRespone[$i][$variable[$j]] = date("j F Y H:i", strtotime($dataRespone[$i][$variable[$j]]));
                    }
                    $dataTarget[] = $dataRespone[$i][$variable[$j]];

                }
                // Gabungkan nilai-nilai menjadi string dengan pemisah '|'
                // var_dump($dataTarget);
                $formattedTargets[] = implode('|', $dataTarget);
            }
        }
        $toTargets = implode(',', $formattedTargets);
        // var_dump('Hallo',$toTargets);
        return $toTargets;
    }

    // function replaceMessageVariables($message, $replaceData) {
    //     // Mendapatkan nama variabel dari 'variableMessage'
    //     $variableNames = array_map('trim', explode(',', $replaceData['variableMessage']));
    
    //     // Mengganti nilai yang sesuai dengan 'variableMessage'
    //     $replaceData = array_combine($variableNames, array(
    //         trim($replaceData['customerName']),
    //         'ID' . uniqid(),
    //         date('F Y', strtotime($replaceData['bill']->Periode)),
    //         date('d F Y H:i', strtotime($replaceData['bill']->DueDate)),
    //         "Rp " . number_format($replaceData['bill']->Amount, 2, ',', '.')
    //     ));
    //     // Mengganti variabel dalam teks
    //     foreach ($replaceData as $key => $value) {
    //     // var_dump('Test',$key);
    //     // var_dump('Test',$value);

    //         $message = str_replace("{$key}", $value, $message);
    //     // var_dump('Test',$message);

    //     }
    // // die();
    //     return $message;
    // }

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

    public function getUserId() {
		$siteId = $this->getSiteId();
        // Cek apakah pengguna sudah login
        if ($this->session->userdata('status')) {
            // Ambil data session
            $userId = $this->session->userdata('id');
            // echo "UserId : ".$userId;
            return $userId;
        }
    }

    public function getMediaConnection($username)
	{
		$siteId = $this->getSiteId();
		$where = array(
			'SiteId' => $siteId,
            'UserName' => $username,
			'StatusId' => 'CNS1'
		);
		$this->load->model('M_Connection');
		$data['dataConn'] = $this->M_Connection->listConnection('Connection', $where);

		return $data['dataConn'];
	}

    public function mappingDataMessage($dataBroadcast){
        $data = $dataBroadcast;
        // var_dump($data);
        if($data["mediaId"] == 'WHATP'){
            //Get data contact sesuai input contact yang diberikan 
            $targets = array();
            $target = NULL;
            $schedule = $data["sendDate"];
            //Check input contact mana yang ada datanya
            if(isset($toInput)) {
                if (strpos($toInput, '|') !== false) {
                    $toInputArray = explode(',', $toInput);
                    // var_dump($toInput);
                    foreach ($toInputArray as $item) {
                        // Pisahkan data menggunakan pemisah (|)
                        $itemArray = explode('|', $item);
                        // Gunakan elemen pertama sebagai kunci, dan gabungkan elemen kedua dan ketiga sebagai nilai
                        $key = array_shift($itemArray);
                        if($itemArray !== '' || !$itemArray){
                            $value = implode('|', $itemArray);
                            // Tambahkan ke array $targets
                            $targets[$key] = $value;
                        }
                    }
                }else{
                    $target = $toInput;
                }
            }
            if(isset($data["toContact"]) || isset($data["toGroupContact"])){
                $dataContact = $this->getDataContact($data["toContact"],$data["toGroupContact"]);
                // var_dump($dataContact);
                $destContact = array();
                $contactName = array();
                $customerId = array();
                if (!empty($dataContact)) {
                    foreach ($dataContact as $contact) {
                        $destContact[] = $contact->Whatsapp;
                        $contactName[] = $contact->Name;
                        $customerId[] = $contact->CustomerId;
                    }
                }
                // Gabungkan nomor-nomor Whatsapp dengan koma
                $targetContact = implode(',', $destContact);
                // Gabungkan nama nama contact dengan koma
                $customerName = implode(',', $contactName);
                $arrData = array(
                    'variableMessage' => $data["variableMessage"],
                    'customerName' => $customerName,
                );
                //if data is template and type ttm1 check bill
                if(isset($data['messageTemplate']) && $data['typeTemplate'] == 'TTM1'){
                    // Get Data Bill berdasarkan data customer yang diberikan
                    $variable = explode(", ", $data["variableMessage"]);
                    $dataParams = $this->getDataParams($customerId,$contactName,$destContact,$data["variableMessage"]);
                    // var_dump($dataParams);
                    // die();
                    if($dataParams == NULL || !$dataParams){
                        $errMsg = 'Data Param Null';
                        return array('status' => 'error', 'message' => $errMsg);
                    }
                    // $arrData['dataBill'] = $dataBill;
                    $toTargets = $dataParams;
                }else{
                    $toTargets = $targetContact;
                }
                    
                //Check apakah menggunakan template message apa tidak
                /*if($data["messageTemplate"] !== "" && $data["variableMessage"] !== "") {
                    $valueVariable = $this->mapReplaceData($arrData);
                // var_dump('metaTemplate',$arrData);
                }
                $resultClearMessage = [];
                if(isset($data["variableMessage"]) && !empty($data["variableMessage"])){
                    foreach ($arrData['dataBill'] as $bill) {
                        foreach (explode(',', $arrData['customerName']) as $customerName) {
                            $replaceData = [
                                'variableMessage' => $arrData['variableMessage'],
                                'customerName' => $customerName,
                                'bill' => $bill
                            ];
                    
                            $resultClearMessage[] = $this->replaceMessageVariables($convertedVariable, $replaceData);
                        }
                    }
                }*/
                $target = $toTargets;
            }

            /*$phoneNumbers = explode(',', $target);
            // var_dump($phoneNumbers);
            // Buat array $targets dengan memetakan setiap nomor telepon ke nilai yang sesuai dalam $valueVariable
            if(isset($valueVariable)){
                foreach ($phoneNumbers as $phoneNumber) {
                    $targets[$phoneNumber] = array_shift($valueVariable);
                }
            }else{
                $targets = $target;
            }*/

            //
            
            // var_dump($data['sendDate']);
            if($data['sendDate'] == '' || $data['sendDate'] == null){
                $currentDateTime = new DateTime();
                $timestamp = $currentDateTime->getTimestamp();
                $scheduleSend = $timestamp;
                $data['sendDate'] = $scheduleSend;
            }
            // else{
            //     // $dataDate = DateTime::createFromFormat("Y-m-d H:i:s", );
            //     $date = new DateTime($data['sendDate']); // Create a new DateTime object with the current date and time
            //     $currentDateTime = new DateTime($data['sendDate']);
            //     $timestamp = $currentDateTime->getTimestamp();
            //     $data['sendDate'] = $timestamp;

            // }
                // var_dump($data['sendDate']);
            $schedule = $data['sendDate'];
            if($data['delay'] == '' || $data['delay'] == null){
                $data['delay'] = 120;
            }
            $dataMapping = array(
                'from' => $data['from'],
                'targets' => $target,//$toInput,
                'sendDate' => $data['sendDate'],
                'message' => $data['message'],
                'schedule' => $schedule,
                'delay' => $data['delay'],
                'countryCode' => '62', // Sesuaikan dengan kebutuhan
            );
        }else if($data["mediaId"] == 'EMAIL'){

        }
        return $dataMessage = $dataMapping;
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

    public function sendMessageApi($dataMessage,$mediaId)
    {
        if($mediaId == 'WHATP'){
            $apiData = $dataMessage;
            $response = $this->fonnte_api->sendMessage($dataMessage);
            $jsonString = $response;
            $jsonData = json_decode($jsonString, true);
        }

        return $jsonData;
    }
}