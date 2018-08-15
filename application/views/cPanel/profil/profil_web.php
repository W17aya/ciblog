<h3 class="judul garis"><?php echo $jenis; ?></h3>
<div class="scrool">
<?php
foreach($profil->result() as $row){
echo $editor; 
echo form_open_multipart('c_admin/profil_web/'.$row->id_profil);
?>
  <div class="form-group">
    <?php 
	echo form_label('Nama', 'nama');
	$nama = array('name' => 'nama', 'class' => 'form-control input-sm', 'placeholder' => 'Masukan Nama', 'value' => $row->nama);
	echo form_input($nama);
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Isi Profil', 'isi_profil'); 
	$isi = array('name' => 'isi_profil', 'class' => 'form-control input-sm', 'id' => 'yenda_editor', 'rows' => '3', 'placeholder' => 'Tulis Profil Web', 'value' => $row->isi_profil);
	echo form_textarea($isi);
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Gambar Awal', 'gambar');
	?>
    <img class="media-object img-rounded" src="<?php echo base_url();?>foto/foto_profil/<?php echo $row->gambar; ?>" width="130" height="100" />
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
}
?>
</div>