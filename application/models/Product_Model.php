<?php
    class Product_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function getContactById($contactId) {
            $query = $this->db->get_where('Contact', array('Id' => $contactId));
            return $query->row_array();
        }

        public function getContactByAny($select, $where) {
            $this->db->select($select);
            $this->db->from('Contact');
        
            // Iterasi melalui array $where dan menambahkan kondisi WHERE
            foreach ($where as $column => $values) {
                $this->db->where_in($column, $values);
            }
        
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                return $result;
            } else {
                return null;
            }
        }

        public function getAllProduct($select, $where) {
            $this->db->select($select);
            $this->db->from('Product');

            // Iterasi melalui array $where dan menambahkan kondisi WHERE
            foreach ($where as $column => $values) {
                $this->db->where($column, $values);
            }
        
            $query = $this->db->get();
            $sql = $this->db->last_query();
            // var_dump($sql);
            if ($query->num_rows() > 0) {
                $result = $query->result();
            // var_dump($result);

                return $result;
            } else {
                return null;
            }
        }

        public function insertContact($data) {
            $this->db->insert('Contact', $data);
            return $this->db->insert_id();
        }

        public function updateContact($contactId, $data) {
            $this->db->where('Id', $contactId);
            $this->db->update('Contact', $data);
        }

        public function deleteContact($contactId) {
            $this->db->delete('Contact', array('Id' => $contactId));
        }

        // Tambahkan metode lain sesuai kebutuhan Anda
    }