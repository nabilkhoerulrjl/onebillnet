<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	function __construct(){
		parent::__construct();
		if($this->session->userdata('status') != "login"){
			redirect(base_url("Login_Controller/index"));
		}
	}

	public function index()
	{
		$this->load->view('admin/dashboard');
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
