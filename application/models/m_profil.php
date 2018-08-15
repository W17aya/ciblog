<?php
class M_profil extends CI_Model{
  var $gallerypath;
  var $gallery_path_url;

  function __construct(){
    parent::__construct();

    $this->gallerypath = realpath(APPPATH . '../foto/foto_profil');
	$this->gallery_path_url = base_url().'foto/foto_profil/';
  }

  function profil($limit){
    $this->db->select('id_profil, nama, isi_profil, gambar');
    $this->db->from('profil');
    $this->db->limit($limit);
    $query = $this->db->get();
    return $query;
  }
  
  function ubah_profil($id){
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
				           'width' => 200,
				           'height' =>200);

	  $this->load->library('image_lib', $konfigurasi);
	  $this->image_lib->resize();

	  $nama = $this->input->post('nama');
	  $isi = $this->input->post('isi_profil');
	  $gambar = $_FILES['userfile']['name'];

	  $data = array('nama' => $nama,
		   	        'isi_profil' => $isi,
			        'gambar' => $gambar);
      $this->db->where('id_profil', $id);
	  $this->db->update('profil', $data);
    }
    else{
	  $nama = $this->input->post('nama');
	  $isi = $this->input->post('isi_profil');

	  $data = array('nama' => $nama,
		   	        'isi_profil' => $isi);
      $this->db->where('id_profil', $id);
	  $this->db->update('profil', $data);
    }
  }
  
}
?>
