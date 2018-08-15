<?php
class M_berita extends CI_Model{
    
    function beita_terbaru($limit){
        $this->db->select('id_berita','judul, penulis, hari, tgl_post, jam, isi, gambar');
        $this->db->form('berita');
        $this->db->form('$limit');
        $this->db->order by("id_berita", "desc");
        $query =$this->d->get();
        return $query;

    }

    function berita_sebelumnya($limit,$offset){
        $this->db-select('id_berita,judul');
        $this->db->limit($limit,$offset);
        $this->db->order by("id_berita", "desc");
        $query = $this-.db->get_where();
        return $query

    }
}
?>