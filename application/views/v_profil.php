<h4 class="media-heading">Profil Pengelola Blog</h4>
<?php
foreach($profil->result() as $row){
?>
<img class="img-thumbnail" src="<?php echo base_url(); ?>foto/foto_profil/<?php echo $row->gambar; ?>" width="200" height="200" />
  <span class="isi"><?php echo $row->isi_profil; ?></span>
<?php
}
?>
