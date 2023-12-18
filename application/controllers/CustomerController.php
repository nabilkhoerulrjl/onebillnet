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
        $data['contacts'] = $this->Contact_model->getAllContacts();
        $this->load->view('contact/index', $data);
    }

    public function view($contactId) {
        // Tampilkan detail kontak berdasarkan ID
        $data['contact'] = $this->Contact_model->getContactById($contactId);
        $this->load->view('contact/view', $data);
    }

    public function getListData() {
        $siteId = $this->getSiteId();
        echo "wqqwesadqwre";
        $query = 'SELECT
            
            FROM Customer c
            JOIN Product p ON c.ProductId = p.Id
            LEFT JOIN Bill b ON c.Id = b.CustomerId
            LEFT JOIN Contact ct ON c.ContactId = ct.Id
            WHERE
            SiteId = ?';
        $result = $this->db->query($query, array($siteId))->result();
        $this->db->select('c.Id AS CustomerId, c.FirstName, c.LastName,c.Email,c.Phone,
                            c.Whatsapp,c.RtRw,c.Ward,
                            c.Subdistrict,
                            c.City,
                            c.Province,
                            p.Name AS ProductName,
                            c.StatusId AS SubscriptionStatus,
                            b.StatusId AS BillStatus,
                            c.Gender,
                            c.CreateDate AS RegistrationDate');
        $this->db->from('nama_tabel1 as t1');
        $this->db->join('nama_tabel2 as t2', 't1.common_column = t2.common_column', 'INNER');
        $this->db->where('t1.tanggal_kolom >= DATE_SUB(CURDATE(), INTERVAL 3 MONTH)', NULL, FALSE);
        $this->db->where('t1.site_id', $siteid);

        $query = $this->db->get();
        $result = $query->result();

        // $this->load->view('contact/create');

    }

    public function getSiteId()
    {
        $domain = $_SERVER['HTTP_HOST'];
        if (!$domain) {
            $domain = $_SERVER['SERVER_NAME'];
        }
        $where = array(
			'Domain' => 'homewifi.com'//$domain,
		);
        
        $site = $this->M_Site->siteId("Site",$where);
		// var_dump($site);
		// // var_dump($site);
		// die();
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