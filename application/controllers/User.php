<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

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

      $url = "api/User/listuser";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_user'] = $post['Data'];
      $this->load->view('Header',$data);
      $this->load->view('User/Dashboard',$data);
      $this->load->view('Footer',$data);
    }


    public function add(){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');

      //GetBranch
      $url_branch = "api/Branch/listbranch";
      $post_data_branch = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post_branch = $this->base->post_curl($url_branch,$post_data_branch);
      $data['list_branch'] = $post_branch['Data'];
      //
      
      $this->load->view('Header',$data);
      $this->load->view('User/Add',$data);
      $this->load->view('Footer',$data);
    }


    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');

      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $fullname = $this->input->post('fullname');
      $birthdate = $this->input->post('birthdate');
      $branch_id = $this->input->post('branch_id');
      $address = $this->input->post('address');
      $phonenumber = $this->input->post('phonenumber');

      if($username == NULL || $username == "")
      {
        $this->session->set_flashdata('error_msg',"Email tidak boleh kosong");
        redirect('User/add');
      }

      if($password == NULL || $password == "")
      {
        $this->session->set_flashdata('error_msg',"Kata sandi tidak boleh kosong");
        redirect('User/add');
      }

      if($fullname == NULL || $fullname == "")
      {
        $this->session->set_flashdata('error_msg',"Nama lengkap tidak boleh kosong");
        redirect('User/add');
      }

      if($birthdate == NULL || $birthdate == "")
      {
        $this->session->set_flashdata('error_msg',"Tanggal lahir tidak boleh kosong");
        redirect('User/add');
      }

      if($branch_id == NULL || $branch_id == "")
      {
        $this->session->set_flashdata('error_msg',"Cabang tidak boleh kosong");
        redirect('User/add');
      }

      if($address == NULL || $address == "")
      {
        $this->session->set_flashdata('error_msg',"Alamat tidak boleh kosong");
        redirect('User/add');
      }

      if($phonenumber == NULL || $phonenumber == "")
      {
        $this->session->set_flashdata('error_msg',"No.Telephone tidak boleh kosong");
        redirect('User/add');
      }

      $url = "api/User/insert";
      $post_data = array(
        'username' => $username,
        'password' => $password,
        'fullname' => $fullname,
        'birthdate' => $birthdate,
        'branch_id' => $branch_id,
        'address' => $address,
        'phonenumber' => $phonenumber,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('User');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('User/add');
      }
    }


    public function edit($cashier_id){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');
      
      $url = "api/User/detailuser";
      $post_data = array(
        'cashier_id' => $cashier_id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00')
      {
        //list branch
        $url_branch = "api/Branch/listbranch";
        $post_branch = $this->base->post_curl($url_branch,$post_data);
        $data['list_branch'] = $post_branch['Data'];
        //
        $data['id'] = $post['Data']['id'];
        $data['username'] = $post['Data']['username'];
        $data['fullname'] = $post['Data']['fullname'];
        $data['birthdate'] = $post['Data']['birthdate'];

        $data['branch_id'] = $post['Data']['branch_id'];
        $data['branch_name'] = $post['Data']['branch_name'];

        $data['phonenumber'] = $post['Data']['phonenumber'];
        $data['address'] = $post['Data']['address'];
        
        $this->load->view('Header',$data);
        $this->load->view('User/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('User');
      }
    }


    public function update($cashier_id){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');

      $username = $this->input->post('username');
      $fullname = $this->input->post('fullname');
      $birthdate = $this->input->post('birthdate');
      $branch_id = $this->input->post('branch_id');
      $address = $this->input->post('address');
      $phonenumber = $this->input->post('phonenumber');

      if($username == NULL || $username == "")
      {
        $this->session->set_flashdata('error_msg',"Email tidak boleh kosong");
        redirect('User/edit/'.$cashier_id);
      }

      if($fullname == NULL || $fullname == "")
      {
        $this->session->set_flashdata('error_msg',"Nama lengkap tidak boleh kosong");
        redirect('User/edit/'.$cashier_id);
      }

      if($birthdate == NULL || $birthdate == "")
      {
        $this->session->set_flashdata('error_msg',"Tanggal lahir tidak boleh kosong");
        redirect('User/edit/'.$cashier_id);
      }

      if($branch_id == NULL || $branch_id == "")
      {
        $this->session->set_flashdata('error_msg',"Cabang tidak boleh kosong");
        redirect('User/edit/'.$cashier_id);
      }

      if($address == NULL || $address == "")
      {
        $this->session->set_flashdata('error_msg',"Alamat tidak boleh kosong");
        redirect('User/edit/'.$cashier_id);
      }

      if($phonenumber == NULL || $phonenumber == "")
      {
        $this->session->set_flashdata('error_msg',"No.Telephone tidak boleh kosong");
        redirect('User/edit/'.$cashier_id);
      }

      $url = "api/User/update";
      $post_data = array(
        'cashier_id' => $cashier_id,
        'username' => $username,
        'fullname' => $fullname,
        'birthdate' => $birthdate,
        'branch_id' => $branch_id,
        'address' => $address,
        'phonenumber' => $phonenumber,
        'userid' => $userid,
        'secretkey' => $this->secretkey
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('User');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('User/edit/'.$cashier_id);
      }
    }


    public function delete($cashier_id){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');
      
      $url = "api/User/detailuser";
      $post_data = array(
        'cashier_id' => $cashier_id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00')
      {
        // $json = json_decode($post['Data']);
        $data['id'] = $post['Data']['id'];
        $data['username'] = $post['Data']['username'];
        $data['fullname'] = $post['Data']['fullname'];
        $data['birthdate'] = $post['Data']['birthdate'];

        $data['branch_id'] = $post['Data']['branch_id'];
        $data['branch_name'] = $post['Data']['branch_name'];

        $data['phonenumber'] = $post['Data']['phonenumber'];
        $data['address'] = $post['Data']['address'];
        
        $this->load->view('Header',$data);
        $this->load->view('User/Delete',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('User');
      }
    }

    public function dodelete($cashier_id){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');

      $url = "api/User/delete";
      $post_data = array(
        'cashier_id' => $cashier_id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('User');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('User/delete/'.$cashier_id);
      }
    }


    public function reset(){
      $this->load->view('Header');
      $this->load->view('User/ResetPassword');
      $this->load->view('Footer');
    }

    public function doreset($cashier_id){
      $userid = $this->session->userdata('session_userid');
      $data['fullname'] = $this->session->userdata('session_name');

      $url = "api/User/reset";
      $post_data = array(
        'cashier_id' => $cashier_id,
        'password' => $this->input->post('password'),
        'conf_password' => $this->input->post('conf_password'),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('User');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('User/reset/'.$cashier_id);
      }
    }


    
}
           
