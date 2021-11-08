<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping extends CI_Controller {

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

      $url = "v1/users/listShipping";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_shipping'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Shipping/Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    public function add(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $this->load->view('Header',$data);
      $this->load->view('Shipping/Add',$data);
      $this->load->view('Footer',$data);
    }

    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $shippingCode = $this->input->post('shippingCode');
      $shippingName = $this->input->post('shippingName');
      $shippingDescription = $this->input->post('shippingDescription');
      $price = $this->input->post('price');
      $country = $this->input->post('country');
      $state = $this->input->post('state');
      $estimate = $this->input->post('estimate');

      $url = "v1/users/addlistShipping";
      $post_data = array(
        'shippingCode' => $shippingCode,
        'shippingName' => $shippingName,
        'shippingDescription' => $shippingDescription,
        'price' => $price,
        'country' => $country,
        'state' => $state,
        'estimate' => $estimate,
        'createdAt' => date("Y-m-d H:i:s"),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Add Data');
        redirect('Shipping');
      }else{
        $this->session->set_flashdata('error_msg','Failed Add Data');
        redirect('Shipping/add');
      }
    }

    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailListShipping";
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
        
        $data['shippingCode'] = $res_dec['shippingCode'];
        $data['shippingName'] = $res_dec['shippingName'];
        $data['shippingDescription'] = $res_dec['shippingDescription'];
        $data['price'] = $res_dec['price'];
        $data['country'] = $res_dec['country'];
        $data['estimate'] = $res_dec['estimate'];
        $data['state'] = $res_dec['state'];

        $this->load->view('Header',$data);
        $this->load->view('Shipping/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Shipping');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $shippingCode = $this->input->post('shippingCode');
      $shippingName = $this->input->post('shippingName');
      $shippingDescription = $this->input->post('shippingDescription');
      $price = $this->input->post('price');
      $country = $this->input->post('country');
      $state = $this->input->post('state');
      $estimate = $this->input->post('estimate');

      $url = "v1/users/updateShipping";
      $post_data = array(
        'id' => $id,
        'shippingCode' => $shippingCode,
        'shippingName' => $shippingName,
        'shippingDescription' => $shippingDescription,
        'price' => $price,
        'country' => $country,
        'state' => $state,
        'estimate' => $estimate,
        'updatedAt' => date("Y-m-d H:i:s"),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Shipping');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Shipping/edit/'.$id);
      }
    }



    
}
           
