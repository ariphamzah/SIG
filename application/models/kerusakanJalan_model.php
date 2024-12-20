<?php
class KerusakanJalan_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database(); // Pastikan untuk memuat database
    }

    public function getAllKerusakan() {
        return $this->db->get('kerusakan_jalan')->result();
    }

    public function count($tabel,$kategori)
    {
        $query = $this->db->select("kategori, COUNT(*) as total")
                      ->from($tabel)
                      ->where('kategori',$kategori)
                      ->get();
        return $query->result();
    }

    // Metode untuk menambahkan data kerusakan jalan
    public function insert($tabel,$data) {
        $this->db->insert($tabel,$data);
    }

    public function select($tabel)
    {
        $query = $this->db->get($tabel);
        return $query->result();
    }

    public function selecttabel($tabel,$kategori)
    {
        $query = $this->db->select()
                      ->from($tabel)
                      ->where('kategori',$kategori)
                      ->get();
        return $query->result();
    }
    public function read($tabel,$username)
    {
        $query = $this->db->select()
                        ->from($tabel)
                        ->where_not_in('username',$username)
                        ->get();

        return $query->result();
    }

    public function update_password($tabel,$where,$data)
    {
        $this->db->where($where);
        $this->db->update($tabel,$data);
    }

}
