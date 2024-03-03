<?php
    class xendit {
        public function CreateInvoice($bill_id) {
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
              CURLOPT_POSTFIELDS =>'{
                "external_id": "invoice-1709392792",
                "amount": 1800000,
                "payer_email": "mamahleong@example.com",
                "description": "Invoice Demo #12345",
                "customer": {
                    "given_names": "Mamah",
                    "surname": "Leong",
                    "email": "mamahleong@example.com",
                    "mobile_number": "+6287774441111"
                },
                "currency": "IDR"
            }',
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic eG5kX2RldmVsb3BtZW50X1o0WVNhbHpjZkJsZ1RIVncxeG1uRlFTdGZCZmlXcmJiZVJXT3E3S1ZGd3FnOG53ZFhGUGtsZEllU0I2Rzo6',
                'Cookie: __cf_bm=uSQ_5LVdo8zrcg.vXv_.4fFyKIyilREXl2lwI8ShSkg-1709392766-1.0.1.1-Jxuc2BBb.U33dl5mt9wISEDPYLxpMyncJAT7tTZiuLOanKZLX1rcu8_OHsoXzciShHW00loMwwxC9YplSIIduA'
              ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            echo $response;
            
        }
    }
?>