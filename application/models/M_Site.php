<?php
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
    }
?>