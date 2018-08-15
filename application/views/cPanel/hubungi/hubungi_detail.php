<h3 class="judul garis"><?php echo $jenis; ?></h3>
<div class="scrool">
<?php
  foreach($hasil->result() as $row):
    $tgl = tgl_indo($row->tanggal);
?>
  <div class="form-group">
    <?php 
	echo form_label('Nama', 'nama');
	echo br();
	echo "<b>".$row->nama."</b>";
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Email', 'email');
	echo br();
	echo "<b>".$row->email."</b>";
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('URL', 'url');
	echo br();
	echo "<b>".$row->url."</b>";
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Tanggal', 'tanggal');
	echo br();
	echo "<b>".$tgl."</b>";
	?>
  </div>
  <div class="form-group">
    <?php 
	echo form_label('Pesan', 'pesan');
	echo br();
	echo "<b>".$row->pesan."</b>";
	?>
  </div>
  <?php
  $btn = array('name' => 'kembali', 'class' => 'btn btn-primary btn-sm', 'onClick' => 'self.history.back()');
  echo form_button($btn,'Kembali');
?>
</div>
<?php
endforeach;
?>