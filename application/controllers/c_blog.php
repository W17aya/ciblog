
<?php
class C_blog extends CI_Controller{

    function__ construct(){
        parent::__construct();
        $this->load->helper('cleanurl_helper');
        $this->load->helper('tglindo_helper');
        $this->load->model('m_berita');
        $this->load->model('m_link');
        $this->load->model('m_statistik');
    }

    function index(){
        $data['b_terbaru '] $this->m_berita->
        berita_terbaru(6);
        $data['b_sebelumnnya'] = $this->m_berita->
        berita_sebelumnya(6,6);
        $data['banner'] = $this->m_link->daftar(5,0);

        $data['counter'] = $this->m_statistik->conter_pengungjung('counter');
        setcookie("pengunjung", "sudah berkunjung"),time() + 900 * 24);
        if (!isset($_COOKIE["pengunjung"])){
            $this->m_statistik->update_pengunjung();
        $data['browser'] = $this->agent->browser().''.$this->agent->version();
        $data['jenis']   = "Beranda";
        $this->load->view('view_template' , '$data' );
    }
    
}

?>