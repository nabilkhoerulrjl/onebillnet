<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TemplateController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Template_model');
    }

    // Fungsi untuk menampilkan semua data template
    public function index() {
        $data['templates'] = $this->Template_model->get_all_templates();
        $this->load->view('template/index', $data);
    }

    // Fungsi untuk menampilkan detail template berdasarkan ID
    public function detail($id) {
        $data['template'] = $this->Template_model->get_template_by_id($id);
        $this->load->view('template/detail', $data);
    }

    // Fungsi untuk menambahkan data template
    public function create() {
        // Proses penanganan form submission untuk menambahkan data
        // ...

        // Redirect atau tampilkan pesan sukses setelah penambahan data
    }

    // Fungsi untuk mengedit data template berdasarkan ID
    public function edit($id) {
        // Proses penanganan form submission untuk mengedit data
        // ...

        // Redirect atau tampilkan pesan sukses setelah pengeditan data
    }

    // Fungsi untuk menghapus data template berdasarkan ID
    public function delete($id) {
        $this->Template_model->delete_template($id);
        // Redirect atau tampilkan pesan sukses setelah penghapusan data
    }
}