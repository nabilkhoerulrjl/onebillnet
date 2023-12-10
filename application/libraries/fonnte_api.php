<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fonnte_api {

    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }

    public function sendMessage($targets, $message, $delay = 2, $scedule, $countryCode = '62') {
        $curl = curl_init();
        
        $toTargets ="";
        if(is_array($targets)){
            // Convert the targets array into the desired format
            $formattedTargets = array();
            foreach ($targets as $number => $name) {
                $formattedTargets[] = $number . '|' . $name;
            }
            $toTargets = implode(',', $formattedTargets);
        }else{
            $toTargets = $targets;
        }

        // var_dump($toTargets);

        // echo implode(',', $formattedTargets);
        $postData = array(
            'target' => $toTargets,
            'message' => $message,
            'delay' => $delay,
            'schedule' => $scedule,
            'countryCode' => $countryCode,
        );
    
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
                'Authorization: ooT5x+1Y4fcHCgtpFnQn', // Replace TOKEN with your actual token
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
}