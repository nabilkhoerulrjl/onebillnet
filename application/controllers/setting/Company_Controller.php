<?php

use LDAP\Result;

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_Controller extends CI_Controller {

    public function index() {
        
        $this->load->view('setting/companyProfile');
        
    }

    public function getSiteDomain() {
        $base_Url = $_SERVER['HTTP_HOST'];
		$where = array(
			'Domain' => $base_Url,
			);
		$cek = $this->M_Company->domainData("site",$where)->num_rows();
		if($cek > 0){
			echo $this->getSiteId();
		}else{
			echo "Username dan password salah !";
		}
    }

    public function getSiteId()
    {
        $domain = $_SERVER['HTTP_HOST'];
        if (!$domain) {
            $domain = $_SERVER['SERVER_NAME'];
        }
        $where = array(
			'Domain' => $domain,
		);
        
        $site = $this->M_Site->siteId("site",$where);
        //$query = $this->db->get('site');
		//$arrays = $site->result();
        $siteId = null;
        if(isset($site)){
            $siteId = $site;
        }else{
            echo "SiteId Not Found !";
        }
        return $siteId;
	}
}
?>