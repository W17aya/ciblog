<?php
class M_login extends CI_Model{

    function cekdb(){

    $username = $this->input->post('username');
    $password = MD5($this->input->psot('password'));

    $query->$this->db->query("select * from users where username ='$username");
    return $query;

    }
}
?>