<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Room extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->library('cart');
        $this->load->model('M_base','base');
        $this->secretkey = $this->config->item('secretkey');
        $this->URL_PROD = $this->config->item('base_url_image');
        // if($this->session->userdata('is_logged_in') =='')
        // {
        //  $this->session->set_flashdata('msg','Please Login to Continue');
        //  redirect('Login');
        // }
    }

    public function index(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "v1/users/listRoom";
      $post_data = array(
        'userid' => $userid
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_room'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Room/Dashboard',$data);
      $this->load->view('Footer',$data);
    }


    public function add(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      //key
      $url = "v1/Users/listkey";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      //
      //product
      $url_products = "v1/Users/listProducts";
      $post_products = $this->base->post_curl($url_products,$post_data);
      //
      
      $data['list_key'] = $post['values'];
      $data['list_products'] = $post_products['values'];
      $this->load->view('Header',$data);
      $this->load->view('Room/Add',$data);
      $this->load->view('Footer',$data);
    }


    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $allowKey = $this->input->post('allowKey');
      $productId = $this->input->post('productId');
      $maxxBidder = $this->input->post('maxxBidder');
      $startBid = $this->input->post('startBid');
      $endBid = $this->input->post('endBid');
      $setWinnerDate = $this->input->post('setWinnerDate');
      $maxxBidder = $this->input->post('maxxBidder');
      $createdAt = date("Y-m-d H:i:s");

      $url = "v1/Users/addRoom";
      $post_data = array(
        'allowKey' => $allowKey,
        'productId' => $productId,
        'maxxBidder' => $maxxBidder,
        'startBid' => $startBid,
        'endBid' => $endBid,
        'setWinnerDate' => $setWinnerDate,
        'maxxBidder' => $maxxBidder,
        'createdAt' => $createdAt,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Insert Data');
        redirect('Room');
      }else{
        $this->session->set_flashdata('error_msg','Failed Insert Data');
        redirect('Room/add');
      }
    }


    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/Users/detailRoom";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      // echo json_encode($post_data);
      // die();
      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200)
      {
        //key
        $url_key = "v1/Users/listkey";
        $post_key = $this->base->post_curl($url_key,$post_data);
        //
        //product
        $url_products = "v1/Users/listProducts";
        $post_products = $this->base->post_curl($url_products,$post_data);
        //
        
        $data['list_key'] = $post_key['values'];
        $data['list_products'] = $post_products['values'];

        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        
        $data['id'] = $res_dec['id'];
        $data['productId'] = $res_dec['productId'];
        $data['productName'] = $res_dec['productName'];
        $data['allowKey'] = $res_dec['allowKey'];
        $data['keyName'] = $res_dec['keyName'];
        $data['startBid'] =date("Y-m-d", strtotime($res_dec['startBid']));
        $data['endBid'] = date("Y-m-d", strtotime($res_dec['endBid']));
        $data['setWinnerDate'] = date("Y-m-d", strtotime($res_dec['setWinnerDate']));
        $data['maxBidder'] = $res_dec['maxBidder'];

        $this->load->view('Header',$data);
        $this->load->view('Room/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Room');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');


      $productId = $this->input->post('productId');
      $allowKey = $this->input->post('allowKey');
      $startBid = $this->input->post('startBid');
      $endBid = $this->input->post('endBid');
      $setWinnerDate = $this->input->post('setWinnerDate');
      $maxBidder = $this->input->post('maxBidder');

      $url = "v1/Users/updateRoom";
      $post_data = array(
        'id' => $id,
        'productId' => $productId,
        'allowKey' => $allowKey,
        'startBid' => $startBid,
        'endBid' => $endBid,
        'setWinnerDate' => $setWinnerDate,
        'maxBidder' => $maxBidder,
        'updatedAt' => date("Y-m-d H:i:s"),
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      // echo json_encode($post_data);
      // die();
      $post = $this->base->post_curl($url,$post_data);
      
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Room');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Room/edit/'.$id);
      }
    }


    public function delete($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "api/Room/detail";
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
        $this->load->view('Room/Delete',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Master');
      }
    }

    public function dodelete($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "api/Room/delete";
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


    public function winner($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $url = "v1/users/listBidder";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      $data['list_bidder'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Room/Winner',$data);
      $this->load->view('Footer',$data);
    }

    public function set_winner($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/Users/configEmail";
      $url_update_bidder = "v1/Users/updateSetWinner";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'buyer_id' => $this->input->post('buyer_id'),
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      $post_update_bidder = $this->base->post_curl($url_update_bidder,$post_data);
      if($post['status'] == 200)
      {

        //config email
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        $data['Host'] = $res_dec['Host'];
        $data['User'] = $res_dec['User'];
        $data['Pass'] = $res_dec['Pass'];
        $data['Port'] = $res_dec['Port'];
        //end config email

        //detail product
        $url = "v1/Users/detailRoomSendEmail";
        $post_email = $this->base->post_curl($url,$post_data);
        $res_email = json_encode($post_email['values'][0]);
        $res_email_dec = json_decode($res_email,true);
        
        $send_email = $this->base->update_transaction_waiting_payment($data['Host'],$data['User'],$data['Pass'],$data['Port'],$res_email_dec['productName'],$res_email_dec['email'],$res_email_dec['images'],$res_email_dec['nominal'],$res_email_dec['delivery_price'],$res_email_dec['payment_trxid'],$res_email_dec['tracking_code'],$res_email_dec['paymentDate'],$res_email_dec['country']);

        $this->session->set_flashdata('success_msg','Success, Set Winner !');
        redirect('Room');
      }else{
        $this->session->set_flashdata('error_msg','Failed, Try Again !');
        redirect('Room');
      }
    }



    
}
           
