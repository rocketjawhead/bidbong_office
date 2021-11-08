<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

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
      $this->load->view('Register');
    }

    public function submit(){

      $url = "api/User/register";
      
      $data = array(
        'first_name' => $this->input->post('first_name'),
        'last_name' => $this->input->post('last_name'),
        'company_name' => $this->input->post('company_name'),
        'email' => $this->input->post('email'),
        'password' => $this->input->post('password'),
        'password_conf' => $this->input->post('password_conf'), 
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Login');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Register');
      }

    }

    
}
           
