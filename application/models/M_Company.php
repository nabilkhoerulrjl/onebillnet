<?php
    class M_Company extends CI_Model {
        function domainData($table,$where){		
            return $this->db->get_where($table,$where);
        }

        function companyName($table,$where){
            $queryGetCompany = $this->db->get_where($table,$where);
            $dataCompany = $queryGetCompany->result();
            $dataCompanyName = null;
            foreach($dataCompany as $data) {
                $dataCompanyName = $data->CompanyName;
            }
            return $dataCompanyName;
        }
    }
?>