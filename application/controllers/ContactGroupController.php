<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactGroupController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Contactgroup_model');
    }

    // Fungsi untuk menampilkan semua data grup kontak
    public function index() {
        $data['contactgroups'] = $this->Contactgroup_model->get_all_contactgroups();
        $this->load->view('contactgroup/index', $data);
    }

    // Fungsi untuk menampilkan detail grup kontak berdasarkan ID
    public function detail($id) {
        $data['contactgroup'] = $this->Contactgroup_model->get_contactgroup_by_id($id);
        $this->load->view('contactgroup/detail', $data);
    }

    // Fungsi untuk menambahkan data grup kontak
    public function create() {
        // Proses penanganan form submission untuk menambahkan data
        // ...

        // Redirect atau tampilkan pesan sukses setelah penambahan data
    }

    // Fungsi untuk mengedit data grup kontak berdasarkan ID
    public function edit($id) {
        // Proses penanganan form submission untuk mengedit data
        // ...

        // Redirect atau tampilkan pesan sukses setelah pengeditan data
    }

    // Fungsi untuk menghapus data grup kontak berdasarkan ID
    public function delete($id) {
        $this->Contactgroup_model->delete_contactgroup($id);
        // Redirect atau tampilkan pesan sukses setelah penghapusan data
    }
}
