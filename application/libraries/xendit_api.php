<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class xendit_api {

    protected $CI;

    public function __construct() {
        $this->CI = &get_instance();
    }

    public function CreateInvoice($invoices) {
    
        // Inisialisasi array untuk menyimpan respons
        $allResponses = array();
        
        // Loop untuk setiap invoice
        for ($j = 0; $j < $invoices['index']; $j++) {
            $responses = array(); // Array untuk menyimpan respons dari satu iterasi
            foreach ($invoices['data'] as $invoice) {
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.xendit.co/v2/invoices',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => json_encode($invoice),
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Basic eG5kX2RldmVsb3BtZW50X1o0WVNhbHpjZkJsZ1RIVncxeG1uRlFTdGZCZmlXcmJiZVJXT3E3S1ZGd3FnOG53ZFhGUGtsZEllU0I2Rzo6',
                        // ... tambahkan header lainnya sesuai kebutuhan
                    ),
                ));
    
                $response = curl_exec($curl);
    
                // Tambahkan respons ke array untuk satu invoice
                $responses[] = json_decode($response);
    
                curl_close($curl);
            }
        }
        // return the array yang menyimpan array dari setiap iterasi
        return $responses;
    }
    
}