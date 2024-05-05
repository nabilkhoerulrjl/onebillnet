<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class Site_Model extends CI_Model {
        function siteId($table,$where){
            $queryGetSite = $this->db->get_where($table,$where);
            $dataSites = $queryGetSite->result();
            $dataSiteId = null;
            foreach($dataSites as $data) {
                $dataSiteId = $data->Id;
            }
            return $dataSiteId;
        }

        function siteName($table,$where){
            $queryGetCompany = $this->db->get_where($table,$where);
            $dataCompany = $queryGetCompany->result();
            $dataCompanyName = null;
            foreach($dataCompany as $data) {
                $dataCompanyName = $data->Name;
            }
            return $dataCompanyName;
        }

        public function getSiteInfo($domain) {
            return $this->db->get_where('site', ['Domain' => $domain])->row_array();
        }

        public function getCompanyData($select, $where) {
            $this->db->select($select);
            $this->db->from('Site');
        
            // Jika hanya satu nilai, gunakan where biasa
            $this->db->where('Id', $where);
        
            $query = $this->db->get();
            // echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                $result = $query->result();
                return $result;
            } else {
                return null;
            }
        }
    }
?>