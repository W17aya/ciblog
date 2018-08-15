<?php
switch($jenis){
  case "beranda";	include("beranda.php"); break;
  case "Profil Web"; include("profil/profil_web.php"); break;
  case "Module Berita"; include("berita/berita_tampil.php"); break;
  case "Tambah Berita"; include("berita/berita_tambah.php"); break;
  case "Ubah Berita"; include("berita/berita_ubah.php"); break;
  case "Module Partner Link"; include("banner/banner_tampil.php"); break;
  case "Tambah Partner Link"; include("banner/banner_tambah.php"); break;
  case "Ubah Partner Link"; include("banner/banner_ubah.php"); break;
  case "Module Download"; include("download/download_tampil.php"); break;
  case "Tambah Download"; include("download/download_tambah.php"); break;
  case "Ubah Download"; include("download/download_ubah.php"); break;
  case "Hubungi Kami"; include("hubungi/hubungi_tampil.php"); break;
  case "Detail Hubungi Kami"; include("hubungi/hubungi_detail.php"); break;
}
?>
