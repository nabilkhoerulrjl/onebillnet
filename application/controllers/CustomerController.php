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
        $this->load->view('customer/listCustomer');
    }

    public function view($contactId) {
        // Tampilkan detail kontak berdasarkan ID
        $data['contact'] = $this->Contact_model->getContactById($contactId);
        $this->load->view('contact/view', $data);
    }

    public function getListData() {
        $startDate = $this->input->post('startDate');
        $endDate = $this->input->post('endDate');
        // var_dump($startDate);
        // var_dump($endDate);
        // die();
        $siteId = $this->getSiteId();
        // var_dump('s',$siteId);
        // die();
        $this->load->model('Customer_model');
        $this->db->select('c.Id AS CustomerId, c.FirstName, c.LastName,
                            c.Whatsapp,c.RtRw,c.Ward, 
                            c.Subdistrict, c.City,
                            c.Province,pd.Name AS ProductName,
                            c.StatusId AS StatusSubsribe,
                            b.StatusId AS StatusBill,
                            c.ActiveDate AS DateSubsribe');
        $this->db->from('Customer as c');
        $this->db->join('Product as pd', 'c.ProductId = pd.Id', 'LEFT');
        $this->db->join('Bill as b', 'c.Id = b.CustomerId', 'LEFT');
        $this->db->where('c.SiteId =', $siteId);
        $this->db->where('c.CreateDate >=', $startDate);
        $this->db->where('c.CreateDate <=', $endDate);
        $this->db->order_by('c.CreateDate', 'desc');

        $queryGet = $this->db->get();
        
        $data = $this->Customer_model->getCustomerByCustom($queryGet);
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

    // public function store() {
    //     // Simpan kontak baru
    //     $data = array(
    //         'Name' => $this->input->post('name'),
    //         'Email' => $this->input->post('email'),
    //         // ... (tambahkan kolom lain sesuai kebutuhan)
    //     );

    //     $contactId = $this->Contact_model->insertContact($data);

    //     // Redirect ke halaman detail kontak
    //     redirect('contact/view/' . $contactId);
    // }

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