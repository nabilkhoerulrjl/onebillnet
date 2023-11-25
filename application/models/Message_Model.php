<?php
class Message_Model extends CI_Model
{
    public function insertMessage($data)
    {
        // Memulai transaksi database
        $this->db->trans_start();

        // Masukkan data ke tabel 'message'
        $this->db->insert('Message', $data);

        // Ambil ID yang baru saja dimasukkan
        // Ambil data yang baru saja diinsert
        $insertedId = $this->db->insert_id();
        $result = $this->db->get_where('Message', ['Id' => $insertedId])->row();
        // var_dump($result);
        // die();

        // Menyelesaikan transaksi
        $this->db->trans_complete();

        // Periksa apakah transaksi berhasil atau tidak
        if ($this->db->trans_status() === false) {
            // Jika terjadi kesalahan, kembalikan false atau sesuaikan dengan kebutuhan
            return false;
        } else {
            // Jika berhasil, kembalikan ID pesan yang baru saja dimasukkan
            return $result->Id;
        }
    }
}