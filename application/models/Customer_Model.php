<?php
    class Customer_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function getCustomerById($Id) {
            $this->db->select('c.Id as Id, c.FirstName, c.LastName, c.Whatsapp, c.Email, c.StatusId as StatusActive,  c.ActiveDate as ActiveDate, c.ProductId as ProductId, crg.GroupContactId, ct.Id as ContactId, c.Address as Address');//b.StatusId as StatusBill,
            $this->db->from('Customer as c');
            $this->db->join('CustomerGroup as crg', 'c.Id = crg.CustomerId', 'left');
            $this->db->join('Contact as ct', 'c.Id = ct.CustomerId', 'left');
            $this->db->where('c.Id', $Id);
            return $this->db->get()->row_array();
        }

        public function getCustomerAll($siteId, $startDate, $endDate) {
            $this->db->select('c.Id as Id, c.FirstName, c.LastName, c.Whatsapp, c.Email, pd.Name as ProductName, c.StatusId as StatusActive,  c.ActiveDate as ActiveDate,  c.Address as Address');//b.StatusId as StatusBill,
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

        public function getCustomer($select, $join, $where) {

            $this->db->select($select);
            $this->db->from('Customer as c');
            $this->db->join($join[0], $join[1], $join[2]);
            $this->db->where('c.SiteId', $where['siteId']);
            $this->db->where_not_in('c.StatusId',$where['statusId']);
            $this->db->where_in('c.Id',$where['customerId']);
            $rawQuery = $this->db->last_query();

            $query = $this->db->get();
            return $query->result();
        }

        public function getCustomerBill($select, $join, $where) {

            $this->db->select($select);
            $this->db->from('Customer as c');
            $this->db->join($join['join1'][0], $join['join1'][1], $join['join1'][2]);
            $this->db->join($join['join2'][0], $join['join2'][1], $join['join2'][2]);
            $this->db->where('c.SiteId', $where['siteId']);
            $this->db->where_not_in('c.StatusId',$where['statusId']);
            $this->db->where_in('c.Id',$where['customerId']);
            $rawQuery = $this->db->last_query();
            // var_dump($rawQuery);
            // die();
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

        // Fungsi untuk menghapus data pelanggan dan kontak berdasarkan ID pelanggan
        public function deleteCustomerAndContact($customerId) {
            // Ambil ID kontak dari tabel 'contact' berdasarkan ID pelanggan
            $this->db->select('Id');
            $this->db->where('CustomerId', $customerId);
            $contactIds = $this->db->get('Contact')->result_array();

            // Dapatkan array dari ID kontak
            $contactIdsArray = array_column($contactIds, 'Id');

            // Hapus data kontak dari tabel 'contact' berdasarkan ID kontak yang ditemukan
            if (!empty($contactIdsArray)) {
                $this->db->where_in('Id', $contactIdsArray);
                $this->db->delete('Contact');
            }

            // Hapus data pelanggan dari tabel 'customer' berdasarkan ID pelanggan
            $this->db->where('Id', $customerId);
            return $this->db->delete('Customer');
        }

        public function getDataParamTemplate($selectFields, $joinBill=null,$joinSite=null,$orderClause=null,$where){
            $this->db->select($selectFields);

            $this->db->from('Customer cs');
            // define join
            if($joinBill != null){
                $this->db->join($joinBill[0], $joinBill[1], $joinBill[2]);
            }
            if($joinSite != null){
                $this->db->join($joinSite[0], $joinSite[1], $joinSite[2]);
            }
            $this->db->where('cs.SiteId', $where['cs.SiteId']);
            $this->db->where_in('cs.Id',$where['cs.CustomerId']);
            if($orderClause != null){
                $this->db->order_by($orderClause);
            }
            // Eksekusi query
            $query = $this->db->get();
            $rawQuery = $this->db->last_query();
            // var_dump($rawQuery);
            // Periksa apakah query berhasil dieksekusi
            if ($query) {
                // Ambil hasil query dalam bentuk array
                return $query->result_array();
            } else {
                // Tampilkan pesan jika query gagal dieksekusi
                return false;
            }
        }
    }