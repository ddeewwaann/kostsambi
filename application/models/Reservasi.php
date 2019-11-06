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
    
    public function get_reservasi_admin($table)
	{
        $this->db->where('status','false');
        $data = $this->db->get($table);
		return $data->result_array();
    }
    
    public function get_reservasi_pemilik($username)
	{
        $this->db->where('pemilik',$username);
        $this->db->where('status','true');
        $data = $this->db->get('reservasi');
		return $data->result_array();
	}
    
     public function delete_reservasi($no){
        $this->db->where('no',$no);
		return $this->db->delete('reservasi');
    }

    function update_reservasi($no,$data){
        $this->db->where('no', $no);
        $update = $this->db->update('reservasi',$data);
        if ($update){
            return TRUE;
        }else{
            return FALSE;
        }
    }

}




?>