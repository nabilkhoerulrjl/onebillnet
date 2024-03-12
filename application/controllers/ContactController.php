<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->userdata('status') != "login"){
			redirect(base_url("Login_Controller/index"));
		}
        $this->load->model('Contact_model');
    }


    public function index() {
        // Tampilkan daftar semua kontak
        // $data['contacts'] = $this->Contact_model->getAllContacts();
        $this->load->view('customer/listCustomer');
    }

    public function viewContact() {
        $data['idTabMenu'] = 'Contact256';
        $data['dataContact']  = $this->getListContactData();
        $this->load->view('customer/contact/index',$data);
    }

    public function view($contactId) {
        // Tampilkan detail kontak berdasarkan ID
        $data['contact'] = $this->Contact_model->getContactById($contactId);
        $this->load->view('contact/view', $data);
    }

    public function create() {
        // Form untuk menambahkan kontak baru
        $this->load->view('contact/create');
    }

    public function store() {
        // Simpan kontak baru
        $data = array(
            'Name' => $this->input->post('name'),
            'Email' => $this->input->post('email'),
            // ... (tambahkan kolom lain sesuai kebutuhan)
        );

        $contactId = $this->Contact_model->insertContact($data);

        // Redirect ke halaman detail kontak
        redirect('contact/view/' . $contactId);
    }

    public function edit($contactId) {
        // Form untuk mengedit kontak berdasarkan ID
        $data['contact'] = $this->Contact_model->getContactById($contactId);
        $this->load->view('contact/edit', $data);
    }

    public function update($contactId) {
        // Simpan perubahan pada kontak
        $data = array(
            'Name' => $this->input->post('name'),
            'Email' => $this->input->post('email'),
            // ... (tambahkan kolom lain sesuai kebutuhan)
        );

        $this->Contact_model->updateContact($contactId, $data);

        // Redirect ke halaman detail kontak
        redirect('contact/view/' . $contactId);
    }

    public function delete($contactId) {
        // Hapus kontak berdasarkan ID
        $this->Contact_model->deleteContact($contactId);

        // Redirect ke halaman daftar kontak
        redirect('contact/index');
    }

    public function getListContactData() {
        // $startDate = $this->input->post('startDate');
        // $endDate = $this->input->post('endDate');
        $siteId = $this->getSiteId();
        $select = 'ct.Id, ct.Name, ct.Email,
        ct.Phone, ct.Whatsapp, gt.GroupName, ct.StatusId';
        $join1   = ['ContactGroup AS gt', 'ct.GroupId = gt.Id', 'left'];
        $where  = $siteId;
        $data = $this->Contact_Model->getAllData($select, $join1, $where);
        return $data;
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
}