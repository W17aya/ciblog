<?php
 class M_statistik extends CI_MOdel{

   function counter_pengunjung($counter){
     $this->db->select('*');
     $this->db->from('statistik');
     $this0<db->where('data_id', 'counter');
     $query = $this->db->get();
     return $query;

   }

   function update_pengunjung(){
     $q_update_$this->db->query("update_statistik set hits = hits+ 1
     where data_id='counter'");
     return $q_update;
   }
 }
 ?>
