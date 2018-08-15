<?php
class C_download extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->model('m_download');
    $this->load->model('m_statistik');
    $this->load->model('m_link');
  }

  function index(){
    $data['download'] = $this->m_download->download();
    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    $data['banner'] = $this->m_link->daftar(5,0);
    $data['jenis'] = "Download";
    $this->load->view('v_template', $data);
  }

}

?>
