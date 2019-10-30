<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('Account');
        $this->load->model('Pencari');
        $this->load->model('Pemilik');
        $this->load->model('Kost');
        $this->load->model('Reservasi');
        $this->load->helper(array('form', 'url'));
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
    public function delete_akun($username,$role)
	{
        if($role=='pencari'){
            $this->Pencari->delete_akun($username);
            $this->Account->delete_akun($username);
            redirect('AdminController/admin');
        }
        else if ($role=='pemilik'){
            $this->Pemilik->delete_akun($username);
            $this->Account->delete_akun($username);
            redirect('AdminController/admin_pemilik');
        }
		
	}
    
    public function delete_kost($kodekost)
	{
        $this->Kost->delete_kost($kodekost);
		redirect('AdminController/admin_listkost');
    }
    public function validasi_reservasi($email,$kodekost,$no,$jumlahkamar){
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
            
            $data_update = array(
            "jumlahkamar"=> $jumlahkamar-1
            );
            $update = $this->Kost->update_kost($kodekost,$data_update);
            $this->Reservasi->delete_reservasi($no);
            
            
            $this->session->set_flashdata('reservasi_alert', 'berhasil');
            redirect('AdminController/admin_reservasi');
        }
        else{
            $this->session->set_flashdata('reservasi_alert', 'notlogin');
            redirect('WebController/index');
        }
    }
}

?>