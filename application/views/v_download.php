<h4 class="media-heading">Media Download </h4>
<span class="isi">
<p>
Link download dibawah ini bersifat free (gratis), Anda bisa mengembangkan lagi setiap script program yang didownload atau Anda bebas membagikan setiap tutorial atau source code yang didownload dengan catatan cantumkan link URL http://www.purbadian.com pada daftar sumber Anda.
Terima Kasih. 
</p>
</span>
<?php
foreach($download->result() as $row){
?>
<ul class="list-inline">
  <li><a href="<?php echo $row->nama_file; ?>" target="_blank"><?php echo $row->judul; ?></a></li>
</ul>
<?php
}
?>