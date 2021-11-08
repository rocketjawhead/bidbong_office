<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Panel extends CI_Controller {

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

      $url = "v1/users/listDashboard";
      $post_data = array(
        'userid' => $userid
      );
      $post = $this->base->post_curl($url,$post_data);
      

      if($post['status'] == 200)
      {
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        // echo $res_dec['total_users'];
      }

      $res = json_encode($post['values'][0]);
      $res_dec = json_decode($res,true);
      $data['total_users'] = $res_dec['total_users'];
      $data['total_bids'] = $res_dec['total_bids'];
      $data['total_rooms'] = $res_dec['total_rooms'];

      $this->load->view('Header',$data);
      $this->load->view('Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    
}
           
