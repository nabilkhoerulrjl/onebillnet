<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    class M_Site extends CI_Model {
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
            return $this->db->get_where('Site', ['Domain' => $domain])->row_array();
        }
    }
?>