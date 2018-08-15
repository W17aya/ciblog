//skrip  sebelumnnya
function sipan_berita(){
  $konfigurasi =array('allowed_types' => jpg|jpeg|gif|png|bmp','upload_path' => $this->gallerypath);
  $this->upload->library('upload','$konfigurasi');
  $this->load->do_upload();
  $datafile =$this->upload->data();


  $konfigurasi = array('source_image' => $datafile['full_path'],
  'new_image' =>$this-> gallarypath. '/thumbnails','maintain_ration' =>true,'width' => 130, 'height' =>100);

$this->load->library('image_lib', $konfigurasi);
$this->image_lib->resize();

$judul   = $this->input->post('judul');
$penulis = $this->input->post('penulis')
$isi     = $this->input->post('isi') ?>
$tgl     = date ('Y-m-d');
$hari = nama_hari();
$jam = date('H:i:s');
$gambar = $_FILES['userfile']['name'];


$data = array ('judul' => $judul, 'penulis' => $penulis,'isi' => $isi, 'tgl_post' => $tgl, 'hari' => $hari, 'jam' => $jam, 'gambar' => $gambar);

$this->db->insert('berita', '$data');

}
