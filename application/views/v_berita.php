<?php
foreach($d_berita->result() as $row){
  $gambar = $row->gambar;
  $tgl   = tgl_indo($row->tgl_post);
?>
<div class="media">
  <a class="pull-left" href="#">
  <?php
  if ($gambar!=''){
  ?>
    <img class="media-object img-rounded" src="<?php echo base_url(); ?>foto/foto_berita/thumbnails/<?php echo $row->gambar; ?>" width="130" height="100" />
  <?php
  }
  ?>
  </a>
  <h4 class="media-heading"><?php echo $row->judul; ?></h4>
  <span class="post">
    Diposting Oleh : <?php echo $row->penulis; ?> | <?php echo $row->hari ?>, <?php echo $tgl; ?> - <?php echo $row->jam; ?> | Dibaca : <?php echo $row->dibaca; ?>
  </span>
  <br />
  <span class="isi"><?php echo $row->isi; ?></span>
</div>
<?php
}
?>
<br><br><a href=javascript:history.go(-1)> Kembali </a><p>&nbsp;</p>
