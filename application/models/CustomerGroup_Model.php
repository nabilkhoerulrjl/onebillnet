<?php
    class CustomerGroup_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function getDataByCustomerId($select, $where) {
            // $query = $this->db->get_where('Contact', array('Id' => $contactId));
            // return $query->row_array();
            $this->db->select($select);
            $this->db->from('CustomerGroup');
            $this->db->where('SiteId', $where['SiteId']);
            $this->db->where('CustomerId', $where['CustomerId']);
            // $this->db->order_by('Id', 'desc');
            // $rawQuery = $this->db->last_query();

            $query = $this->db->get();
            return $query->result();
        }

        // Fungsi untuk menyimpan data grup kontak ke dalam database
        public function storeData($data) {
            var_dump($data);
            $this->db->insert('CustomerGroup', $data);
            if ($this->db->affected_rows() > 0) {
                return true; // Jika ada baris yang terpengaruh, update berhasil
            } else {
                return false; // Jika tidak ada baris yang terpengaruh, update gagal
            }
        }

        public function editData($id, $data) {
            $this->db->where('CustomerId', $id);
            $this->db->update('CustomerGroup', $data);

            if ($this->db->affected_rows() > 0) {
                return true; // Jika ada baris yang terpengaruh, update berhasil
            } else {
                return false; // Jika tidak ada baris yang terpengaruh, update gagal
            }
        }

        public function deleteData($data) {
            $this->db->delete('CustomerGroup', array('CustomerId' => $data));
        }
    }