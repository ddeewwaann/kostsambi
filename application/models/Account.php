<?php 

class Account extends CI_Model{
    
    function daftar_akun($table,$data){
        $daftar= $this->db->insert($table,$data);
        if($daftar){
            return true;
        }
        else{
            return false;
        }
    }
    function cekid_daftar($username){
        $this->db->where('username',$username);
        $cek = $this->db->get('account')->result_array();
        if(isset($cek[0])){
            return true;
        }
        else{
            return false;
        }
    }
    function login($username,$password){
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $result = $this->db->get('account');
        if($result->num_rows()==1){
            return $result->row(0);
        }else{
            return false;
        }
    }
    public function getakun($table)
	{
        $data = $this->db->get($table);
		return $data->result_array();
	}
    
    public function delete_akun($username){
        $this->db->where('username',$username);
		return $this->db->delete('account');
    }

}




?>