<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$env = getenv('APP_ENV');



class Login_Controller extends CI_Controller {
	if ($env === 'development') {
		// Logika untuk lingkungan pengembangan
		echo "Aku"
	} else if ($env === 'production') {
		// Logika untuk lingkungan produksi
	}
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
	public function index()
	{
		$companyName = $this->getSiteName();
		// $settingCopyrightOwner = $this->getSettingCopyrightOwner();
		// $settingCopyrightYear = $this->getSettingCopyrightYear();
		$data = array(
			'title' => $companyName,
			'owner' => 'Nabil@ Home Code Project',//$settingCopyrightOwner,
			'year' => '2002',//$settingCopyrightYear,
		);
		$this->load->view('login/index',$data); 
	}

	public function getDataUser() 
	{
		$email = $this->input->post('Email');
		$password = $this->input->post('Password');
		$host = $_SERVER['HTTP_HOST'];
		$where = array(
			'Email' => $email,
			'Password' => $password
		);

		$this->load->model('M_Login');
		$data['dataUser'] = $this->M_Login->loginData('Users', $where);
		// var_dump($data['dataUser']->Email);
		if (!empty($data['dataUser'])) { // Ubah kondisi ini
			$data_session = array(
				'name' => $data['dataUser']->UserName,
				'status' => "login",
				'host' => $host,
				'role' => $data['dataUser']->RoleName,
				'picture' => $data['dataUser']->JpegPicture, // Gunakan JpegPicture yang telah disetel sebelumnya
			);

			if (!empty($this->input->post("remember"))) {
				setcookie("loginId", $email, time() + (10 * 365 * 24 * 60 * 60));
				setcookie("loginPass", $password, time() + (10 * 365 * 24 * 60 * 60));
			} else {
				setcookie("loginId", "");
				setcookie("loginPass", "");
			}
			$this->session->set_userdata($data_session);
			redirect(base_url("welcome"));
		} else {
			$companyName = $this->getSiteName();
			$data = array(
				'alertMessage' => 'Username atau password salah !',
				'title' => $companyName,
				'owner' => 'Nabil@ Home Code Project',//$settingCopyrightOwner,
				'year' => '2002',//$settingCopyrightYear,
			);
			$this->load->view('Login/index', $data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('Login_Controller/index'));
	}

	public function getSiteName() {
		$siteId = $this->getSiteId();
		$where = array(
			'Id' => $siteId,
		);
        $company = $this->M_Site->siteName("site",$where);
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
			'Domain' => 'homewifi.com'//$domain,
		);
        
        $site = $this->M_Site->siteId("Site",$where);
		// var_dump($site);
		// // var_dump($site);
		// die();
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

	// public function getSettingCopyrightYear() {
	// 	$siteId = $this->getSiteId();
	// 	$where = array(
	// 		'SiteId' => $siteId,
	// 		'Code' => 'CopyrightYear',
	// 	);
    //     $Setting = $this->M_Setting->copyrightYear("setting",$where);
    //     $SettingCopyrightYear = null;
    //     if(isset($Setting)){
    //         $SettingCopyrightYear = $Setting;
	// 		//echo $companyName;
    //     }else{
    //         echo "Company Not Found !";
    //     }
	// 	//echo $SettingCopyrightYear;
	// 	return $SettingCopyrightYear;
	// } 

	// public function getSettingCopyrightOwner() {
	// 	$siteId = $this->getSiteId();
	// 	$where = array(
	// 		'SiteId' => $siteId,
	// 		'Code' => 'CopyrightOwner',
	// 	);
    //     $Setting = $this->M_Setting->copyrightYear("setting",$where);
    //     $SettingCopyrightOwner = null;
    //     if(isset($Setting)){
    //         $SettingCopyrightOwner = $Setting;
	// 		//echo $companyName;
    //     }else{
    //         echo "Setting Not Found !";
    //     }

	// 	//echo $SettingCopyrightOwner;
	// 	return $SettingCopyrightOwner;
	// } 

    //         echo "Setting Not Found !";
    //     }

	// 	//echo $SettingCopyrightOwner;
	// 	return $SettingCopyrightOwner;
	// } 
	}