<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contact_model');
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
}