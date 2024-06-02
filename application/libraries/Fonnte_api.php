<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fonnte_api {

    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }

    public function sendMessage($dataMessage) {
        $getConnApi = $this->getConApiKey($dataMessage['from']);
        $apiKey = $getConnApi[0]->Token;
        $curl = curl_init();
        
        $toTargets ="";
        // if(is_array($targets)){
        //     // Convert the targets array into the desired format
        //     $formattedTargets = array();
        //     foreach ($targets as $number => $name) {
        //         $formattedTargets[] = $number . '|' . $name;
        //     }
        //     $toTargets = implode(',', $formattedTargets);
        // }else{
        //     $toTargets = $targets;
        // }

        // echo implode(',', $formattedTargets);
        $postData = array(
            'target' => $dataMessage['targets'],
            'message' => $dataMessage['message'],
            'delay' => $dataMessage['delay'],
            'schedule' => $dataMessage['schedule'],
            'countryCode' => $dataMessage['countryCode'],
        );
        // var_dump($postData);
    
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.$apiKey, // Replace TOKEN with your actual token
            ),
        ));
    
        $response = curl_exec($curl);
    
        curl_close($curl);
    
        return $response;
    }

    public function sendPostRequest($url, $headers = array(), $data = array()) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => $headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return $response;
    }

    public function getConApiKey($from) {
        $siteId = $this->getSiteId();
        $CI =& get_instance(); // Mendapatkan instance CI

        // Memuat model yang diperlukan
        $CI->load->model('ConnectionModel');

        $select = 'conn.Name, conn.Token';
        $arrWhere = array(
            'SiteId' => $siteId,
            'StatusId' => 'CNS1',
            'MediaId'  => 'WHATP',
            'UserName' => $from,
        );
        $dataConn = $CI->ConnectionModel->getConnActive($select, $arrWhere);

        return $dataConn;
    }

    public function getSiteId()
    {
		$siteId  ="0";
		// Load the session library
        $this->CI =& get_instance();
        // Memuat library session
        $this->CI->load->library('session');
        if ($this->CI->session->has_userdata('siteid')) {
            // Retrieve its value
            $siteId = $this->CI->session->userdata("siteid");
        }
        return $siteId;
	}
}