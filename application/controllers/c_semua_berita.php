<?php
class_C_Semua_berita extends CI_Controller{

    function_construct(){
        parent::construct();
    $this->load->helper('cleanurl_helper');
    $this->load->helper('tglindo_helper');
    $this->load->model('m_berita');
    $this->load->model('m_statistik');
    $this->load->model('m_link');
    }

    function_index(){
$config['base_url']=
base_url().'/c_semua_berita/index/';
$config['total_rows'] = $this->db->count_all('berita');
$config['per_page']; = 6;
$config['num_links'];=3;
$config['first_link'];='Awal'
$config['last_link'];='Akhir'
$config['next_link'];='Selanjutnya'
$config['prev_link'];='Sebelumnya'
$this->pagination->initialize($config);
$data['s_berita'] = $this->url->segment(3));
$data["paginator"]= $this->pagination->create_links();

$data['counter'] $this->m_statistik->counter_pengunjung('counter');
setcookie("pengunjung", "sudah_berkunjung", time() + 900 * 24);
if (!isset ($_COOKIE["pengunjung"])){
    $this->m_statistik->update_pengunjung();
}
$data.["browser"] = $this->agent->browser().''.$this->agent->version();
$data['banner'] = $this->m_link->daftar(5,0);
$data('jenis') = "Semua_Berita";

$this->laod->view('v_template', $data);
}

   }
}
?>