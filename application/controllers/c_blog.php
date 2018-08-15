<?php
class C_blog extends CI_Controller{

  function __construct(){
    parent::__construct();
    $this->load->helper('cleanurl_helper');
    $this->load->helper('tglindo_helper');
    $this->load->model('m_berita');
    $this->load->model('m_link');
    $this->load->model('m_statistik');
  }

  function index(){
    $data['b_terbaru'] = $this->m_berita->berita_terbaru(6);
    $data['b_sebelumnya'] = $this->m_berita->berita_sebelumnya(6,6);
    $data['banner'] = $this->m_link->daftar(5,0);

    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    
    $data['jenis'] = "Beranda";
    $this->load->view('v_template', $data);
  }
  
  function view($id){
	$data['d_berita'] = $this->m_berita->detail_berita($id);
	$data['banner'] = $this->m_link->daftar(5,0);

    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    
	$data['jenis'] = 'Detail Berita';
	$this->load->view('v_template', $data);
  }
  
  function cari(){
    $page=$this->uri->segment(3);
    $batas=5;
	if(!$page):
	  $offset = 0;
	else:
	  $offset = $page;
	endif;
	
	$data['search']="";
	$post_kata = $this->input->post('search');
	if(!empty($post_kata)){
	  $data['search'] = $this->input->post('search');
	  $this->session->set_userdata('pencarian_judul', $data['search']);
	}
	else{
	  $data['search'] = $this->session->userdata('pencarian_judul');
    }
    
	$data['search_berita'] = $this->m_berita->cari_berita($batas,$offset,$data['search']);
	$tot_hal = $this->m_berita->tot_hal('berita','judul',$data['search']);
	
	$config['base_url'] = base_url() . '/c_blog/cari/';
	$config['total_rows'] = $tot_hal->num_rows();
    $config['per_page'] = $batas;
	$config['uri_segment'] = 3;
	$config['first_link'] = 'Awal';
	$config['last_link'] = 'Akhir';
	$config['next_link'] = 'Selanjutnya';
	$config['prev_link'] = 'Sebelumnya';
    $this->pagination->initialize($config);
	$data["paginator"] =$this->pagination->create_links();

    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    
    $data['banner'] = $this->m_link->daftar(5,0);
    $data['jenis'] = 'Cari';
	$this->load->view('v_template', $data);
  }

}
?>
