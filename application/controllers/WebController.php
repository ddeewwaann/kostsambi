<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Account');
        $this->load->model('Kost');
        $this->load->helper(array('form', 'url'));
    }
	public function index()
	{
		$this->load->view('homepage');
	}
    public function daftarkost()
    {
        if($this->session->userdata('logged_in')==1){
          $this->load->view('daftarkost');  
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
        
    }
    public function mykost(){
        if($this->session->userdata('logged_in')==1){
            $username = $this->session->userdata('username');
            $data['kost'] = $this->Kost->getkost_id($username);
            $this->load->view('mykost',$data); 
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    public function admin(){
        $pencari = 'pencari';
        $data['pencari'] = $this->Account->getakun($pencari);
        $this->load->view('admin',$data);
    }
    public function admin_pemilik(){
        $pemilik = 'pemilik';
        $data['pemilik'] = $this->Account->getakun($pemilik);
        $this->load->view('admin_pemilik',$data);
    }
    public function admin_listkost(){
        $kost = 'kost';
        $data['kost'] = $this->Kost->getkost($kost);
        $this->load->view('admin_listkost',$data);
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
            'role' => $ceklogin->role
            );
            if($role=='3'){
                $this->session->set_userdata($sess_data);
                redirect('WebController/admin');
            }
            else{
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
        $username = $this->input->post('username');
        $role = $this->input->post('sebagai');
        $repass = $this->input->post('repassword');
        $akun = 'account';
        if($pass==$repass){
            if($this->Account->cekid_daftar($username)){
                $this->session->set_flashdata('daftar_alert','registrasi_gagal');
                redirect('WebController/index'); 
            }
            else{
                if($role=="PENCARI KOST"){
                    $table='pencari';
                    $data2 = array(
                        "username"=> $this->input->post('username',true),
                        "password"=> md5($this->input->post('password',true)),
                        "role"=> "1"
                    );
                    $role='1';
                    $this->Account->daftar_akun($akun, $data2);
                }
                else{
                    $table='pemilik';
                    $data2 = array(
                        "username"=> $this->input->post('username',true),
                        "password"=> md5($this->input->post('password',true)),
                        "role"=> "2"
                    );
                    $role='2';
                    $this->Account->daftar_akun($akun, $data2);
                }
                $sess_data = array(
                    'logged_in' => 1,
                    'username' => $username,
                    'role' => $role
                );
                $this->session->set_userdata($sess_data);
                $this->Account->daftar_akun($table, $data);
                $this->session->set_flashdata('daftar_alert','registrasi_berhasil');
                redirect('WebController/index');
            }
        }
        else{
            $this->session->set_flashdata('daftar_alert','registrasi_gagal');
                redirect('WebController/index');
        }
    }
    public function daftarkost_data(){
        $config['upload_path']          =  './upload/';
        $config['allowed_types']        =  'jpg|png';
        $config['max_size']             =  2048;
        $config['max_width']            =  5000;
        $config['max_height']           = 5000;
        
        $this->load->library('upload',$config);
        $cek = $this->upload->do_upload('userfile');
        $content = $this->upload->data();
        $path = "upload/".$content["file_name"];
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
            "foto"=> $path
        );
        if($cek){
            $this->Kost->daftarkost($data);
            $this->session->set_flashdata('daftarkost_alert', 'berhasil');
            redirect('WebController/daftarkost');
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'gagal');
            redirect('WebController/daftarkost');
        }
         
    }
    
    public function delete_akun($username)
	{
        $this->Account->delete_akun($username);
		redirect('WebController/admin');
	}
    
    public function delete_kost($kodekost)
	{
        $this->Kost->delete_kost($kodekost);
		redirect('webController/admin_listkost');
	}
    
    public function delete_mykost($kodekost)
	{
        $this->Kost->delete_kost($kodekost);
		redirect('webController/mykost');
	}
    public function view_kost_pemilik($kodekost){
        if($this->session->userdata('logged_in')==1){
            $data['view_kost'] = $this->Kost->getkost_kode($kodekost);
            $this->load->view('view_kost_pemilik',$data); 
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
        
    }
}
