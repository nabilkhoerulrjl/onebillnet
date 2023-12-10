<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('fonnte_api');
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
		$metaTemplate = $this->input->post('MetaTemplate');
		$variableMessage = $this->input->post('VariableMessage');
		$message = $this->input->post('Message');
        $convertedVariable = $this->input->post('ConvertedVariable');
        // var_dump('Test convertedVariable',$convertedVariable);
        var_dump('out if',$variableMessage);
        //call function getSiteId;
        // die();
		$siteId = $this->getSiteId();
        $userId = $this->getUserId();
        //Get data contact sesuai input contact yang diberikan 
        $targets = array();
        $target = NULL;
        $schedule = $sendDate;
        //Check input contact mana yang ada datanya
        if(isset($toInput)) {
            if (strpos($toInput, '|') !== false) {
                $toInputArray = explode(',', $toInput);
                var_dump($toInput);
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
                // var_dump($toInput);

                $target = $toInput;
            }
            
        }
        if(isset($toContact) || isset($toGroupContact)){
            $dataContact = $this->getDataContact($toContact,$toGroupContact);
            $destContact = array();
            $contactName = array();
            $customerId = array();
            // var_dump($dataContact);
            // die('asdsad');
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
            // Get Data Bill berdasarkan data customer yang diberikan
            $dataBill = $this->getDataBillbyCS($customerId);
            var_dump($dataBill);
            if($dataBill == NULL || !$dataBill){
                $errMsg = 'Customer tersebut tidak memiliki data tagihan aktif';
                echo json_encode(['error' => $errMsg]);
                return;
            }

            $arrData = array(
                'variableMessage' => $variableMessage,
                'customerName' => $customerName,
                'dataBill' => $dataBill,
            );
            
            //Check apakah menggunakan template message apa tidak
            if($messageTemplate !== "" && $variableMessage !== "") {
                $valueVariable = $this->mapReplaceData($arrData);
            // var_dump('metaTemplate',$arrData);


            }
            $resultClearMessage = [];
            if(isset($variableMessage) && !empty($variableMessage)){

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
            }
            $target = $targetContact;
            // Menampilkan hasil
            // var_dump('Test',$replaceData);
            // var_dump('Test',$resultClearMessage[0]);
            // die();

            // var_dump('Test',$customerId);
            // var_dump('dataContact',$dataContact);
            // var_dump('$customerId',$customerId);

            // var_dump('dataBill',$dataBill);

            
            // Siapkan data untuk dikirim ke API

            // Pisahkan nomor telepon dalam string $target
            
            // var_dump($targets);

            

            // Hasilnya
            // var_dump($targets);
            // $targets = array(
            //     $target => $toInput,
            // );

            // $targets = array(
            //     '6281219013257' => 'Home Code Project|Rp 150.000|November 2023|1234589|25 November 2023 23:00',
            //     '6285943063646' => '2345675|Dede Muhammad|November 2023|Rp 150.000|25 November 2023 23:00',
            //     // '6282123002023' => 'Ahmad Saepudin|7895462|November 2023|Rp 150.000|25 November 2023 23:00',
            // );

            // var_dump($targets);
        }

        $phoneNumbers = explode(',', $target);
        // var_dump($phoneNumbers);
        // Buat array $targets dengan memetakan setiap nomor telepon ke nilai yang sesuai dalam $valueVariable
        if(isset($valueVariable)){
            foreach ($phoneNumbers as $phoneNumber) {
                $targets[$phoneNumber] = array_shift($valueVariable);
            }
        }else{
            $targets = $target;
        }

        if($schedule == '' || $schedule == null){
            $currentDateTime = new DateTime();
            $timestamp = $currentDateTime->getTimestamp();
            $schedule = $timestamp;
        }

        $apiData = array(
            'targets' => $targets,//$toInput,
            'sendDate' => $sendDate,
            'message' => $message,
            'schedule' => $schedule,
            'delay' => $delay,
            'countryCode' => '62', // Sesuaikan dengan kebutuhan
        );

        //Send data to sendFonnteApi
        $sendMessage = $this->sendFonnteApi($apiData);
        // var_dump($sendMessage);
        //Check apakah status berhasil atau tidak
        if($sendMessage['status'] == 'true'){
            if($sendMessage['process'] == 'processing' && $sendMessage['process'] == true){
                $dataConn = $this->getMediaConnection($from);
                $totalTarget = count($sendMessage["target"]);
                $connId = $dataConn[0]->Id;
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
                    var_dump($variableMessage);
                    // die();
                    if(isset($variableMessage) && !empty($variableMessage)){
                        var_dump('asdasdsad');
                        $messageBody = $resultClearMessage[0];
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
                        $var = $this->MessageContent_Model->insertMessageContent($dataMessageContent);
            var_dump($var);
                        
                        // Respon berhasil ke AJAX atau sesuaikan dengan kebutuhan
                        echo json_encode(array('status' => 'success', 'message' => 'Message sent successfully.'));
                    } else {
                        // Respon gagal ke AJAX atau sesuaikan dengan kebutuhan
                        echo json_encode(array('status' => 'error', 'message' => 'Failed to send message.'));
                    }
    
                }
                //Init dan mapping data respone from api
                
                $sendMessage['detail'];
                $sendMessage['id'];
                $sendMessage['process'];
                $sendMessage['status'];
                $sendMessage['target'];
    
            }
        }else{
            if($sendMessage['reason'] == 'target invalid'){
                $errMsg = 'Nomor tujuan salah atau tidak terdaftar di Whatsapp';
                echo json_encode(['error' => $errMsg]);
                return;
            }
        }
        
        // var_dump($sendMessage);
    
            // Menampilkan hasil
                
        
	}

    public function sendFonnteApi($apiData) {
        $targets = array(
            '085943063646' => 'Fonnte|Admin',
            '021219013257' => 'Lily|Client',
        );

        $message = $apiData['message'];
        $scedule = $apiData['schedule'];
        $delay = $apiData['delay'];
        $countryCode = $apiData['countryCode'];

        $response = $this->fonnte_api->sendMessage($apiData['targets'], $message, $scedule, $delay, $countryCode);

        $jsonString = $response;
        $jsonData = json_decode($jsonString, true);
        
        // Mengakses nilai tertentu
        // $status = $jsonData['status'];
        // $detail = $jsonData['detail'];
        // $process = $jsonData['process'];
        // $ids = $jsonData['id'];
        // $targets = $jsonData['target'];
        return $jsonData;
        // Menampilkan hasil
        // echo 'Status: ' . ($status ? 'True' : 'False') . '<br>';
        // echo 'Detail: ' . $detail . '<br>';
        // echo 'Process: ' . $process . '<br>';
        // echo 'IDs: ' . implode(', ', $ids) . '<br>';
        // echo 'Targets: ' . implode(', ', $targets) . '<br>';
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
            $where['Id'] = $toContact;
        }
        if ($toGroupContact) {
            $where['GroupId'] = $toGroupContact;
        }


        

		$this->load->model('Contact_Model');
		$data['dataContact'] = $this->Contact_Model->getContactByAny($select, $where);
        return $data['dataContact'];
    }

    function mapReplaceData($arrData) {
        // Variabel hasil
        $result = array();

        // Mendapatkan array customerName dari string
        $customerNames = explode(',', $arrData['customerName']);
        
        // Pemetaan dan penggantian data
        foreach ($arrData['dataBill'] as $bill) {
            foreach ($customerNames as $customerName) {
                // Mendapatkan nama variabel dari 'variableMessage'
                $variableNames = array_map('trim', explode(',', $arrData['variableMessage']));

                // Mengganti nilai yang sesuai dengan 'variableMessage'
                $replaceData = array_combine($variableNames, array(
                    trim($customerName),
                    'ID' . uniqid(),
                    date('F Y', strtotime($bill->Periode)),
                    date('d F Y H:i', strtotime($bill->DueDate)),
                    "Rp " . number_format($bill->Amount, 2, ',', '.')
                ));

                // Mengganti koma dengan pipa dan menghilangkan spasi
                $result[] = implode('|', array_map(function ($key, $value) {
                    return "$value";
                }, array_keys($replaceData), $replaceData));
            }
        }

        return $result;
    }

    public function getDataBillbyCS($CustomerId)
    {
		$siteId = $this->getSiteId();
        $select = 'Bill.Amount,Bill.Periode,Bill.DueDate';
        $where = array(
            'SiteId' => $siteId,
            'StatusId' => 'BLS2',
            'CustomerId' => $CustomerId,
        );


        

		$this->load->model('Bill_Model');
		$data['Bill'] = $this->Bill_Model->getBillByAny($select, $where);

        return $data['Bill'];
    }

    function replaceMessageVariables($message, $replaceData) {
        // Mendapatkan nama variabel dari 'variableMessage'
        $variableNames = array_map('trim', explode(',', $replaceData['variableMessage']));
    
        // Mengganti nilai yang sesuai dengan 'variableMessage'
        $replaceData = array_combine($variableNames, array(
            trim($replaceData['customerName']),
            'ID' . uniqid(),
            date('F Y', strtotime($replaceData['bill']->Periode)),
            date('d F Y H:i', strtotime($replaceData['bill']->DueDate)),
            "Rp " . number_format($replaceData['bill']->Amount, 2, ',', '.')
        ));
        // Mengganti variabel dalam teks
        foreach ($replaceData as $key => $value) {
        // var_dump('Test',$key);
        // var_dump('Test',$value);

            $message = str_replace("{$key}", $value, $message);
        // var_dump('Test',$message);

        }
    // die();
        return $message;
    }

    public function getSiteId()
    {
        $domain = 'homewifi.com';//$_SERVER['HTTP_HOST'];
        if (!$domain) {
            $domain = $_SERVER['SERVER_NAME'];
        }
        $where = array(
			'Domain' => $domain,
		);
        
        $site = $this->M_Site->siteId("site",$where);
        //$query = $this->db->get('site');
		//$arrays = $site->result();
        $siteId = null;
        if(isset($site)){
            $siteId = $site;
        }else{
            echo "SiteId Not Found !";
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

    
}