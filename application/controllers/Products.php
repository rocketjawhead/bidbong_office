<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

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

      $url = "v1/users/listProducts";
      $post_data = array(
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);

      $data['list_products'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Products/Dashboard',$data);
      $this->load->view('Footer',$data);
    }

    public function add(){
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
      $this->load->view('Products/Add',$data);
      $this->load->view('Footer',$data);
    }

    public function insert(){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $name = $this->input->post('name');
      $description = $this->input->post('description');
      $categoryId = $this->input->post('categoryId');
      $price = $this->input->post('price');

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_1']['name'])
      {
        if (!$this->upload->do_upload('image_1'))
        {
          $name_imageurl = NULL;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl = $this->URL_PROD.$gbr['file_name'];
        }
      }
      //

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_2']['name'])
      {
        if (!$this->upload->do_upload('image_2'))
        {
          $name_imageurl1 = NULL;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl1 = $this->URL_PROD.$gbr['file_name'];
        }
      }
      //

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_3']['name'])
      {
        if (!$this->upload->do_upload('image_3'))
        {
          $name_imageurl2 = NULL;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl2 = $this->URL_PROD.$gbr['file_name'];
        }
      }
      //

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_4']['name'])
      {
        if (!$this->upload->do_upload('image_4'))
        {
          $name_imageurl3 = NULL;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl3 = $this->URL_PROD.$gbr['file_name'];
        }
      }
      //

      $url = "v1/users/addProducts";
      $post_data = array(
        'name' => $name,
        'description' => $description,
        'categoryId' => $categoryId,
        'price' => $price,
        'images' => $name_imageurl,
        'images1' => $name_imageurl1,
        'images2' => $name_imageurl2,
        'images3' => $name_imageurl3,
        'createdAt' => date("Y-m-d H:i:s"),
        'userid' => $userid,
        'status' => 1,
        'typeimage' => $_FILES['image_4']['type'],
        'sizeimage' => $_FILES['image_4']['size'],
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Add Data');
        redirect('Products');
      }else{
        $this->session->set_flashdata('error_msg','Failed Add Data');
        redirect('Products/add');
      }
    }

    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/users/detailProducts";
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
        
        $data['name'] = $res_dec['name'];
        $data['categoryId'] = $res_dec['categoryId'];
        $data['categoryName'] = $res_dec['categoryName'];
        $data['description'] = $res_dec['description'];
        $data['price'] = $res_dec['price'];
        $data['images'] = $res_dec['images'];
        $data['images1'] = $res_dec['images1'];
        $data['images2'] = $res_dec['images2'];
        $data['images3'] = $res_dec['images3'];
        $data['status'] = $res_dec['status'];

        $url_category = "v1/users/listCategory";
        $post = $this->base->post_curl($url_category,$post_data);
        $data['list_category'] = $post['values'];

        $this->load->view('Header',$data);
        $this->load->view('Products/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Products');
      }
    }


    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');

      $name = $this->input->post('name');
      $description = $this->input->post('description');
      $categoryId = $this->input->post('categoryId');
      $price = $this->input->post('price');
      $status = $this->input->post('status');

      //existing images
      $url = "v1/users/detailProducts";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      $res = json_encode($post['values'][0]);
      $res_dec = json_decode($res,true);
      $data_images = $res_dec['images'];
      $data_images1 = $res_dec['images1'];
      $data_images2 = $res_dec['images2'];
      $data_images3 = $res_dec['images3'];
      //
      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_1']['name'])
      {
        if (!$this->upload->do_upload('image_1'))
        {
          $name_imageurl = $data_images;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl = $this->URL_PROD.$gbr['file_name'];
        }
      }else{
        $name_imageurl = $data_images;
      }
      //

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_2']['name'])
      {
        if (!$this->upload->do_upload('image_2'))
        {
          $name_imageurl1 = $data_images1;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl1 = $this->URL_PROD.$gbr['file_name'];
        }
      }else{
        $name_imageurl1 = $data_images1;
      }
      //

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_3']['name'])
      {
        if (!$this->upload->do_upload('image_3'))
        {
          $name_imageurl2 = $data_images2;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl2 = $this->URL_PROD.$gbr['file_name'];
        }
      }else{
        $name_imageurl2 = $data_images2;
      }
      //

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['image_4']['name'])
      {
        if (!$this->upload->do_upload('image_4'))
        {
          $name_imageurl3 = $data_images3;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl3 = $this->URL_PROD.$gbr['file_name'];
        }
      }else{
        $name_imageurl3 = $data_images3;
      }
      //

      $url = "v1/users/updateProducts";
      $post_data = array(
        'id' => $id,
        'name' => $name,
        'description' => $description,
        'categoryId' => $categoryId,
        'price' => $price,
        'images' => $name_imageurl,
        'images1' => $name_imageurl1,
        'images2' => $name_imageurl2,
        'images3' => $name_imageurl3,
        'updatedAt' => date("Y-m-d H:i:s"),
        'status' => $status,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      // echo json_encode($post_data);
      // die();
      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Products');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Products/edit/'.$id);
      }
    }



    
}
           
