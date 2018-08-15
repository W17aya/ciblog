<?php
switch($jenis){
  case "Beranda"; include("v_beranda.php"); break;
  case "Detail Berita"; include("v_berita.php"); break;
  case "Semua Berita"; include("v_semua_berita.php"); break;
  case "Profil"; include("v_profil.php"); break;
  case "Download"; include("v_download.php"); break;
  case "Hubungi Kami"; include("v_hubungi.php"); break;
  case "Cari"; include("v_cari.php"); break;
}
?>
