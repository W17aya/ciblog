<?php
class C_profil extends CI_Controller{

  function index(){
    $this->load->model('m_profil');
    $this->load->model('m_statistik');
    $this->load->model('m_link');

    $data['profil'] = $this->m_profil->profil(1);
    $data['banner'] = $this->m_link->daftar(5,0);
    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    
    $data['jenis'] = "Profil";
    $this->load->view('v_template', $data);
  }
  
}

?>
