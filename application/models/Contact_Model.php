<?php
    class Contact_Model extends CI_Model {
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

        public function getAllContacts() {
            $query = $this->db->get('Contact');
            return $query->result_array();
        }

        public function insertContact($data) {
            $this->db->insert('Contact', $data);
            if ($this->db->affected_rows() > 0) {
                // Jika insert berhasil, kembalikan pesan berhasil
                return 'success';
            } else {
                // Jika insert gagal, kembalikan pesan error
                $error = $this->db->error();
                return 'Gagal insert data. Error: ' . $error['message'];
            }
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