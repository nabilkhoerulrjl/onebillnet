<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$env = getenv('APP_ENV');



class Login_Controller extends CI_Controller {
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
				'id' => $data['dataUser']->Id,
				'name' => $data['dataUser']->UserName,
				'status' => "login",
				'host' => $host,
				'siteid' => $data['dataUser']->SiteId,
				'role' => $data['dataUser']->RoleName,
				'picture' => $data['dataUser']->ImageId, // Gunakan JpegPicture yang telah disetel sebelumnya
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
			$this->load->view('login/index', $data);
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
        $company = $this->M_Site->siteName("Site",$where);
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
        $where = array('Domain' => $domain);
        
        $site = $this->M_Site->siteId("Site",$where);
		// require_once APPPATH . 'config/config.php';
        $siteId = null;
        if(isset($site)){
            $siteId = $site + 0;
        }else{
            $siteId = $this->config->item('site_id');
        }
        return $siteId;
	}

	public function forgotPassword(){
		$email = $this->input->post('Email');
		$host = $_SERVER['HTTP_HOST'];
		$where = array(
			'Email' => $email
		);
		$this->load->model('M_Login');
		$data['dataUser'] = $this->M_Login->getUserData('Users', $where);
		if($data['dataUser']) {
			$data = array(
				'email' => $data['dataUser']->Email,
				'alertMessageSuccess' => 'User Data Found',
			);
			$this->load->view('login/resetPassword',$data);
		}else{
			$data = array(
				'alertMessageDanger' => 'User Data Not Found',
			);
			$this->load->view('login/searchAccount',$data);
		}
		
	}

	public function searchAccount(){
		$this->load->view('login/searchAccount'); 
	}

	public function resetPassword(){
		$email = $this->input->post('Email');
		$newpassword = $this->input->post('NewPassword');
		$host = $_SERVER['HTTP_HOST'];
		$where = array(
			'Email' => $email
		);
		$this->load->model('M_Login');
		$data['dataUser'] = $this->M_Login->getUserData('Users', $where);
		if($data['dataUser']->Password == $newpassword) {
			$data = array(
				'email' => $data['dataUser']->Email,
				'alertMessageDanger' => 'Previous password cannot be used',
			);
			$this->load->view('login/resetPassword',$data);
		}else{
			$resetResult = $this->M_Login->resetPassword($email, $newpassword);
			if ($resetResult) {
				$companyName = $this->getSiteName();
				$data = array(
					'alertMessageSuccessReset' => 'Password Changed Successfully',
					'title' => $companyName,
					'email' => $email,
					'owner' => 'Nabil@ Home Code Project',//$settingCopyrightOwner,
					'year' => '2002',//$settingCopyrightYear,
				);
				$this->load->view('login/resetPassword',$data);
			}
		}
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