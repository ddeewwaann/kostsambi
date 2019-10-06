<?php 

class kost extends CI_Model{
    
    function daftarkost($data){
        $table = 'kost';
        $daftar= $this->db->insert($table,$data);
        if($daftar){
            return true;
        }
        else{
            return false;
        }
    }
    function cekkode_daftar($kodekost){
        $this->db->where('kodekost',$kodekost);
        $cek = $this->db->get('kost')->result_array();
        if(isset($cek[0])){
            return true;
        }
        else{
            return false;
        }
    }
    public function getkost($table)
	{
        $data = $this->db->get($table);
		return $data->result_array();
	}
}
?>