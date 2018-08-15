<h4 class="media-heading">Hubungi Kami</h4>
<span class="isi">
<p>
  Segala macam kritik, saran, dan pertanyaan, dapat Anda kirimkan melalui form dibawah ini. 
  Kami akan berusaha untuk segera menanggapi kiriman Anda. Hanya kiriman yang lengkap yang akan segera ditanggapi. <br />
  Terima kasih..
</p>  
</span>
<?php
foreach($daf_hub->result() as $row){
  $tgl = tgl_indo($row->tanggal);
  ?>
  <a href="http://<?php echo $row->url; ?>" target="_blank"><b><?php echo $row->nama; ?></b></a> | <?php echo $tgl; ?>
  <span class="isi">
  <p><?php echo $row->pesan; ?></p>
  </span> 
  <?php
}
echo $paginator;

echo form_open('c_hubungi/hubungikami');
?>
  <br />
  <div class="form-group">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control input-sm" placeholder="Masukan Nama Anda" />
    <b><?php echo form_error('nama'); ?></b>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control input-sm" placeholder="Masukan Email Anda" id="inputError" />
    <b><?php echo form_error('email'); ?></b>
  </div>
  <div class="form-group">
    <label>URL</label>
    <input type="text" name="url" class="form-control input-sm" placeholder="Masukan Alamat Website Anda" id="inputError" />
    <?php echo form_error('url'); ?>
  </div>
  <div class="form-group">
    <label>Pesan</label>
    <textarea name="pesan" rows="3" class="form-control input-sm" placeholder="Masukan Pesan Anda" id="inputError"></textarea>
    <b><?php echo form_error('pesan'); ?></b>
  </div>
  <div class="form-group">
    <?php 
	echo $captcha['image'];
	echo "&nbsp;<b>".$kesalahan."</b>";
    ?>
  </div>
  <div class="form-group">
    <input type="text" name="confirmCaptcha" class="form-control input-sm" placeholder="Masukan Kode Pada Gambar Diatas" id="inputError" value="" />
  </div>
  <button type="submit" name="kirim" class="btn btn-primary btn-sm">Kirim</button>
  <br />
  <br />
<?php
echo form_close();
?>