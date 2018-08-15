<h3 class="judul garis"><?php echo $jenis; ?></h3>
<div class="scrool">
<?php
echo $editor; 
echo form_open_multipart('c_admin/edit_berita/'.$hasil->id_berita);
?>
  <div class="form-group">
    <?php 
	echo form_label('Judul', 'judul'); 
	$judul = array('name' => 'judul', 'class' => 'form-control input-sm', 'placeholder' => 'Masukan Judul Berita', 'value' => $hasil->judul);
	echo form_input($judul);
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Penulis', 'penulis'); 
	$penulis = array('name' => 'penulis', 'class' => 'form-control input-sm', 'placeholder' => 'Masukan Penulis Berita', 'value' => $hasil->penulis);
	echo form_input($penulis);
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Isi', 'isi'); 
	$isi = array('name' => 'isi', 'class' => 'form-control input-sm', 'id' => 'yenda_editor', 'rows' => '3', 'placeholder' => 'Tulis Berita', 'value' => $hasil->isi);
	echo form_textarea($isi);
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Gambar Awal', 'gambar');
	?>
    <img class="media-object img-rounded" src="<?php echo base_url();?>foto/foto_berita/<?php echo $hasil->gambar; ?>" width="130" height="100" />
    <br />
    <?php
	echo form_label('Ganti Gambar', 'gambar');
	echo form_upload('userfile');
	?>
  </div>
  <?php
  $btn = array('type' => 'submit', 'name' => 'simpan', 'class' => 'btn btn-primary btn-sm');
  echo form_submit($btn,'Simpan');
  
echo form_close();
?>
</div>