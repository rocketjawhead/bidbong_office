<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rate extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library('cart');
        $this->load->model('M_base','base');
        $this->secretkey = $this->config->item('secretkey');
        // if($this->session->userdata('is_logged_in') =='')
        // {
        //  $this->session->set_flashdata('msg','Please Login to Continue');
        //  redirect('Login');
        // }
    }

    public function index(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "v1/users/listRate";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_rate'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Rate/Dashboard',$data);
      $this->load->view('Footer',$data);
    }



    
}
           
