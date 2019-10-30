<?php 

class Pencari extends CI_Model{
    public function delete_akun($username){
        $this->db->where('username',$username);
		return $this->db->delete('pencari');
    }


}




?>