<?php 

class Reservasi extends CI_Model{
    
    function add_reservasi($data){
        $daftar= $this->db->insert('reservasi',$data);
        if($daftar){
            return true;
        }
        else{
            return false;
        }
    }
    

}




?>