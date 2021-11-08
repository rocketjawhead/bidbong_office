<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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

      $url = "v1/users/listCategory";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_category'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Category/Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    public function add(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $this->load->view('Header',$data);
      $this->load->view('Category/Add',$data);
      $this->load->view('Footer',$data);
    }

    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $name = $this->input->post('name');
      $description = $this->input->post('description');

      $url = "v1/users/addCategory";
      $post_data = array(
        'name' => $name,
        'description' => $description,
        'createdAt' => date("Y-m-d H:i:s"),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Add Data');
        redirect('Category');
      }else{
        $this->session->set_flashdata('error_msg','Failed Add Data');
        redirect('Category/add');
      }
    }

    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailCategory";
      $post_data = array(
        'id' => md5($id),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      // echo json_encode($post_data);
      // die();
      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200)
      {
        /////////////////////////////////////
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        
        $data['name'] = $res_dec['name'];
        $data['description'] = $res_dec['description'];
        $data['status'] = $res_dec['status'];

        $this->load->view('Header',$data);
        $this->load->view('Category/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Category');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $name = $this->input->post('name');
      $description = $this->input->post('description');
      $status = $this->input->post('status');

      $url = "v1/users/updateCategory";
      $post_data = array(
        'id' => md5($id),
        'name' => $name,
        'description' => $description,
        'status' => $status,
        'updatedAt' => date("Y-m-d H:i:s"),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Category');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Category/edit/'.$id);
      }
    }



    
}
           
