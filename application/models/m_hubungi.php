<?php
class M_hubungi extends CI_Model{

  function __construct(){
    parent::__construct();
  }
  
  function tampil($limit,$offset){
    $this->db->select('id_hubungi, nama, url, pesan, tanggal');
    $this->db->from('hubungi');
    $this->db->limit($limit, $offset);
    $this->db->order_by("id_hubungi", "desc");
    $query = $this->db->get();
    return $query;
  }
  
  function input($nama, $url, $email, $pesan){
    $this->db->set("nama", $nama);
    $this->db->set("url", $url);
    $this->db->set("email", $email);
    $this->db->set("pesan", $pesan);
    $tgl = date("Y-m-d");
    $this->db->set("tanggal", $tgl);
    $this->db->insert("hubungi");
  }
  
  function jumtotal(){
    return $this->db->count_all('hubungi');
  }
  
  function tot_data($tabel){
    $query = $this->db->query("SELECT * FROM $tabel");
    return $query;
  }

  function tampil_hubungi($offset,$limit){
    $query = $this->db->query("SELECT * FROM hubungi order by id_hubungi DESC LIMIT $offset,$limit");
    return $query;
  }
  
  function tampil_detail($id){
    $query = $this->db->query("SELECT * FROM hubungi where id_hubungi='$id'");
    return $query;
  }
  
  function hapus_hubungi($id){
    $this->db->where('id_hubungi', $id);
    $this->db->delete('hubungi');
  }

}

?>
