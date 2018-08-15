<?php
foreach($s_berita->result() as $row) :
$isi   = $row->isi;
$id    = $row->id_berita;
$judul = $row->judul;
$tgl   = tgl_indo($row->tgl_post);
$link  = set_linkurl($id,$judul);
$isi   = substr($isi, 0, 250);
?>
<div class="media"><!--class media-->
  <a class="pull-left" href="#">
    <img class="media-object img-rounded" src="<?php echo base_url(); ?>foto/foto_berita/thumbnails/<?php echo $row->gambar; ?>" width="130" height="100" />
  </a> 
  <div class="media-body"><!--class media-body-->
    <h4 class="media-heading"><?php echo anchor('c_semua_berita/view/'.$link, $row->judul); ?></h4>
 	<span class="post">
      Diposting Oleh : <?php echo $row->penulis; ?> | <?php echo $row->hari ?>, <?php echo $tgl; ?> - <?php echo $row->jam; ?>
    </span>
    <br /> 
    <span class="isi"><?php echo $isi; ?> ... <?php echo anchor('c_semua_berita/view/'.$link, 'Selengkapnya'); ?></span>
  </div><!--end class media-body-->
</div><!--end class media-->
<hr class="bsemua" />
<?php 
endforeach;
?>
<br />
<?php
echo $paginator;
echo br(2);
?>
