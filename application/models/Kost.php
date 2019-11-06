<?php 

class Kost extends CI_Model{
    
    // function daftarkost($data){
    //     $table = 'kost';
    //     $daftar= $this->db->insert($table,$data);
    //     if($daftar){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }

    function daftarkost($data,$kodekost){
        $this->db->where('kodekost',$kodekost);
        $cek = $this->db->get('kost');
        if($cek->num_rows()==1){
            return false;
        }
        else{
            $daftar= $this->db->insert('kost',$data);
            if($daftar){
                return true;
            }
            else{
                return false;
            }
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
            return $result->result_array();
        }else{
            return false;
        }
    }
    public function delete_kost($kodekost){
        $this->db->where('kodekost',$kodekost);
		return $this->db->delete('kost');
    }
    
    function update_kost($kodekost,$data){
        $this->db->where('kodekost', $kodekost);
        $update = $this->db->update('kost',$data);
        if ($update){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function search_kost($data){
        $this->db->like('alamat',$data);
        $query  = $this->db->get('kost');
        return $query->result_array();
    }
    
    function cek_kost($kodekost){
        $this->db->where('kodekost',$kodekost);
        $cek = $this->db->get('kost')->result_array();
        if(isset($cek[0])){
            return true;
        }
        else{
            return false;
        }
    }
    
}
?>