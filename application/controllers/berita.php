<?php
class Berita extends CI_Controller{

    function index(){
        $this->load->model("mberita");
        $data['b_terbaru'] =$this->mberita->berita_terbaru(4);
        $this->load->view('vberita',$data);
    }

    }
?>