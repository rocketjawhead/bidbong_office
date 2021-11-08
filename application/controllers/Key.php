<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Key extends CI_Controller {

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

      $url = "v1/users/listKey";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_master_key'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Key/Dashboard',$data);
      $this->load->view('Footer',$data);
    }


    public function add(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      $this->load->view('Header',$data);
      $this->load->view('Key/Add',$data);
      $this->load->view('Footer',$data);
    }


    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $qty = $this->input->post('qty');
      $valid_from = $this->input->post('valid_from');
      $valid_to = $this->input->post('valid_to');
      $type_key = $this->input->post('type_key');

      if($qty == NULL || $qty == "")
      {
        $this->session->set_flashdata('error_msg',"QTY Is Null");
        redirect('Key/add');
      }

      if($valid_from == NULL || $valid_from == "")
      {
        $this->session->set_flashdata('error_msg',"Valid From Is Null");
        redirect('Key/add');
      }

      if($valid_to == NULL || $valid_to == "")
      {
        $this->session->set_flashdata('error_msg',"Valid To Is Null");
        redirect('Key/add');
      }

      if($type_key == NULL || $type_key == "")
      {
        $this->session->set_flashdata('error_msg',"Valid To Is Null");
        redirect('Key/add');
      }

      $url = "api/Key/insert";
      $post_data = array(
        'qty' => $qty,
        'userid' => $userid,
        'valid_from' => $valid_from,
        'valid_to' => $valid_to,
        'type_key' => $type_key, 
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Key');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Key/add');
      }
    }


    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailKey";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200)
      {


        // $json = json_decode($post['Data']);
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        // echo substr($res_dec['disc_valid_from'], 0,10);
        // die();
        $data['id'] = $res_dec['id'];
        $data['name'] = $res_dec['name'];
        $data['description'] = $res_dec['description'];
        $data['discount'] = $res_dec['discount'];
        $data['price'] = $res_dec['price'];
        $data['disc_valid_from'] = substr($res_dec['disc_valid_from'], 0,10);
        $data['disc_valid_to'] = substr($res_dec['disc_valid_to'], 0,10);
        $data['status'] = $res_dec['status'];
        
        $this->load->view('Header',$data);
        $this->load->view('Key/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Key');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $name = $this->input->post('name');
      $description = $this->input->post('description');
      $price = $this->input->post('price');
      $discount = $this->input->post('discount');
      $disc_valid_from = $this->input->post('disc_valid_from');
      $disc_valid_to = $this->input->post('disc_valid_to');
      $status = $this->input->post('status');

      if($name == NULL || $name == "")
      {
        $this->session->set_flashdata('error_msg',"Title Key Is Null");
        redirect('Key/add');
      }


      if ($disc_valid_from == '') {
        $new_valid_from = null;
      }else{
        $new_valid_from = $disc_valid_from;
      }

      if ($disc_valid_to == '') {
        $new_valid_to = null;
      }else{
        $new_valid_to = $disc_valid_to;
      }

      $url = "v1/users/updateKey";
      $post_data = array(
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'discount' => $discount,
        'userid' => $userid,
        'disc_valid_from' => $new_valid_from,
        'disc_valid_to' => $new_valid_to,
        'status' => $status,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Key');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Key/edit/'.$id);
      }
    }


    public function delete($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "api/Key/detail";
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
        $data['qty'] = $post['Data']['qty'];
        $data['valid_from'] = $post['Data']['valid_from'];
        $data['valid_to'] = $post['Data']['valid_to'];
        $data['type_key'] = $post['Data']['type_key'];
        $data['id_type_key'] = $post['Data']['id_type_key'];
        
        $this->load->view('Header',$data);
        $this->load->view('Key/Delete',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Key');
      }
    }

    public function dodelete($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "api/Key/delete";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Key');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Key/delete/'.$id);
      }
    }

    //promotion key
    public function promotionkey(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "v1/users/listPromotion";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_promotion'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('PromotionKey/Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    public function addpromotionkey(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      $url = "v1/users/listKey";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      $data['list_master_key'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('PromotionKey/Add',$data);
      $this->load->view('Footer',$data);
    }

    public function insertpromotionkey(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $title_promo = $this->input->post('title_promo');
      $desc_promo = $this->input->post('desc_promo');
      $key_id = $this->input->post('key_id');
      $amount = $this->input->post('amount');
      $valid_from = $this->input->post('valid_from');
      $valid_to = $this->input->post('valid_to');
      $status = $this->input->post('status');

      $url = "v1/users/addPromotion";
      $post_data = array(
        'title_promo' => $title_promo,
        'desc_promo' => $desc_promo,
        'key_id' => $key_id,
        'amount' => $amount,
        'valid_from' => $valid_from,
        'valid_to' => $valid_to,
        'status' => 1,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Add Data');
        redirect('Key/promotionkey');
      }else{
        $this->session->set_flashdata('error_msg','Failed Add Data');
        redirect('Key/addpromotionkey');
      }
    }

    public function editpromotionkey($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailPromotion";
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
        
        $data['title_promo'] = $res_dec['title_promo'];
        $data['desc_promo'] = $res_dec['desc_promo'];
        $data['key_id'] = $res_dec['key_id'];
        $data['key_name'] = $res_dec['key_name'];
        $data['amount'] = $res_dec['amount'];
        $data['valid_from'] = $res_dec['valid_from'];
        $data['valid_to'] = $res_dec['valid_to'];
        $data['status'] = $res_dec['status'];

        //
        $url_key = "v1/users/listKey";
        $post_data_key = array(
          'userid' => $userid,
          'secretkey' => $this->secretkey 
        );
        $res_key = $this->base->post_curl($url_key,$post_data_key);
        $data['list_master_key'] = $res_key['values'];
        //

        $this->load->view('Header',$data);
        $this->load->view('PromotionKey/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Key/promotionkey');
      }
    }

    public function updatepromotionkey($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $title_promo = $this->input->post('title_promo');
      $desc_promo = $this->input->post('desc_promo');
      $key_id = $this->input->post('key_id');
      $amount = $this->input->post('amount');
      $valid_from = $this->input->post('valid_from');
      $valid_to = $this->input->post('valid_to');
      $status = $this->input->post('status');

      $url = "v1/users/updatePromotion";
      $post_data = array(
        'id' => $id,
        'title_promo' => $title_promo,
        'desc_promo' => $desc_promo,
        'key_id' => $key_id,
        'amount' => $amount,
        'valid_from' => $valid_from,
        'valid_to' => $valid_to,
        'status' => $status,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Key/promotionkey');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Key/editpromotionkey/'.$id);
      }
    }


    
}
           
