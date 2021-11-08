<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {

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

      $url = "v1/users/listUser";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_master'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Master/Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    public function bidder(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "v1/users/listUser";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_master'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Master/Bidder',$data);
      $this->load->view('Footer',$data);
    }


    public function add(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "v1/users/listRole";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_role'] = $post['values'];


      $this->load->view('Header',$data);
      $this->load->view('Master/Add',$data);
      $this->load->view('Footer',$data);
    }


    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');


      $first = $this->input->post('first');
      $last = $this->input->post('last');
      $phone = $this->input->post('phone');
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $conf_password = $this->input->post('conf_password');
      $role = $this->input->post('role');

      if($email == NULL || $email == "")
      {
        $this->session->set_flashdata('error_msg',"Email Is Null");
        redirect('Master/add');
      }

      if($role == NULL || $role == "")
      {
        $this->session->set_flashdata('error_msg',"Role Is Null");
        redirect('Master/add');
      }

      if($password == NULL || $password == "")
      {
        $this->session->set_flashdata('error_msg',"Password Is Null");
        redirect('Master/add');
      }

      if($password != $conf_password)
      {
        $this->session->set_flashdata('error_msg',"Password & Confirmation password dismatch");
        redirect('Master/add');
      }


      $url = "v1/users/";
      $post_data = array(
        'first' => $first,
        'last' => $last,
        'phone' => $phone,
        'email' => $email,
        'password' => $password,
        'roleId' => $role,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      
      $post = $this->base->post_curl($url,$post_data);
      if($post['success'] == true){
        $this->session->set_flashdata('success_msg','Success Created new user');
        redirect('Master');
      }else{
        $this->session->set_flashdata('error_msg','Success Created new user failed');
        redirect('Master/add');
      }
    }


    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailUser";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      // echo $post['values']['id'];

      if($post['status'] == 200)
      {
        /////////////////////////////////////

        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        
        $data['id'] = $res_dec['id'];
        $data['first'] = $res_dec['first'];
        $data['last'] = $res_dec['last'];
        $data['email'] = $res_dec['email'];
        $data['phone'] = $res_dec['phone'];
        $data['address'] = $res_dec['address'];
        $data['city'] = $res_dec['city'];
        $data['zipcode'] = $res_dec['zipcode'];
        $data['state'] = $res_dec['state'];
        $data['country'] = $res_dec['country'];
        $data['countryshipping'] = $res_dec['countryshipping'];
        
        $data['birthdate'] = $res_dec['birthdate'];

        $data['role_name'] = $res_dec['role_name'];
        $data['role_id'] = $res_dec['role_id'];

        $data['status'] = $res_dec['status'];

        $this->load->view('Header',$data);
        $this->load->view('Master/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Master');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');


      $first = $this->input->post('first');
      $last = $this->input->post('last');
      // $birthdate = $this->input->post('birthdate');
      $phone = $this->input->post('phone');
      $email = $this->input->post('email');
      $address = $this->input->post('address');
      $city = $this->input->post('city');
      $zipcode = $this->input->post('zipcode');
      $state = $this->input->post('state');
      $country = $this->input->post('country');
      $status = $this->input->post('status');
      $role_id = $this->input->post('role_id');
      // $password = $this->input->post('password');
      // $conf_password = $this->input->post('conf_password');

      // echo $birthdate;
      // die();
    
      if($email == NULL || $email == "")
      {
        $this->session->set_flashdata('error_msg',"Email Is Null");
        redirect('Master/edit/'.$id);
      }

      if ($first == NULL || $first == "") {
        $first = NULL;
      }else{
        $first = $this->input->post('first');
      }

      if ($last == NULL || $last == "") {
        $last = NULL;
      }else{
        $last = $this->input->post('last');
      }

      if ($phone == NULL || $phone == "") {
        $phone = NULL;
      }else{
        $phone = $this->input->post('phone');
      }

      if ($address == NULL || $address == "") {
        $address = NULL;
      }else{
        $address = $this->input->post('address');
      }

      if ($city == NULL || $city == "") {
        $city = NULL;
      }else{
        $city = $this->input->post('city');
      }

      //
      $cnt_zipcode = strlen($zipcode);
      //

      if ($zipcode == NULL || $zipcode == "" || $cnt_zipcode == 0) {
        $zipcode = 0;
      }else{
        $zipcode = $this->input->post('zipcode');
      }

      if ($state == NULL || $state == "") {
        $state = NULL;
      }else{
        $state = $this->input->post('state');
      }

      if ($country == NULL || $country == "") {
        $country = NULL;
      }else{
        $country = $this->input->post('country');
      }

      // if ($birthdate == NULL || $birthdate == "") {
      //   $birthdate = "0000-00-00";
      // }else{
      //   $birthdate = $this->input->post('birthdate');
      // }

      // if(isset($password))
      // {
      //   if($password != $conf_password)
      //   {
      //     $this->session->set_flashdata('error_msg',"Password & Confirmation Password dismatch");
      //     redirect('Master/edit/'.$id);
      //   }
      // }

      

      $url = "v1/users/updateUser";
      $post_data = array(
        'id' => $id,
        'first' => $first,
        'last' => $last,
        // 'birthdate' => $birthdate,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'city' => $city,
        'zipcode' => $zipcode,
        'state' => $state,
        'country' => $country,
        'status' => $status,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );


      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        if ($role_id == 5) {
          redirect('Master/bidder/');
        }else{
          redirect('Master');
        }
        
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Master/edit/'.$id);
      }
    }


    public function delete($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "api/Master/detail";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00')
      {
        // $json = json_decode($post['Data']);
        $data['id'] = $post['Data']['id'];
        $data['email'] = $post['Data']['email'];
        
        $this->load->view('Header',$data);
        $this->load->view('Master/Delete',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Master');
      }
    }

    public function dodelete($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "api/Master/delete";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      // echo json_encode($post_data);
      // die();
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Master');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Master/delete/'.$id);
      }
    }


    
}
           
