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
            $this->db->select('c.Id as CustomerId, c.FirstName, c.LastName, c.Whatsapp, c.Email, pd.Name as ProductName, c.StatusId as StatusActive,  c.ActiveDate as ActiveDate,  c.Address as Address');//b.StatusId as StatusBill,
            $this->db->from('Customer as c');
            $this->db->join('Product as pd', 'c.ProductId = pd.Id', 'left');
            $this->db->where('c.SiteId', $siteId);
            if($startDate !== NULL && $endDate !== NULL) {
                $this->db->where('c.CreateDate >=', $startDate);
                $this->db->where('c.CreateDate <=', $endDate);
            }
            $this->db->order_by('c.CreateDate', 'ASC');
    
            $query = $this->db->get();
            // $query = $this->db->get('nama_tabel');
            // echo $this->db->last_query();
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

        public function getBillCustomer($select, $join, $where) {

            $this->db->select($select);
            $this->db->from('Customer as c');
            $this->db->join($join['join1'][0], $join['join1'][1], $join['join1'][2]);
            $this->db->join($join['join2'][0], $join['join2'][1], $join['join2'][2]);
            $this->db->where('c.StatusId','CRS1');
            $this->db->where('c.SiteId',$where);
            $this->db->where('b.ExternalId IS NOT NULL');
            $query = $this->db->get();
            $rawQuery = $this->db->last_query();
            // var_dump($rawQuery);
            return $query->result();
        }

        public function getCustomer($select, $join, $where) {

            $this->db->select($select);
            $this->db->from('Customer as c');
            $this->db->join($join[0], $join[1], $join[2]);
            $this->db->where('c.SiteId', 1);
            $this->db->where('c.StatusId','CRS1');
            $this->db->where_in('c.Id',$where);
            $rawQuery = $this->db->last_query();

            $query = $this->db->get();
            return $query->result();
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

        public function updateCustomer($customerId, $data) {
            $this->db->where('Id', $customerId);
            $this->db->update('Customer', $data);
            // Memeriksa apakah ada baris yang terpengaruh oleh operasi update
            if ($this->db->affected_rows() > 0) {
                return true; // Jika ada baris yang terpengaruh, update berhasil
            } else {
                return false; // Jika tidak ada baris yang terpengaruh, update gagal
            }
        }

        public function deleteCustomer($contactId) {
            $this->db->delete('Contact', array('Id' => $contactId));
        }

        // Tambahkan metode lain sesuai kebutuhan Anda
    }