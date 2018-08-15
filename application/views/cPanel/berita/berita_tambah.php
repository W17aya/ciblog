<h3 class="judul garis"><?php echo $jenis; ?></h3>
<div class="scrool">
<?php
echo $editor; 
echo form_open_multipart('c_admin/add_berita');
?>
  <div class="form-group">
    <?php 
	echo form_label('Judul', 'judul'); 
	$judul = array('name' => 'judul', 'class' => 'form-control input-sm', 'placeholder' => 'Masukan Judul Berita');
	echo form_input($judul);
	echo form_error('judul');
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Penulis', 'penulis'); 
	$penulis = array('name' => 'penulis', 'class' => 'form-control input-sm', 'placeholder' => 'Masukan Penulis Berita');
	echo form_input($penulis);
	echo form_error('penulis');
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Isi', 'isi'); 
	$isi = array('name' => 'isi', 'class' => 'form-control input-sm', 'id' => 'yenda_editor', 'rows' => '3', 'placeholder' => 'Tulis Berita');
	echo form_textarea($isi);
	echo form_error('isi');
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Gambar', 'gambar'); 
	echo form_upload('userfile');
	?>
  </div>
  <?php
  $btn = array('type' => 'submit', 'name' => 'simpan', 'class' => 'btn btn-primary btn-sm');
  echo form_submit($btn,'Simpan');
  
echo form_close();
?>
</div>