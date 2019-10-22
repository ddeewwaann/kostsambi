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
    
    public function get_reservasi($table)
	{
        $data = $this->db->get($table);
		return $data->result_array();
	}

}




?>