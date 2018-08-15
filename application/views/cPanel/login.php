<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  
  <title>Login Administrator</title>
  
  <link href="<?php echo base_url(); ?>css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>css/bootstrap-responsive.min.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>css/signin.css" media="screen" rel="stylesheet" type="text/css" />
  
  <script language="javascript">
  function validasi(form){
    if (form.username.value==""){
	  alert("Username masih kosong");
	  form.username.focus();
	  return (false);
	}
    if (form.password.value==""){
	  alert("Password masih kosong");
	  form.password.focus();
	  return (false);
	}
  return (true);
  }
  </script>
  
</head>

<body>
  <div class="container"><!--class container -->
    <?php 
	$frm_login = array('class' => 'form-signin', 'onsubmit' => 'return validasi(this)');
	echo form_open('c_admin/login', $frm_login);
	?>
    <h2 class="form-signin-heading">Login Administrator</h2>
    <?php
	$txtuser = array('name' => 'username', 'class' => 'form-control', 'placeholder' => 'Masukan Username', 'autofocus' =>'autofocus');
	echo form_input($txtuser);
	$txtpass = array('name' => 'password', 'class' => 'form-control', 'placeholder' => 'Masukan Password');
	echo form_password($txtpass);
	$button = array('name' => 'login', 'class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit');
	echo form_button($button,'Login');
	echo form_close();
	?>
  </div> <!--end class container -->

  <script type="text/javascript" src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.min.js"></script>
</body>
</html>