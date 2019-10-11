<?php 

class Kost extends CI_Model{
    
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
    public function getkost_id($username){
        $this->db->where('namapemilik',$username);
        $data = $this->db->get('kost');
		return $data->result_array();
    }
    public function getkost_kode($kodekost){
        $this->db->where('kodekost',$kodekost);
        $result = $this->db->get('kost');
        if($result->num_rows()==1){
            return $result->row(0);
        }else{
            return false;
        }
    }
    public function delete_kost($kodekost){
        $this->db->where('kodekost',$kodekost);
		return $this->db->delete('kost');
    }
}
?>