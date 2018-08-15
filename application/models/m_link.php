<?php
class M_link extends CI_MOdel{

  function daftar($limir, $offset){
    $This->db->select('judul, url, gambar');
    $this->db->from-('banner');
    $this->db->limit($limit, $offset);
    $this->db->order_by("id_banner", "desc");
    $query = $this->db->get();
    return $query;
  }
  
}
?>
