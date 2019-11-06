<?php 

class Pemilik extends CI_Model{
    
    // function daftar_akun($table,$data){
    //     $daftar= $this->db->insert($table,$data);
    //     if($daftar){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
    
    function daftar_akun($table,$data,$username,$data2){
        $this->db->where('username',$username);
        $cekid = $this->db->get('account');
        if($cekid->num_rows()==1){
            return false;
        }
        else{
            $daftar= $this->db->insert($table,$data);
            $daftar2= $this->db->insert('account',$data2);
            if($daftar && $daftar2){
                return true;
            }
            else{
                return false;
            }
            
        }
        
    }

    public function getakun($table)
	{
        $data = $this->db->get($table);
		return $data->result_array();
    }
    
    

    function update_profile($table,$username,$data){
        $this->db->where('username', $username);
        $update = $this->db->update($table,$data);
        if ($update){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function delete_akun($username){
        $this->db->where('username',$username);
		return $this->db->delete('pemilik');
    }
    
    
    }





?>