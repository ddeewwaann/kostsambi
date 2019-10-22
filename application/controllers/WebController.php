<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WebController extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Account');
        $this->load->model('Kost');
        $this->load->model('Reservasi');
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
     public function admin_reservasi(){
        $reservasi = 'reservasi';
        $data['reservasi'] = $this->Reservasi->get_reservasi($reservasi);
        $this->load->view('admin_reservasi',$data);
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
                redirect('WebController/admin');
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
        $kodekost = $this->input->post('kodekost',true);
        $cekkost = $this->Kost->cek_kost($kodekost);
        if($cek){
            if ($cekkost){
                $this->session->set_flashdata('daftarkost_alert', 'kode');
                redirect('WebController/daftarkost');
            }else{
                $this->Kost->daftarkost($data);
                $this->session->set_flashdata('daftarkost_alert', 'berhasil');
                redirect('WebController/daftarkost');
                
            }
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
            $this->load->view('view_kost',$data); 
        }
        else{
            $this->session->set_flashdata('daftarkost_alert', 'notlogin');
            redirect('WebController/index');
        }
        
    }
    public function myprofile_data($table,$username){
        if($this->session->userdata('logged_in')==1){
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
        if($this->input->post('keyword')) {
            redirect('WebController/search_kost');
        }
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
        if($this->session->userdata('logged_in')==1){
            $config['upload_path']          =  './reservasi/';
            $config['allowed_types']        =  'jpg|png';
            $config['max_size']             =  2048;
            $config['max_width']            =  5000;
            $config['max_height']           = 5000;
        
            $this->load->library('upload',$config);
            $cek = $this->upload->do_upload('userfile');
            $content = $this->upload->data();
            $path = "reservasi/".$content["file_name"];
            
            $data = array(
            "username"=> $this->input->post('username',true),
            "kodekost"=> $this->input->post('kodekost',true),
            "nominalreservasi"=> $this->input->post('nominal',true),
            "email"=>$this->input->post('email',true),
            "foto"=> $path
        );
            if($cek){
                $this->Reservasi->add_reservasi($data);
                $this->session->set_flashdata('reservasi_alert', 'berhasil');
                redirect('WebController/view_kost_pencari/'.$this->input->post('kodekost'));
            }
            else{
                
            }
        }
        else{
            $this->session->set_flashdata('reservasi_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    
    public function validasi_reservasi($email){
        if($this->session->userdata('logged_in')==1){
            $to = $email;
            $subject = 'VALIDASI RESERVASI';
            $from = 'muhammad.dsatriakamal@gmail.com';
            $message = 'SELAMAT RESERVASI ANDA TELAH TERVALIDASI, SCREENSHOOT PESAN INI UNTUK MENJADI BUKTI ANDA SUDAH RESERVASI KEPADA PEMILIK';
            
//            $emailContent = '<!DOCTYPE><html><head></head><body><table width="600px" style="border:1px solid #cccccc;margin: auto;border-spacing:0;"><tr><td style="background:#000000;padding-left:3%"><img src="http://codingmantra.co.in/assets/logo/logo.png" width="300px" vspace=10 /></td></tr>';
//            $emailContent .='<tr><td style="height:20px"></td></tr>';


            $emailContent = $message;  //   Post message available here


//            $emailContent .='<tr><td style="height:20px"></td></tr>';
//            $emailContent .= "<tr><td style='background:#000000;color: #999999;padding: 2%;text-align: center;font-size: 13px;'><p style='margin-top:1px;'><a href='http://codingmantra.co.in/' target='_blank' style='text-decoration:none;color: #60d2ff;'>www.codingmantra.co.in</a></p></td></tr></table></body></html>"; 
            
            $config['protocol']    = 'smtp';
            $config['smtp_host']    = 'ssl://smtp.gmail.com';
            $config['smtp_port']    = '465';
            $config['smtp_timeout'] = '60';

            $config['smtp_user']    = 'official.kostsambi@gmail.com';    //Important
            $config['smtp_pass']    = 'inikostsambi';  //Important

            $config['charset']    = 'utf-8';
            $config['newline']    = "\r\n";
            $config['mailtype'] = 'html'; // or html
            $config['validation'] = TRUE; // bool whether to validate email or not 

     

            $this->email->initialize($config);
            $this->email->set_mailtype("html");
            $this->email->from($from);
            $this->email->to($to);
            $this->email->subject($subject);
            $this->email->message($emailContent);
            $this->email->send();
            
            $this->session->set_flashdata('reservasi_alert', 'berhasil');
            redirect('WebController/admin_reservasi');
        }
        else{
            $this->session->set_flashdata('reservasi_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
    

}
        
    

