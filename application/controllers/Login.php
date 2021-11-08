<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();   
        $this->secretkey = $this->config->item('secretkey');
        $this->load->model('M_base','base');      
    }

    function index()
    {
        
        $this->load->view('Login/Login'); 
    }

    public function check_login(){
      // redirect('Panel');

      $url = "v1/users/login";
      
      $data = array(
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password')
      );

      $post = $this->base->post_curl($url,$data);

      if($post['success'] == 'true'){

        $data = array(
                'session_userid' =>$post['user']['id'],
                'session_email' =>$post['user']['email'],
                'session_fullname' => $post['user']['first'].' '.$post['user']['last'],
                'is_logged_in' => 'login'
                );
        $this->session->set_userdata($data);
        redirect('Panel');
      }else{
        
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Login');
      }
    }

    public function logout(){
      $array_items = array(
        'session_userid', 
        'session_name',
        'session_uniqueid',
        'user_type',
        'company_type',
        'is_logged_in',
      );

      $this->session->unset_userdata($array_items);
      $this->session->set_flashdata('msg', 'Admin Signed Out Now!');
      redirect('Login');
    }


    
    
}    
  