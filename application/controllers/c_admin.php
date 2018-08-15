<?php
class C_admin extends CI_Controller{
  
  function __construct(){
    parent::__construct();
    session_start();
    $this->load->model('m_login');
    $this->load->model('m_profil');
    $this->load->model('m_berita');
    $this->load->model('m_link');
    $this->load->model('m_download');
    $this->load->model('m_hubungi');
    $this->load->helper('tglindo_helper');
  }
  
  function index(){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];
      $data['editor'] = $this->editor_tinymce();
      if($data['level']=="admin"){
        $data['jenis']="beranda";
        $this->load->view('cPanel/hal_cPanel', $data);
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function login_user(){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';

    if ($session!=""){
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin'>";
    }
    else{
      $this->load->view('cPanel/login');
    }
  }
  
  function login(){
    $username = $this->input->post('username');
    $password = $this->input->post('password');
    $hasil = $this->m_login->cekdb();
    
    if (count($hasil->result_array())>0){
      foreach($hasil->result() as $row){
        $sess_user = $row->username."|".$row->nama."|".$row->level;
        $level = $row->level;
      }
      $_SESSION['user_data']=$sess_user;
      if ($level=="admin"){
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin'>";
      }
      else{
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript">
	    alert("Username atau Password Yang Anda Masukkan Salah..!!!");
      </script>
	<?php
   echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function logout(){
	session_destroy();
    echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
  }
  
  function profil_web($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];
      $data['editor'] = $this->editor_tinymce();

      if($data['level']=="admin"){
        if ($_POST==NULL){
          $data['profil'] = $this->m_profil->profil(1);
          $data['jenis'] = 'Profil Web';
          $this->load->view('cPanel/hal_cPanel', $data);
        }
        else{
          $this->m_profil->ubah_profil($id);
          redirect('c_admin/profil_web');
        }
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function select_berita() {
    $page=$this->uri->segment(3);
    $limit=10;
    if(!$page): $offset=0;
    else: $offset = $page;
    endif;

    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];
      $data['editor'] = $this->editor_tinymce();
      
      if($data['level']=="admin"){
        $total = $this->m_berita->tot_data('berita');
 	    $config['base_url'] = base_url().'c_admin/select_berita/';
        $config['total_rows'] = $total->num_rows();
        
	    $config['per_page'] = $limit;
	    $config['uri_segment'] = 3;
	    $config['first_link'] = 'Awal';
	    $config['last_link'] = 'Akhir';
	    $config['next_link'] = 'Selanjutnya';
	    $config['prev_link'] = 'Sebelumnya';
	    $this->pagination->initialize($config);
        $data['paginator'] = $this->pagination->create_links();
        
        $data['hasil'] = $this->m_berita->tampil_berita($offset,$limit);
        $data['page'] = $page;
	    $data['jenis'] = 'Module Berita';
	    
	    $this->load->view('cPanel/hal_cPanel', $data);
	  }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function add_berita(){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];
      $data['editor'] = $this->editor_tinymce();

      if($data['level']=="admin"){
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('penulis', 'Penulis', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'required');
        
        if ($this->form_validation->run() == TRUE) {
          if ($this->input->post('simpan')) {
            $this->m_berita->simpan_berita();
            redirect('c_admin/select_berita');
          }
        }
        $data['jenis'] = 'Tambah Berita';
        $this->load->view('cPanel/hal_cPanel', $data);
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function edit_berita($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];
      $data['editor'] = $this->editor_tinymce();

      if($data['level']=="admin"){
        if ($_POST==NULL){
          $data['hasil'] = $this->m_berita->tampil_edit($id);
          $data['jenis'] = 'Ubah Berita';
          $this->load->view('cPanel/hal_cPanel', $data);
        }
        else{
          $this->m_berita->ubah_berita($id);
          redirect('c_admin/select_berita');
        }
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function delete_berita($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];
      $data['editor'] = $this->editor_tinymce();

      if($data['level']=="admin"){
        $this->m_berita->hapus_berita($id);
        redirect('c_admin/select_berita');
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function select_link() {
    $page=$this->uri->segment(3);
    $limit=10;
    if(!$page): $offset=0;
    else: $offset = $page;
    endif;

    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $total = $this->m_link->tot_data('banner');
 	    $config['base_url'] = base_url().'c_admin/select_link/';
        $config['total_rows'] = $total->num_rows();

	    $config['per_page'] = $limit;
	    $config['uri_segment'] = 3;
	    $config['first_link'] = 'Awal';
	    $config['last_link'] = 'Akhir';
	    $config['next_link'] = 'Selanjutnya';
	    $config['prev_link'] = 'Sebelumnya';
	    $this->pagination->initialize($config);
        $data['paginator'] = $this->pagination->create_links();

        $data['hasil'] = $this->m_link->tampil_link($offset,$limit);
        $data['page'] = $page;
	    $data['jenis'] = 'Module Partner Link';

	    $this->load->view('cPanel/hal_cPanel', $data);
	  }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function add_link(){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');

        if ($this->form_validation->run() == TRUE) {
          if ($this->input->post('simpan')) {
            $this->m_link->simpan_link();
            redirect('c_admin/select_link');
          }
        }
        $data['jenis'] = 'Tambah Partner Link';
        $this->load->view('cPanel/hal_cPanel', $data);
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function edit_link($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        if ($_POST==NULL){
          $data['hasil'] = $this->m_link->tampil_edit($id);
          $data['jenis'] = 'Ubah Partner Link';
          $this->load->view('cPanel/hal_cPanel', $data);
        }
        else{
          $this->m_link->ubah_link($id);
          redirect('c_admin/select_link');
        }
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function delete_link($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $this->m_link->hapus_link($id);
        redirect('c_admin/select_link');
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function select_download() {
    $page=$this->uri->segment(3);
    $limit=10;
    if(!$page): $offset=0;
    else: $offset = $page;
    endif;

    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $total = $this->m_download->tot_data('download');
 	    $config['base_url'] = base_url().'c_admin/select_download/';
        $config['total_rows'] = $total->num_rows();

	    $config['per_page'] = $limit;
	    $config['uri_segment'] = 3;
	    $config['first_link'] = 'Awal';
	    $config['last_link'] = 'Akhir';
	    $config['next_link'] = 'Selanjutnya';
	    $config['prev_link'] = 'Sebelumnya';
	    $this->pagination->initialize($config);
        $data['paginator'] = $this->pagination->create_links();

        $data['hasil'] = $this->m_download->tampil_download($offset,$limit);
        $data['page'] = $page;
	    $data['jenis'] = 'Module Download';

	    $this->load->view('cPanel/hal_cPanel', $data);
	  }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function add_download(){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $this->form_validation->set_rules('judul', 'Judul', 'required');

        if ($this->form_validation->run() == TRUE) {
          if ($this->input->post('simpan')) {
            $this->m_download->simpan_download();
            redirect('c_admin/select_download');
          }
        }
        $data['jenis'] = 'Tambah Download';
        $this->load->view('cPanel/hal_cPanel', $data);
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function edit_download($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        if ($_POST==NULL){
          $data['hasil'] = $this->m_download->tampil_edit($id);
          $data['jenis'] = 'Ubah Download';
          $this->load->view('cPanel/hal_cPanel', $data);
        }
        else{
          $this->m_download->ubah_download($id);
          redirect('c_admin/select_download');
        }
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function delete_download($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $this->m_download->hapus_download($id);
        redirect('c_admin/select_download');
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function select_hubungi() {
    $page=$this->uri->segment(3);
    $limit=10;
    if(!$page): $offset=0;
    else: $offset = $page;
    endif;

    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $total = $this->m_hubungi->tot_data('hubungi');
 	    $config['base_url'] = base_url().'c_admin/select_hubungi/';
        $config['total_rows'] = $total->num_rows();

	    $config['per_page'] = $limit;
	    $config['uri_segment'] = 3;
	    $config['first_link'] = 'Awal';
	    $config['last_link'] = 'Akhir';
	    $config['next_link'] = 'Selanjutnya';
	    $config['prev_link'] = 'Sebelumnya';
	    $this->pagination->initialize($config);
        $data['paginator'] = $this->pagination->create_links();

        $data['hasil'] = $this->m_hubungi->tampil_hubungi($offset,$limit);
        $data['page'] = $page;
	    $data['jenis'] = 'Hubungi Kami';

	    $this->load->view('cPanel/hal_cPanel', $data);
	  }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function detail_hubungi($id){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
          $data['hasil'] = $this->m_hubungi->tampil_detail($id);
          $data['jenis'] = 'Detail Hubungi Kami';
          $this->load->view('cPanel/hal_cPanel', $data);
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  function delete_hubungi($id=NULL){
    $data = array();
    $session = isset($_SESSION['user_data']) ? $_SESSION['user_data']:'';
    if($session!=""){
      $pisah_info = explode("|", $session);
      $data['username'] = $pisah_info[0];
      $data['nama'] = $pisah_info[1];
      $data['level'] = $pisah_info[2];

      if($data['level']=="admin"){
        $this->m_hubungi->hapus_hubungi($id);
        redirect('c_admin/select_hubungi');
      }
      else{
      ?>
        <script type="text/javascript" language="javascript">
		  alert("Anda tidak berhak masuk ke Control Panel Admin...!!!");
		</script>
      <?php
        echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
      }
    }
    else{
    ?>
	  <script type="text/javascript" language="javascript">
	    alert("Anda belum Log In...!!!\nAnda harus Log In untuk mengakses halaman ini...!!!");
      </script>
    <?php
      echo "<meta http-equiv='refresh' content='0; url=".base_url()."c_admin/login_user'>";
    }
  }
  
  private function editor_tinymce(){
  return '<script type="text/javascript" src="'.base_url().'tinymce/tinymce.min.js"></script>
          <script type="text/javascript">
            tinymce.init({
              selector: "textarea#yenda_editor",
              theme: "modern",
              width: 580,
              height: 200,
              plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
              ],
              content_css: "'.base_url().'tinymce/themes/modern/theme.min",
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
              style_formats: [
                {title: "Bold text", inline: "b"},
                {title: "Red text", inline: "span", styles: {color: "#ff0000"}},
                {title: "Red header", block: "h1", styles: {color: "#ff0000"}},
                {title: "Example 1", inline: "span", classes: "example1"},
                {title: "Example 2", inline: "span", classes: "example2"},
                {title: "Table styles"},
                {title: "Table row 1", selector: "tr", classes: "tablerow1"}
              ]
            });
          </script>';
  }

}
?>
