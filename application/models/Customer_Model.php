<?php
    class Customer_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function getCustomerById($contactId) {
            $query = $this->db->get_where('Contact', array('Id' => $contactId));
            return $query->row_array();
        }

        public function getCustomerAll($siteId, $startDate, $endDate) {
            $this->db->select('c.Id as CustomerId, c.FirstName, c.LastName, c.Whatsapp, c.RtRw, c.Ward, c.Subdistrict, c.City, c.Province, pd.Name as ProductName, c.StatusId as StatusSubsribe, b.StatusId as StatusBill, c.ActiveDate as DateSubsribe');
            $this->db->from('Customer as c');
            $this->db->join('Product as pd', 'c.ProductId = pd.Id', 'left');
            $this->db->join('Bill as b', 'c.Id = b.CustomerId', 'left');
            $this->db->where('c.SiteId', $siteId);
            $this->db->where('c.CreateDate >=', $startDate);
            $this->db->where('c.CreateDate <=', $endDate);
            $this->db->order_by('c.CreateDate', 'ASC');
    
            $query = $this->db->get();
            return $query->result();

            
            // die();
            // Iterasi melalui array $where dan menambahkan kondisi WHERE
            // foreach ($where as $column => $values) {
            //     $this->db->where_in($column, $values);
            // }
        
            // $query = $this->db->get();
            // if ($query->num_rows() > 0) {
            //     $result = $query->result();
            //     return $result;
            // } else {
            //     return null;
            // }
        }

        public function getAllCustomer() {
            $query = $this->db->get('Contact');
            return $query->result_array();
        }

        public function insertCustomer($data) {
                // Memulai transaksi database
            $this->db->trans_start();
            // Masukkan data ke tabel 'Customer'
            $this->db->insert('Customer', $data);

            // Ambil ID yang baru saja dimasukkan
            // Ambil data yang baru saja diinsert
            $insertedId = $this->db->insert_id();
            $result = $this->db->get_where('Customer', ['Id' => $insertedId])->row();
            // var_dump($result);
            // die();

            // Menyelesaikan transaksi
            $this->db->trans_complete();

            // Periksa apakah transaksi berhasil atau tidak
            if ($this->db->trans_status() === false) {
                // Jika terjadi kesalahan, kembalikan false atau sesuaikan dengan kebutuhan
                return false;
            } else {
                // Jika berhasil, kembalikan ID pesan yang baru saja dimasukkan
                return $result->Id;
            }
        }

        public function updateCustomer($contactId, $data) {
            $this->db->where('Id', $contactId);
            $this->db->update('Contact', $data);
        }

        public function deleteCustomer($contactId) {
            $this->db->delete('Contact', array('Id' => $contactId));
        }

        // Tambahkan metode lain sesuai kebutuhan Anda
    }