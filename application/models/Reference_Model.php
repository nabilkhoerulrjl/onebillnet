<?php
    class Reference_Model extends CI_Model {
        public function __construct() {
            parent::__construct();
        }

        public function getAllStatusCustomer($select, $where) {
            $this->db->select($select);
            $this->db->from('Reference');

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
    }