<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillReminder_Controller extends CI_Controller {

	// function __construct(){
	// 	parent::__construct();
	// 	if($this->session->userdata('status') != "login"){
	// 		redirect(base_url("Login_Controller/index"));
	// 	}
	// }

	public function index()
	{
		$this->load->view('broadcast/billReminder');
	}
/*
	public function mainDashboard()
	{
		$this->load->view('menu/mainDashboard');
	}
*/
	public function getCompanyName() {
		$siteId = $this->getSiteId();
		$where = array(
			'Id' => $siteId,
		);
        $company = $this->M_Company->companyName("company",$where);
        //$query = $this->db->get('site');
		//$arrays = $site->result();
        $companyName = null;
        if(isset($company)){
            $companyName = $company;
			//echo $companyName;
        }else{
            echo "Setting Not Found !";
        }

		//echo $companyName;
		return $companyName;
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
