<?php
class M_statistik extends CI_Model{

  function counter_pengunjung($counter){
    $this->db->select('*');
    $this->db->from('statistik');
    $this->db->where('data_id', $counter);
    $query = $this->db->get();
    return $query;
  }
  
  function update_pengunjung(){
    $q_update=$this->db->query("update statistik set hits=hits+1 where data_id='counter'");
	return $q_update;
  }

}
?>
