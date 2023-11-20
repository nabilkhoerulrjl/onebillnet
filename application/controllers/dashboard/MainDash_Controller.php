<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainDash_Controller extends CI_Controller {

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
		
		$this->load->model('M_Bill');
        $data['summaryData'] = $this->M_Bill->getDashboardData();
		$this->load->view('dashboard/mainDashboard',$data);
	}

	// public function getDashSumarryData(){
	// 	$this->load->model('M_Bill');
    //     $data['dashboardData'] = $this->M_Bill->getDashboardData();
	// 	return $data['dashboardData'];
	// 	var_dump($data['dashboardData']);
	// }
}
