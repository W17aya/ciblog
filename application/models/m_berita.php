<?php
class M_berita extends CI_Model{
  var $gallerypath;
  var $gallery_path_url;
  
  function __construct(){
    parent::__construct();
    $this->load->helper('tglindo_helper');

    $this->gallerypath = realpath(APPPATH . '../foto/foto_berita');
	$this->gallery_path_url = base_url().'foto/foto_berita/';
  }

  function berita_terbaru($limit){
    $this->db->select('id_berita, judul, penulis, hari, tgl_post, jam, isi, gambar');
	$this->db->from('berita');
	$this->db->limit($limit);
	$this->db->order_by("id_berita", "desc");
	$query = $this->db->get();
	return $query;
  }
  
  function berita_sebelumnya($limit,$offset){
    $this->db->select('id_berita,judul');
	$this->db->from('berita');
	$this->db->limit($limit,$offset);
	$this->db->order_by("id_berita", "desc");
	$query = $this->db->get_where();
	return $query;
  }
	
  function detail_berita($id){
    $this->db->query("update berita set dibaca=dibaca+1 where id_berita='$id'");
    $query = $this->db->query("select * from berita where id_berita='$id'");
	return $query;
  }

  function cari_berita($limit,$offset,$keyword){
    $this->db->select('*');
    $this->db->from('berita');
    $this->db->like('judul', $keyword);
    $this->db->limit($limit,$offset);
	$query = $this->db->get();
	return $query;
  }
  
  function tot_hal($tabel,$field,$kata){
  $query = $this->db->query("select * from $tabel where $field like '%$kata%'");
  return $query;
  }
  
  function tot_data($tabel){
    $query = $this->db->query("SELECT * FROM $tabel");
    return $query;
  }
  
  function tampil_berita($offset,$limit){
    $query = $this->db->query("SELECT * FROM berita order by id_berita DESC LIMIT $offset,$limit");
    return $query;
  }
  
  function simpan_berita(){
    $konfigurasi = array('allowed_types' =>'jpg|jpeg|gif|png|bmp',
			             'upload_path' => $this->gallerypath);
	$this->load->library('upload', $konfigurasi);
	$this->upload->do_upload();
	$datafile = $this->upload->data();
	
	$konfigurasi = array('source_image' => $datafile['full_path'],
                         'new_image' => $this->gallerypath . '/thumbnails',
			             'maintain_ration' => true,
			             'width' => 130,
		                 'height' =>100);

    $this->load->library('image_lib', $konfigurasi);
	$this->image_lib->resize();
	
	$judul = $this->input->post('judul');
	$penulis = $this->input->post('penulis');
	$isi = $this->input->post('isi');
	$tgl = date('Y-m-d');
	$hari = nama_hari();
	$jam = date('H:i:s');
	$gambar = $_FILES['userfile']['name'];
	
	$data = array('judul' => $judul,
                  'penulis' => $penulis,
			      'isi' => $isi,
                  'tgl_post' => $tgl,
                  'hari' => $hari,
                  'jam' => $jam,
			      'gambar' => $gambar);
	$this->db->insert('berita', $data);
  }
  
  function tampil_edit($id){
    return $this->db->get_where('berita', array('id_berita' => $id))->row();
  }
  
  function ubah_berita($id){
    $userfile = $_FILES['userfile']['name'];
	if(!empty($userfile)){
	  $konfigurasi = array('allowed_types' =>'jpg|jpeg|gif|png|bmp',
				           'upload_path' => $this->gallerypath);
				           
	  $this->load->library('upload', $konfigurasi);
	  $this->upload->do_upload();
	  $datafile = $this->upload->data();
	  
	  $konfigurasi = array('source_image' => $datafile['full_path'],
				           'new_image' => $this->gallerypath . '/thumbnails',
			               'maintain_ration' => true,
				           'width' => 130,
				           'height' =>100);
				           
	  $this->load->library('image_lib', $konfigurasi);
	  $this->image_lib->resize();

	  $judul = $this->input->post('judul');
	  $penulis = $this->input->post('penulis');
	  $isi = $this->input->post('isi');
	  $tgl = date('Y-m-d');
	  $hari = nama_hari();
	  $jam = date('H:i:s');
	  $gambar = $_FILES['userfile']['name'];
	  
	  $data = array('judul' => $judul,
                    'penulis' => $penulis,
		   	        'isi' => $isi,
                    'tgl_post' => $tgl,
                    'hari' => $hari,
                    'jam' => $jam,
			        'gambar' => $gambar);
      $this->db->where('id_berita', $id);
	  $this->db->update('berita', $data);
    }
    else{
	  $judul = $this->input->post('judul');
	  $penulis = $this->input->post('penulis');
	  $isi = $this->input->post('isi');
	  $tgl = date('Y-m-d');
	  $hari = nama_hari();
	  $jam = date('H:i:s');
	  
	  $data = array('judul' => $judul,
                    'penulis' => $penulis,
		   	        'isi' => $isi,
                    'tgl_post' => $tgl,
                    'hari' => $hari,
                    'jam' => $jam);
      $this->db->where('id_berita', $id);
	  $this->db->update('berita', $data);
    }
  }
  
  function hapus_berita($id){
    $this->db->where('id_berita', $id);
    $this->db->delete('berita');
  }
  
}
?>
