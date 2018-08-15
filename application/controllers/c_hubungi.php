<?php
class C_hubungi extends CI_Controller{

  function __construct(){
    parent::__construct();
	$this->load->helper('tglindo_helper');
	$this->load->model('m_captcha');
    $this->load->model('m_hubungi');
    $this->load->model('m_statistik');
	$this->load->model('m_link');
	session_start();
  }
  
  function index(){
    $this->hubungikami();
  }
  
  function hubungikami($nilai=0){
    $data['jenis'] ='Hubungi Kami';
    $data['daf_hub'] = $this->m_hubungi->tampil('5', $nilai);
    
    $this->form_validation->set_rules('nama', 'Nama', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');
    $this->form_validation->set_rules('pesan', 'Pesan', 'required');
    
    if (empty($_POST['nama'])){
      $data['kesalahan']='';
    }
    else{
      if(strcasecmp($_SESSION['captchaWord'], $_POST['confirmCaptcha']) == 0){
        $nama = $this->db->escape($this->input->post('nama', TRUE));
        $url = $this->db->escape($this->input->post('url', TRUE));
        $email = $this->db->escape($this->input->post('email', TRUE));
        $pesan = $this->db->escape($this->input->post('pesan', TRUE));
        $data['kesalahan'] = 'Kode Benar';
      }
      else{
        $data['kesalahan'] = 'Kode Salah';
      }
    }
    
    $captcha = $this->m_captcha->GenerateCaptcha();
    $_SESSION['captchaWord'] = $captcha['word'];
    $data['captcha'] = $captcha;
    
    $config['base_url'] = base_url()."/c_hubungi/hubungikami";
    $config['total_rows'] = $this->m_hubungi->jumtotal();
    $config['per_page'] = 5;
    $config['num_links'] = 5;
	$config['first_link'] = 'Awal';
	$config['last_link'] = 'Akhir';
	$config['next_link'] = 'Selanjutnya';
	$config['prev_link'] = 'Sebelumnya';
	$config['cur_page'] = 1;

    $this->pagination->initialize($config);
	
	$data['paginator']=$this->pagination->create_links();
    
    if($this->form_validation->run() == FALSE){
      $data['kesalahan'] = '';
    }
    else{
      if ($data['kesalahan'] == 'Kode Benar'){
        $data['kesalahan'] = 'Terikirim';
        $this->m_hubungi->input($nama, $url, $email, $pesan);
      }
      else{
        $data['kesalahan'] = 'Kode yang Anda masukan salah';
      }
    }
    
    $data['counter'] = $this->m_statistik->counter_pengunjung('counter');
    setcookie("pengunjung", "sudah berkunjung", time() + 900 * 24);
    if (!isset($_COOKIE["pengunjung"])){
      $this->m_statistik->update_pengunjung();
    }
    $data["browser"] = $this->agent->browser().' '.$this->agent->version();
    $data['banner'] = $this->m_link->daftar(5,0);
    
    $this->load->view('v_template', $data);
  }
  
}
?>
