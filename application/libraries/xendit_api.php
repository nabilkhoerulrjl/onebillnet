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

    public function ExpireInvoice($refId) {
        $variableType = gettype($refId);
        // var_dump($variableType);
        // die();
        $curl = curl_init();
        $responses = array();
        $invoiceId;
        // Jika $refId adalah string, langsung set sebagai invoiceId
        if ($variableType == 'string') {
            $invoiceId = $refId;
            // Kirim permintaan untuk invoice tunggal
            $responses[] = $this->sendExpireRequest($curl, $invoiceId);
        } elseif ($variableType == 'array') {
            // Jika $refId adalah array, loop dan kirim permintaan untuk setiap invoice
            foreach ($refId as $invoiceId) {
                $responses[] = $this->sendExpireRequest($curl, $invoiceId);
            }
        }
        
        curl_close($curl);
        
        // Gabungkan semua respons menjadi satu jika lebih dari satu elemen dalam array
        $combinedResponse = (count($responses) > 1) ? $responses : $responses[0];
        // echo "Combined Response: $combinedResponse";
        return $combinedResponse;
    }

    private function sendExpireRequest($curl, $invoiceId) {
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.xendit.co/invoices/' . $invoiceId . '/expire!',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic eG5kX2RldmVsb3BtZW50X1o0WVNhbHpjZkJsZ1RIVncxeG1uRlFTdGZCZmlXcmJiZVJXT3E3S1ZGd3FnOG53ZFhGUGtsZEllU0I2Rzo6',
                'Cookie: __cf_bm=xW3qbPmfnkfT1FJG8xEZmBJ4EdSNpLVHWNkdJri8xPc-1709708357-1.0.1.1-bWry4eexv9rf3eji.9Y1jbRud86PQTDpxiLeTTeIJpptDQGK9DjVBp_yt.cG4ZmTZVo5m5bAsHfL_BB.1JbuYQ'
            ),
        ));
    
        $response = curl_exec($curl);
    
        // echo "Invoice ID: $invoiceId, Response: $response\n";
    
        // Mengembalikan respons untuk disimpan dalam array
        return $response;
    }
    
}