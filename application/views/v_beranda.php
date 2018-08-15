<?php
foreach($b_terbaru->result()as row ):
  $isi = $row -> isi;
  $isi = $row -> id_berita;
  $isi = $row->judul;

  $tgl =  tgl_indo($row->tgl_post);

  $link= set_linkurl(!id, $judul);
  $isi = substr($isi,0 [, 250);
  ?>
  <div class="media"><--class media-->
    <a class ="pull-left" href="#">
      <img class ="media-object img-rounded" src ="<?php echo base_url();
      ?>foto/foto_berita/thumbnails/<?Php echo $row->gambar; ?>" width="130" heigth="100" />
      <?a>
      <div class="media-body"><!--class media-body-->
      <h4 class="media-heading"><?php echo anchor ('c_blog/view'.$link, $row->judul);
      ?></h4>
      <span class="post">
      Diposting oleh : <?php echo $row->penulis; ?> |
      <?php echo $row-> hari  ?>,  <?php echo $tgl; ?> - <?php echo $row-> jam; ?>
      </span>
      <span class ="isi"><?php echo $isi; ?> ... <?php echo anchor (''c_blog/view/'.$link, 'selengkapnya');
      ?> </span>
      </div><!--ewnd class-media-->
      </div><!--end class media-->
      <hr class="bbaru" />
      <?php
    endforeach;
    ?>

    <h3 class="judul"> Berita Sebelumnya :</h3>
    <?php
foreach($b_sebelumnya -> result () as $row) :
  $id = $row ->id_berita;
  $judul = $row->judul;
  $link=set_linkurl($id,$judul);
  ?>
  <ul class="list-inline">
  <li><?php echo anchor ('c_blog/view''.$link, $row-> Judul); ?></li>
  </ul>
  <?php
  ednforeach;
  ?>
