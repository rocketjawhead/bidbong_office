<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Verification extends CI_Controller {

    public function __construct()
    {
        parent::__construct();   
        $this->secretkey = $this->config->item('secretkey');
        $this->load->model('M_base','base');      
    }

    public function index($id){

      $url = "api/User/verification";
      
      $data = array(
        'uniqueid' => $id,
        'secretkey' => $this->secretkey
      );

      $post = $this->base->post_curl($url,$data);
      
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Login');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Verification/result');
      }
    }

    function result()
    {
        $this->load->view('Login/ResultVerification'); 
    }



    
    
}    
  