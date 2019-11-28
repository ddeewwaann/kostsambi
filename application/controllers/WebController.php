<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Account');
        $this->load->model('Kost');
        $this->load->model('Reservasi');
        $this->load->model('Pemilik');
        $this->load->model('Pencari');
        $this->load->helper(array('form', 'url'));
    }
	public function index()
	{
		$this->load->view('homepage');
	}
    public function daftarkost()
    {
        if($this->session->userdata('logged_in')==1 && $this->session->userdata('role')==2){
          $this->load->view('daftarkost');  
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
        
    }
    public function mykost(){
        if($this->session->userdata('logged_in')==1 && $this->session->userdata('role')==2){
            $username = $this->session->userdata('username');
            $data['kost'] = $this->Kost->getkost_id($username);
            $this->load->view('mykost',$data); 
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    
    public function login_data(){
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $ceklogin = $this->Account->login($username,$password);
        $role = $ceklogin->role;
        if ($ceklogin) {
            $sess_data = array(
            'logged_in' => 1,
            'username' => $ceklogin->username,
            'role' => $ceklogin->role,
            'password'=> $ceklogin->password,
            );
            if($role=='3'){
                $this->session->set_userdata($sess_data);
                redirect('AdminController/admin');
            }
            else{
                if($role=='1'){
                    $table = 'pencari';
                    $cekmail = $this->Account->get_akun2($table,$username);
                    $email_data = array(
                        'email' => $cekmail->email
                    );
                    $this->session->set_userdata($email_data);
                }
                $this->session->set_userdata($sess_data);
                $this->session->set_flashdata('login_alert', 'login_berhasil');
                redirect('WebController/index');
            }
        } else {
            $this->session->set_flashdata('login_alert', 'login_gagal');
            redirect('WebController/index');
        }
    }
    public function logout(){
        $this->session->sess_destroy();
        redirect('WebController/index');
    }
//    public function daftarakun_data(){
//        $pass = $this->input->post('password');
//        $data = array(
//            "nama"=> $this->input->post('nama',true),
//            "username"=> $this->input->post('username',true),
//            "password"=> md5($this->input->post('password',true)),
//            "email" => $this->input->post('email',true),
//            "noidentitas"=> $this->input->post('noidentitas',true),
//            "norekening"=> $this->input->post('norek',true),
//            "contact" => $this->input->post('contact',true)
//        );
//        $username = $this->input->post('username');
//        $role = $this->input->post('sebagai');
//        $repass = $this->input->post('repassword');
//        $akun = 'account';
//        if($pass==$repass){
//            if($this->Account->cekid_daftar($username)){
//                $this->session->set_flashdata('daftar_alert','registrasi_gagal');
//                redirect('WebController/index'); 
//            }
//            else{
//                if($role=="PENCARI KOST"){
//                    $table='pencari';
//                    $data2 = array(
//                        "username"=> $this->input->post('username',true),
//                        "password"=> md5($this->input->post('password',true)),
//                        "role"=> "1"
//                    );
//                    $role='1';
//                    $this->Account->daftar_akun($akun, $data2);
//                    $this->Pencari->daftar_akun($table, $data);
//                }
//                else{
//                    $table='pemilik';
//                    $data2 = array(
//                        "username"=> $this->input->post('username',true),
//                        "password"=> md5($this->input->post('password',true)),
//                        "role"=> "2"
//                    );
//                    $role='2';
//                    $this->Pemilik->daftar_akun($table, $data);
//                    $this->Account->daftar_akun($akun, $data2);
//                }
//                $sess_data = array(
//                    'logged_in' => 1,
//                    'username' => $username,
//                    'role' => $role
//                );
//                $this->session->set_userdata($sess_data);
//                $this->session->set_flashdata('daftar_alert','registrasi_berhasil');
//                redirect('WebController/index');
//            }
//        }
//        else{
//            $this->session->set_flashdata('daftar_alert','registrasi_gagal');
//                redirect('WebController/index');
//        }
//    }
    
     public function daftarakun_data(){
        $pass = $this->input->post('password');
        $data = array(
            "nama"=> $this->input->post('nama',true),
            "username"=> $this->input->post('username',true),
            "password"=> md5($this->input->post('password',true)),
            "email" => $this->input->post('email',true),
            "noidentitas"=> $this->input->post('noidentitas',true),
            "norekening"=> $this->input->post('norek',true),
            "contact" => $this->input->post('contact',true)
        );
        $email = $this->input->post('email');
        $username = $this->input->post('username');
        $role = $this->input->post('sebagai');
        $repass = $this->input->post('repassword');
        $akun = 'account';
        if($pass==$repass){
            if($role=="PENCARI KOST"){
                $table='pencari';
                $data2 = array(
                    "username"=> $this->input->post('username',true),
                    "password"=> md5($this->input->post('password',true)),
                    "role"=> "1"
                );
                $role='1';
                $sess_data = array(
                    'logged_in' => 1,
                    'username' => $username,
                    'role' => $role
                );
                if($this->Pencari->daftar_akun($table, $data,$username,$data2)){
                    //$this->Account->daftar_akun($akun, $data2);
                    $email_data = array(
                        'email' => $email
                    );
                    $this->session->set_userdata($email_data);
                    $this->session->set_userdata($sess_data);
                    $this->session->set_flashdata('daftar_alert','registrasi_berhasil');
                    redirect('WebController/index');
                }
                else{
                    $this->session->set_flashdata('daftar_alert','registrasi_gagal');
                    redirect('WebController/index');
                }
            }
            else{
                $table='pemilik';
                $data2 = array(
                    "username"=> $this->input->post('username',true),
                    "password"=> md5($this->input->post('password',true)),
                    "role"=> "2"
                );
                $role='2';
                $sess_data = array(
                    'logged_in' => 1,
                    'username' => $username,
                    'role' => $role
                );
                if($this->Pemilik->daftar_akun($table, $data,$username,$data2)){
                    //$this->Account->daftar_akun($akun, $data2);
                    $this->session->set_userdata($sess_data);
                    $this->session->set_flashdata('daftar_alert','registrasi_berhasil');
                    redirect('WebController/index');
                }
                else{
                    $this->session->set_flashdata('daftar_alert','registrasi_gagal');
                    redirect('WebController/index');
                }
            }
        }
        else{
            $this->session->set_flashdata('daftar_alert','registrasi_gagal');
                redirect('WebController/index');
        }
    }
    
    
    public function daftarkost_data(){
        $config['upload_path']          =  './upload/';
        $config['allowed_types']        =  'jpg|png|jpeg';
        $config['max_size']             =  2048;
        $config['max_width']            =  5000;
        $config['max_height']           = 5000;
        
        $this->load->library('upload',$config);
        $cek = $this->upload->do_upload('userfile');
        $content = $this->upload->data();
        $path = "upload/".$content["file_name"];

        $cek2 = $this->upload->do_upload('userfile2');
        $content2 = $this->upload->data();
        $path2 = "upload/".$content2["file_name"];

        $cek3 = $this->upload->do_upload('userfile3');
        $content3 = $this->upload->data();
        $path3 = "upload/".$content3["file_name"];

        $data = array(
            "namakost"=> $this->input->post('namakost',true),
            "kodekost"=> $this->input->post('kodekost',true),
            "alamat"=> $this->input->post('alamat',true),
            "fasilitas" => $this->input->post('fasilitas',true),
            "harga"=> $this->input->post('harga',true),
            "jenis"=> $this->input->post('jeniskost',true),
            "jumlahkamar"=>$this->input->post('jumlahkamar','true'),
            "namapemilik"=> $this->input->post('namapemilik', true),
            "contact" => $this->input->post('contact',true),
            "foto"=> $path,
            "foto2"=> $path2,
            "foto3"=> $path3
        );
        $kodekost = $this->input->post('kodekost',true);
        $cekkost = $this->Kost->cek_kost($kodekost);
        if($cek && $cek2 && $cek3){
            if($this->Kost->daftarkost($data,$kodekost)){
                $this->session->set_flashdata('daftarkost_alert', 'berhasil');
                redirect('WebController/daftarkost');
            }
            else{
                $this->session->set_flashdata('daftarkost_alert', 'kode');
                redirect('WebController/daftarkost');
            }
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'gagal');
            redirect('WebController/daftarkost');
        }
         
    }
    
    
    
    public function delete_mykost($kodekost)
	{
        $this->Kost->delete_kost($kodekost);
		redirect('webController/mykost');
	}
    public function view_kost_pemilik($kodekost){
        if($this->session->userdata('logged_in')==1 && $this->session->userdata('role')==2){
            $data['view_kost'] = $this->Kost->getkost_kode($kodekost);
            $this->load->view('view_kost',$data); 
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
        
    }
    public function myprofile_data($table,$username){
        if($this->session->userdata('logged_in')==1 && ($this->session->userdata('role')==1 || $this->session->userdata('role')==2)){
            $data['profile'] = $this->Account->getakun_id($table,$username);
            $this->load->view('myprofile',$data);
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    public function editkost($kodekost){
        if($this->session->userdata('logged_in')==1){
            $data['kostan'] = $this->Kost->getkost_kode($kodekost);
            $this->load->view('editkost',$data);
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    
    public function update_kost(){
        $data_update = array(
            "namakost"=> $this->input->post('namakost',true),
            "kodekost"=> $this->input->post('kodekost',true),
            "alamat"=> $this->input->post('alamat',true),
            "fasilitas" => $this->input->post('fasilitas',true),
            "harga"=> $this->input->post('harga',true),
            "jenis"=> $this->input->post('jeniskost',true),
            "jumlahkamar"=>$this->input->post('jumlahkamar','true'),
            "namapemilik"=> $this->input->post('namapemilik', true),
            "contact" => $this->input->post('contact',true)
        );
        $kodekost = $this->input->post('kodekost',true);
        $update = $this->Kost->update_kost($kodekost,$data_update);
        if($update){
            $this->session->set_flashdata('update_alert', 'update_berhasil');
            redirect('WebController/editkost/'.$kodekost);
        }else{
            $this->session->set_flashdata('update_alert', 'update_gagal');
            redirect('WebController/editkost/'.$kodekost);
        }
    }
    
    public function update_profile(){
        $table = $this->input->post('table');
        $data_update = array (
            'nama' => $this->input->post('nama'),
            'noidentitas'=> $this->input->post('noidentitas'),
            'norekening'=> $this->input->post('norek'),
            'contact'=>$this->input->post('contact')
        );
        $update = $this->Account->update_profile($table,$this->session->userdata('username'),$data_update);
        if($update){
            $this->session->set_flashdata('update_alert', 'update_berhasil');
            redirect('WebController/myprofile_data/'.$table.'/'.$this->session->userdata('username'));
        }else{
            $this->session->set_flashdata('update_alert', 'update_gagal');
            redirect('WebController/myprofile_data/'.$table.'/'.$this->session->userdata('username'));
        }
    }
    
    public function search_kost(){
        $data['kostan'] = $this->Kost->search_kost($this->input->post('keyword'));
        $this->load->view('search_kost',$data); 
    }
    
    public function view_kost_pencari($kodekost){
        $data['view_kost'] = $this->Kost->getkost_kode($kodekost);
        $this->load->view('view_kost',$data); 
        
    }
    
    public function change_password(){
        if($this->session->userdata('logged_in')==1){
            $this->load->view('change_password');
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    
    public function change_password_data(){
        $passwordbaru = md5($this->input->post('passwordbaru'));
        $passwordlama = md5($this->input->post('passwordlama'));
        $repassword = md5($this->input->post('repassword'));
        $table = $this->input->post('table');
        $akun = 'account';
        $cekpassword = $this->session->userdata('password');
        $data_update = array (
            'password' => $passwordbaru
        );
        if($passwordlama == $cekpassword){
            if($passwordbaru == $repassword){
                $update = $this->Account->update_profile($akun,$this->session->userdata('username'),$data_update);
                $update2 = $this->Account->update_profile($table,$this->session->userdata('username'),$data_update);
                $this->session->set_flashdata('password_alert', 'berhasil');
                redirect('WebController/myprofile_data/'.$table.'/'.$this->session->userdata('username'));
            }else{
                $this->session->set_flashdata('password_alert', 'repass');
                redirect('WebController/change_password');
            }
        }else{
            $this->session->set_flashdata('password_alert', 'oldpass');
            redirect('WebController/change_password');
        }
    }
    
    public function add_reservasi(){
        if($this->session->userdata('logged_in')==1 && $this->session->userdata('role')==1){
            $config['upload_path']          =  './reservasi/';
            $config['allowed_types']        =  'jpg|png';
            $config['max_size']             =  2048;
            $config['max_width']            =  5000;
            $config['max_height']           = 5000;
        
            $this->load->library('upload',$config);
            $cek = $this->upload->do_upload('userfile');
            $content = $this->upload->data();
            $path = "reservasi/".$content["file_name"];
            
            $kodekost = $this->input->post('kodekost',true);
            $pemilik = $this->Kost->get_pemilik($kodekost);
            $status = 'false';

            $data = array(
            "username"=> $this->input->post('username',true),
            "kodekost"=> $this->input->post('kodekost',true),
            "pemilik" => $pemilik->namapemilik,
            "jumlahkamar"=> $this->input->post('jumlahkamar',true),
            "nominalreservasi"=> $this->input->post('nominal',true),
            "email"=>$this->input->post('email',true),
            "foto"=> $path,
            "status"=> $status
        );
            $jumlahkamar = $this->input->post('jumlahkamar',true);
            if(($cek) && ($jumlahkamar>0)){
                $this->Reservasi->add_reservasi($data);
                $this->session->set_flashdata('reservasi_alert', 'berhasil');
                redirect('WebController/view_kost_pencari/'.$this->input->post('kodekost'));
            }
            else{
                $this->session->set_flashdata('reservasi_alert', 'gagal');
                redirect('WebController/view_kost_pencari/'.$this->input->post('kodekost'));
            }
        }
        else{
            $this->session->set_flashdata('reservasi_alert', 'notlogin');
            redirect('WebController/index');
        }
    }

    public function reservasi_data($username){
        if($this->session->userdata('logged_in')==1 && $this->session->userdata('role')==2){
            $data['reservasi'] = $this->Reservasi->get_reservasi_pemilik($username);
            $this->load->view('reservasi',$data);
        }
        else{
            $this->load->view('homepage');
        }
        
    }
    
    
    

}
        
    

