<?php
    class MessageContent_Model extends CI_Model
    {
        public function insertMessageContent($data)
        {
            // Memulai transaksi database
            $this->db->trans_start();

            // Masukkan data ke tabel 'messagecontent'
            $this->db->insert('MessageContent', $data);

            // Menyelesaikan transaksi
            $this->db->trans_complete();

            // Periksa apakah transaksi berhasil atau tidak
            return $this->db->trans_status();
        }
    }