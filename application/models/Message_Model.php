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

    public function getMessageHistory($select, $where) {
        $this->db->select($select);
        $this->db->from('Message');
        $this->db->where('SiteId', $where['SiteId']);
        $this->db->where('CreateDate >=', $where['StartDate']);
        $this->db->where('CreateDate <=', $where['EndDate']);
        $this->db->order_by('Id', 'desc');
        $rawQuery = $this->db->last_query();

        $query = $this->db->get();
        return $query->result();
    }

    public function updateMessageStatus($data, $where) {
        if(isset($where['RemoteId']) && $where['RemoteId'] != ''){
            $this->db->where('RemoteId', $where['RemoteId']);
        }
        if(isset($where['State']) && $where['State'] != ''){
            $this->db->where('State', $where['State']);
        }
        if(isset($where['StateId']) && $where['StateId'] != ''){
            $this->db->where('StateId', $where['StateId']);
        }
        $this->db->update('Message', $data);
        $rawQuery = $this->db->last_query();
        // var_dump($rawQuery);
        // Memeriksa apakah ada baris yang terpengaruh oleh operasi update
        if ($this->db->affected_rows() > 0) {
            return true; // Jika ada baris yang terpengaruh, update berhasil
        } else {
            return false; // Jika tidak ada baris yang terpengaruh, update gagal
        }
    }
}