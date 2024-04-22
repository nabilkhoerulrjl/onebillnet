<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Customer_Model');
        $this->load->model('Contact_Model');
    }

    public function index() {
        // Tampilkan daftar semua kontak
        // $data['contacts'] = $this->Contact_model->getAllContacts();
        // Contoh data customer (gantilah dengan cara mendapatkan data sesuai proyek Anda)
        $random_id = $this->ramdomId();
		$data['idTabMenu'] = 'listcustomer'.$random_id;
		$this->load->view('customer/listCustomer',$data);
    }

    public function billCustomer() {
        $data['idTabMenu'] = 'billCustomer255';
        $data['dataBill']  = $this->getListBillData();
        // var_dump($data['dataBill']);
        $this->load->view('customer/billCustomer/index',$data);
    }

    public function addBillCustomer() {
        $data['idTabMenu']  = 'addBillCustomer255';
        $this->load->view('customer/billCustomer/addBill',$data);
    }

    // public function loadFormAddCustomer() {
    //     // Load view "addCustomer.php" secara dinamis
    //     $this->load->view('customer/addCustomer');
    // }

    public function view($contactId) {
        // Tampilkan detail kontak berdasarkan ID
        $data['contact'] = $this->Contact_model->getContactById($contactId);
        $this->load->view('contact/view', $data);
    }

    public function getListCsData() {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        // var_dump($startDate);
        // var_dump($endDate);
        // die();
        $siteId = $this->getSiteId();
        // var_dump('s',$siteId);
        // die();
        $data = $this->Customer_Model->getCustomerAll($siteId, $startDate, $endDate);
        echo json_encode($data);

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
        return $data;
    }

    public function getAllData() {
        $startDate = NULL;
        $endDate = NULL;
        $siteId = $this->getSiteId();
        
        $data = $this->Customer_Model->getCustomerAll($siteId, $startDate, $endDate);
        
        echo json_encode($data);
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

    public function storeData() {

        $siteId = $this->getSiteId();
        
        // Mengambil data dari POST
        $firstName = $this->input->post('firstName');
        $lastName = $this->input->post('lastName');
        $whatsapp = $this->input->post('whatsapp');
        $email = $this->input->post('email');
        $product = $this->input->post('product');
        $contactGroup = $this->input->post('contactGroup');
        // var_dump($contactGroup);
        if($contactGroup == ''){
            $contactGroup = NULL;
        }
        $address = $this->input->post('address');

        $userId = $this->getUserId();

        // $imageId = $this->uploadImage($myImage,$userId);

        $dataCustomer = array(
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'NikNumber' => NULL,
            'ProductId' => $product,
            'SiteId' => $siteId,
            'StatusId' => 'CRS1',
            'CityBorn' => NULL,
            'DateOfBirth' => NULL,
            'Gender' => NULL,
            'Phone' => NULL,
            'whatsapp' => $whatsapp,
            'Email' => $email,
            'Address' => $address,
            'LastLogin' => NULL,
            'ImageId' => NULL,
            'RtRw' => NULL,
            'ward' => NULL,
            'Subdistrict' => NULL,
            'City' => NULL,
            'Province' => NULL,
            'Creator' => $userId,
            'CreateDate' => date('Y-m-d H:i:s'),
            'Modifier' => $userId,
            'ModifyDate' => date('Y-m-d H:i:s')
        );

        $customerId = $this->Customer_Model->insertCustomer($dataCustomer);

        $dataContact = array(
            'Name' => $firstName.' '.$lastName,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'Email' => $email,
            'Phone' => $whatsapp,
            'whatsapp' => $whatsapp,
            'Mobile' => $whatsapp,
            'CustomerId' => $customerId,
            'GroupId' => $contactGroup,
            'StatusId' => 'CTS1',
            'SiteId' => $siteId,
            'Creator' => $userId,
            'CreateDate' => date('Y-m-d H:i:s'),
            'Modifier' => $userId,
            'ModifyDate' => date('Y-m-d H:i:s')
        );

            
        $data = $this->Contact_Model->insertContact($dataContact);
        if($data == 'success') {
            echo json_encode(array('status' => 'success', 'message' => 'Message data success to save.'));
        }else {
            var_dump($data);
            echo json_encode(array('status' => 'failed', 'message' => 'Customer data failed to save.'));
        }
    }

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

    public function ramdomId()
    {
        // Mendefinisikan panjang maksimal ID
        $max_length = 5;

        // Generate random ID
        $random_id = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $max_length);

        // Print the random ID
        return $random_id;
    }

    public function uploadImage($imageData,$userId) {
        ini_set('upload_max_filesize', '20M');
        ini_set('post_max_size', '20M');
        // Upload gambar dan convert ke BLOB
        $imageData = file_get_contents($_FILES['myImage']['tmp_name']);
        $imageBLOB = base64_encode($imageData);
        // Mendapatkan nama file
        $fileName = pathinfo($_FILES['myImage']['name'], PATHINFO_FILENAME);
        $filePath = $_FILES['myImage']['name'];
        $fileSize = $_FILES['myImage']['size'];
        $fileType = $_FILES['myImage']['type'];

        var_dump($filePath);
        // die();
        // Data untuk insert ke tabel
        $fileData = array(
            'Name' => $fileName,
            'Size' => $fileSize,
            'Date' => date('Y-m-d H:i:s'),
            'ContentType' => $fileType,
            'Path' => $filePath, // Menggunakan nama file sebagai path
            'Content' => $imageBLOB,
            'Creator' => $userId, // Sesuaikan dengan pembuat
            'CreateDate' => date('Y-m-d H:i:s'),
            'Modifier' => $userId,
            'ModifyDate' => date('Y-m-d H:i:s')
        );

        // Panggil fungsi model untuk insert data
        $insertedId = $this->File_Model->insertFile($fileData);
        if ($insertedId !== false) {
            // Data berhasil di-insert, $insertedId berisi ID dari baris yang baru
            return $insertedId;
        } else {
            // Gagal insert, tambahkan penanganan kesalahan jika diperlukan
            echo "Gagal insert data.";
        }
    }

    // public function edit($contactId) {
    //     // Form untuk mengedit kontak berdasarkan ID
    //     $data['contact'] = $this->Contact_model->getContactById($contactId);
    //     $this->load->view('contact/edit', $data);
    // }

    // public function update($contactId) {
    //     // Simpan perubahan pada kontak
    //     $data = array(
    //         'Name' => $this->input->post('name'),
    //         'Email' => $this->input->post('email'),
    //         // ... (tambahkan kolom lain sesuai kebutuhan)
    //     );

    //     $this->Contact_model->updateContact($contactId, $data);

    //     // Redirect ke halaman detail kontak
    //     redirect('contact/view/' . $contactId);
    // }

    // public function delete($contactId) {
    //     // Hapus kontak berdasarkan ID
    //     $this->Contact_model->deleteContact($contactId);

    //     // Redirect ke halaman daftar kontak
    //     redirect('contact/index');
    // }
}