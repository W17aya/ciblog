<?php
class C_semua_berita extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('cleanurl_helper');
    $this->load->helper('tglindo_helper');
    $this->load->model('m_berita');
    $this->load->model('m_statistik');
    $this->load->model('m_link');
  }

  function index(){
    $config['base_url'] = base_url().'/c_semua_berita/index/';
    $config['total_rows'] = $this->db->count_all('berita');
    $config['per_page'] = 6;
    $config['num_links'] = 3;
	$config['first_link'] = 'Awal';
	$config['last_link'] = 'Akhir';
	$config['next_link'] = 'Selanjutnya';
	$config['prev_link'] = 'Sebelumnya';
    $this->pagination->initialize($config);
    $data['s_berita'] = $this->db->get('berita', $config['per_page'], $this->uri->segment(3));
    $data["paginator"] = $this->pagination->create_links();

    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    $data['banner'] = $this->m_link->daftar(5,0);
    $data['jenis'] = "Semua Berita";
    
    $this->load->view('v_template', $data);
  }

  function view($id){
	$data['d_berita'] = $this->m_berita->detail_berita($id);
    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    $data['banner'] = $this->m_link->daftar(5,0);
	$data['jenis'] = 'Detail Berita';
	
    $this->load->view('v_template', $data);
  }

}
?>
