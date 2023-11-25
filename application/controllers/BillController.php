<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Bill_Model');
    }

    public function index() {
        // Contoh mendapatkan semua data tagihan
        $data['bills'] = $this->Bill_Model->getAllBills();
        $this->load->view('bill/index', $data);
    }

    public function view($billId) {
        // Contoh mendapatkan data tagihan berdasarkan ID
        $data['bill'] = $this->Bill_Model->getBillById($billId);
        $this->load->view('bill/view', $data);
    }

    public function create() {
        // Contoh membuat tagihan baru
        $billData = array(
            'CustomerId' => 1,
            'SiteId' => 2,
            'Amount' => 100.00,
            'DueDate' => '2023-12-31',
            'StatusId' => 'Unpaid',
            'PaymentDate' => null,
            'Creator' => 'John Doe',
            'CreateDate' => date('Y-m-d H:i:s'),
            'Modifier' => 'John Doe',
            'ModifyDate' => date('Y-m-d H:i:s')
        );

        $newBillId = $this->Bill_Model->createBill($billData);

        // Lakukan sesuatu setelah membuat tagihan, seperti redirect atau menampilkan pesan sukses
    }

    public function update($billId) {
        // Contoh mengupdate data tagihan
        $updatedData = array(
            'Amount' => 150.00,
            'DueDate' => '2024-01-15',
            'Modifier' => 'Jane Doe',
            'ModifyDate' => date('Y-m-d H:i:s')
        );

        $this->Bill_Model->updateBill($billId, $updatedData);

        // Lakukan sesuatu setelah mengupdate tagihan, seperti redirect atau menampilkan pesan sukses
    }

    public function delete($billId) {
        // Contoh menghapus data tagihan
        $this->Bill_Model->deleteBill($billId);

        // Lakukan sesuatu setelah menghapus tagihan, seperti redirect atau menampilkan pesan sukses
    }
}
