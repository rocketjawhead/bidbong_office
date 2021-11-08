<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ConfigEmail extends CI_Controller {

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

      $url = "v1/users/listConfigemail";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_config'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Email/Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailConfigemail";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200)
      {
        /////////////////////////////////////
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        
        $data['Host'] = $res_dec['Host'];
        $data['User'] = $res_dec['User'];
        $data['Pass'] = $res_dec['Pass'];
        $data['Port'] = $res_dec['Port'];

        $this->load->view('Header',$data);
        $this->load->view('Email/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('ConfigEmail');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $Host = $this->input->post('Host');
      $User = $this->input->post('User');
      $Pass = $this->input->post('Pass');
      $Port = $this->input->post('Port');

      $url = "v1/users/updateConfigemail";
      $post_data = array(
        'id' => $id,
        'Host' => $Host,
        'User' => $User,
        'Pass' => $Pass,
        'Port' => $Port,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('ConfigEmail');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('ConfigEmail/edit/'.$id);
      }
    }



    
}
           
