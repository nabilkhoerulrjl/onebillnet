<?php
    class fonnte {

    
        public function generate_qr() {
            // Contoh penggunaan
            $url = 'https://api.fonnte.com/qr';
            $headers = array(
                'Authorization: TOKEN',
                'Content-Type: application/x-www-form-urlencoded', // Sesuaikan dengan kebutuhan
            );
    
            $data = array(
                // Data yang akan dikirim, jika diperlukan
            );
    
            $response = $this->curl_library->send_post_request($url, $headers, $data);
    
            // Decode response menjadi array
            $res = json_decode($response, true);
    
            if (isset($res['url'])) {
                $qr = $res['url'];
    
                // Gunakan $qr sesuai kebutuhan (contohnya menampilkan gambar)
                $data['qr_image'] = '<img src="data:image/png;base64,' . $qr . '">';
    
                // Tampilkan view atau lakukan sesuatu dengan $data
                $this->load->view('your_view', $data);
            }
        }
    
        public function sendMessage() {
            $targets = array(
                '085943063646' => 'Fonnte|Admin',
                '021219013257' => 'Lily|Client',
            );
    
            $message = '*B* Selamat Siang
            Saya Adalah {saya} as {sayu}';
            $delay = '2-5';
            $countryCode = '62';
            $this->load->library('fonnte_api');
    
            $response = $this->fonnte_api->sendMessage($targets, $message, $delay, $countryCode);
    
            echo $response;
            return $response;
        }
    
        public function au(){
            return "baba";
        }
    }