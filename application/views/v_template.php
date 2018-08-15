<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />

  <title>selamat datang pada web blog berbasis framework codeigniter</title>

  <link href="<?php echo base_url(); ?>css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>css/style_pengunjung.css" media="screen" rel="stylesheet" type="text/css" />
  

</head>

<body>
  <div class="container"><!-- class container -->
      <div class="main_container"><!-- class main_container -->
      
        <div id="header"></div> 
        
        <div id="menu"><!-- id menu -->
          <div class="left-menu"><!--class left-menu-->
            <ul class="nav nav-pills" role="tablist">
              <li><?php echo anchor('', 'Beranda'); ?></li>
              <li><?php echo anchor('c_profil', 'Profil'); ?></li>
              <li><?php echo anchor('c_semua_berita', 'Semua Berita'); ?> </li>
              <li><?php echo anchor('c_download', 'Download'); ?> </li>
              <li><?php echo anchor('c_hubungi', 'Hubungi Kami'); ?></li>
            </ul> 
          </div><!--end class left-menu -->
          
          <div class="right-search-form"><!--class search-form -->
            <?php 
		    $frm_cari = array('name' => 'frm_cari', 'class' => 'navbar-form navbar-left', 'role' => 'search'); 
            echo form_open('c_blog/cari', $frm_cari);
		    ?>  
          <div class="form-group">
            <?php echo form_input(array('name' => 'search', 'class' => 'form-control input-sm', 'placeholder' => 'Pencarian')); ?>
          </div>   
            <?php
			echo form_submit(array('name' => 'cari', 'class' => 'btn btn-primary btn-sm', 'value' => 'Cari'));
            echo form_close(); 
			?>
          </div><!--end class search-form -->
        </div><!-- end id menu -->
                
		<div class="main_content"><!--class main-content-->
          <div class="row"><!--class row-->
          
            <div class="col-xs-12 col-sm-6 col-md-8"><?php include "main_content.php"; ?></div>
          
            <div class="col-xs-6 col-sm-6 col-md-4"><!-- class col-xs-6 col-sm-6 col-md-4 -->
            
              <div class="panel panel-default"><!-- class panel panel-default-->
                <div class="panel-heading"><h4 class="judul">Statistik Pengunjung</h4></div>
                <div class="panel-body"><!--class panel-body-->
                  <?php
				  foreach($counter->result() as $row):
                    echo "Dikunjungi oleh <b>".$row->hits."</b> user";
				  endforeach;
				  echo br();
				  echo "Browser : <b>".$browser."</b>";
				  ?>
                </div><!--end class panel-body-->
              </div><!--end class panel panel-default-->
          
              <div class="panel panel-default"><!-- class panel panel-default-->
                <div class="panel-heading"><h4 class="judul">Partner Link</h4></div>
                <div class="panel-body"><!--class panel-body-->             
                  <?php
				  foreach($banner->result() as $row):
				  ?>
                    <span class="banner">   
        		    <img class="img-rounded" src="<?php echo base_url();?>/foto/foto_banner/<?php echo $row->gambar;?>">
                    <br />
        		    <a href="http://<?php echo $row->url; ?>" target="_blank"><?php echo $row->judul; ?></a>
                    <hr class="banner" />
                    </span>
                  <?php
				  endforeach;
				  ?>                  
                </div><!--end class panel-body-->
              </div><!--end class panel panel-default-->
              
            </div><!-- end class col-xs-6 col-sm-6 col-md-4-->
            
          </div><!--end class row-->
        </div><!--end class main-content-->
        
        <div class="clearfix"></div>
        
        <div id="footer">
        &copy; 2014 web blog berbasis framework codeigniter <br />
        design and development by Yenda Purbadian<br />
        website : <a href="http://www.purbadian.com" target="_blank">http://www.purbadian.com</a>
        </div>
      
      </div><!-- end class main_container -->
  </div><!-- end class container -->

<script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
</body>
</html>
