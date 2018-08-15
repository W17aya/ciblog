<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />

  <title>Administrator System</title>

  <link href="<?php echo base_url(); ?>css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>css/style_admin.css" media="screen" rel="stylesheet" type="text/css" />
  

</head>

<body>
  <div class="container"><!--class container-->
    <div class="main_container"><!-- class main_container-->
      
      <div id="header"><h1>Administrator System</h1></div>
      
      <div class="main_content"><!-- class main_content-->
        <div class="row"><!-- class row-->
        
          <div class="col-xs-6 col-sm-6 col-md-4"><!--class col-xs-6 col-sm-6 col-md-4-->
            <div class="left_content"><!--class left_content-->
            <ul class="nav nav-pills nav-stacked">
              <li class="border"><?php echo anchor('c_admin', 'Beranda'); ?></li>
              <li class="border"><?php echo anchor('c_admin/profil_web', 'Profil Web'); ?></li>
              <li class="border"><?php echo anchor('c_admin/select_berita', 'Manajemen Berita'); ?></li>
              <li class="border"><?php echo anchor('c_admin/select_link', 'Manajemen Link'); ?></li>
              <li class="border"><?php echo anchor('c_admin/select_download', 'Manajemen Download'); ?></li>
              <li class="border"><?php echo anchor('c_admin/select_hubungi', 'Hubungi Kami'); ?></li>
              <li class="border"><?php echo anchor('c_admin/logout', 'Logout'); ?> </li>
            </ul>
            </div><!--end class left_content-->
          </div><!--end class col-xs-6 col-sm-6 col-md-4-->
          
          <div class="col-xs-12 col-sm-6 col-md-8"><!--class col-xs-12 col-sm-6 col-md-8-->
            <div class="right_content">
            <?php include "main_content_cPanel.php"; ?> 
            </div>
          </div><!--end class col-xs-12 col-sm-6 col-md-8-->
          
        </div><!-- end class row-->
      </div><!-- end class main_content-->
      
      <div class="clearfix"></div>
        
      <div id="footer">
        &copy; 2014 web blog berbasis framework codeigniter <br />
        design and development by Yenda Purbadian<br />
        website : <a href="http://www.purbadian.com" target="_blank">http://www.purbadian.com</a>
      </div>          
      
    </div><!-- end class main_container-->
  </div><!-- end class container -->
  
  <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
</body>
</html>
