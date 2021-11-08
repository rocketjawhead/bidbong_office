<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ForgotPassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->load->helper(array('url'));
        $this->secretkey = $this->config->item('secretkey');
        $this->load->model('M_base','base');
    }


    public function index()
    {
      $this->load->view('ForgotPassword/ForgotPassword');
    }

    public function request_otp(){

      $url = "api/User/forgotpassword";
      $email = $this->input->post('email');

      if ($email == NULL || $email == "") {
        $this->session->set_flashdata('error_msg','Email tidak boleh kosong');
        redirect('ForgotPassword');
      }

      $data = array(
        'email' => $email,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$data);
      
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('ForgotPassword/otp/'.md5($email));
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('ForgotPassword');
      }

    }


    public function otp($email)
    {
      $this->load->view('ForgotPassword/Otp');
    }


    public function check_otp($email){

      $url = "api/User/checkotp";
      $otp = $this->input->post('otp');

      if ($otp == NULL || $otp == "") {
        $this->session->set_flashdata('error_msg','Kode OTP tidak boleh kosong');
        redirect('ForgotPassword/otp/'.$email);
      }

      $data = array(
        'email' => $email,
        'otp' => $otp,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$data);
      
      if($post['ResponseCode'] == '00'){
        redirect('ForgotPassword/reset_password/'.$email);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message'].$otp);
        redirect('ForgotPassword/otp/'.$email);
      }

    }


    public function reset_password($email)
    {
      $this->load->view('ForgotPassword/ResetPassword');
    }


    public function request_reset_password($email){

      $url = "api/User/resetpassword";
      $password = $this->input->post('password');
      $password_conf = $this->input->post('password_conf');

      if ($password == NULL || $password == "") {
        $this->session->set_flashdata('error_msg','Kata sandi baru tidak boleh kosong');
        redirect('ForgotPassword/reset_password/'.$email);
      }

      if ($password_conf == NULL || $password_conf == "") {
        $this->session->set_flashdata('error_msg','Konfirmasi Kata sandi baru tidak boleh kosong');
        redirect('ForgotPassword/reset_password/'.$email);
      }

      if ($password != $password_conf) {
        $this->session->set_flashdata('error_msg','Kata sandi tidak sama');
        redirect('ForgotPassword/reset_password/'.$email);
      }

      $data = array(
        'email' => $email,
        'password' => $password,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$data);
      
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Login');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('ForgotPassword/reset_password/'.$email);
      }

    }

    
}
           
