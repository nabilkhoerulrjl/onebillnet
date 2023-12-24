<?php
    class Customer_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function getCustomerById($contactId) {
            $query = $this->db->get_where('Contact', array('Id' => $contactId));
            return $query->row_array();
        }

        public function getCustomerByCustom($queryGet) {
            $result = $queryGet->result();
            // echo $this->db->last_query();
            // var_dump($result);
            return $result;

            
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
            $this->db->insert('Contact', $data);
            return $this->db->insert_id();
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