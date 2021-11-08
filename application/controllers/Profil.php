<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profil extends CI_Controller {

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

    public function save_company(){

      $url = "api/Company/savecompany";
      
      $data = array(
        'company_name' => $this->input->post('company_name'),
        'company_type' => $this->input->post('company_type'),
        'address' => $this->input->post('address'),
        'email' => $this->input->post('email'),
        'phonenumber' => $this->input->post('phonenumber'),
        'instagram' => $this->input->post('instagram'),
        'facebook' => $this->input->post('facebook'),
        'twitter' => $this->input->post('twitter'),
        'website' => $this->input->post('website'),
        'provinsi' => $this->input->post('provinsi'),
        'kabupaten' => $this->input->post('kabupaten'),
        'kecamatan' => $this->input->post('kecamatan'),
        'kelurahan' => $this->input->post('kelurahan'),
        'userid' => $this->session->userdata('session_userid'),
        'secretkey' => $this->secretkey
      );

      // echo json_encode($data);
      // die();

      $post = $this->base->post_curl($url,$data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Panel');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Panel/firstcompany');
      }
    }


    public function profil_setting(){

      $url = "v1/users/getProfile";
      
      $data = array(
        'id' => $this->session->userdata('session_userid'),
        'secretkey' => $this->secretkey
      );
      $post = $this->base->post_curl($url,$data);
      if($post['status'] == 200)
      {
        // $json = json_decode($post['Data']);
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);

        $data['first'] = $res_dec['first'];
        $data['last'] = $res_dec['last'];
        $data['phone'] = $res_dec['phone'];
        $data['address'] = $res_dec['address'];
        $data['city'] = $res_dec['city'];
        $data['zipcode'] = $res_dec['zipcode'];
        $data['state'] = $res_dec['state'];
        $data['country'] = $res_dec['country'];
        $data['birthdate'] = date("Y-m-d", strtotime($res_dec['birthdate']));
        // echo $data['birthdate'];
        // die();
        
        $this->load->view('Header',$data);
        $this->load->view('Profil/Dashboard',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Panel');
      }
    }


    public function update(){

      $url = "v1/users/updateProfile";
      
      if (isset($this->input->post('first'))) {
        $first = $this->input->post('first');
      }else{
        $first = NULL;
      }

      if (isset($this->input->post('last'))) {
        $last = $this->input->post('last');
      }else{
        $last = NULL;
      }

      if (isset($this->input->post('phone'))) {
        $phone = $this->input->post('phone');
      }else{
        $phone = NULL;
      }

      if (isset($this->input->post('address'))) {
        $address = $this->input->post('address');
      }else{
        $address = NULL;
      }

      if (isset($this->input->post('city'))) {
        $city = $this->input->post('city');
      }else{
        $city = NULL;
      }

      if (isset($this->input->post('zipcode'))) {
        $zipcode = $this->input->post('zipcode');
      }else{
        $zipcode = NULL;
      }

      if (isset($this->input->post('state'))) {
        $state = $this->input->post('state');
      }else{
        $state = NULL;
      }

      if (isset($this->input->post('country'))) {
        $country = $this->input->post('country');
      }else{
        $country = NULL;
      }

      if (isset($this->input->post('birthdate'))) {
        $birthdate = $this->input->post('birthdate');
      }else{
        $birthdate = NULL;
      }


      $data = array(
        'first' => ,
        'last' => $last,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'zipcode' => $zipcode,
        'state' => $state,
        'country' => $country,
        'birthdate' => $birthdate,
        'id' => $this->session->userdata('session_userid'),
        'secretkey' => $this->secretkey
      );

      $post = $this->base->post_curl($url,$data);
      if($post['status'] == 200)
      {
        $this->session->set_userdata('session_name', $this->input->post('first'));
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Panel');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Profil/profil_setting');
      }
    }


    public function change_picture()
    {
        $this->load->view('Header');
        $this->load->view('Profil/ChangePicture');
        $this->load->view('Footer');  
    }

    public function update_picture(){
      $userid = $this->session->userdata('session_userid');

      //process image
      $this->load->library('upload');
      $nmfile = "file_".time(); 
      $config['upload_path'] = './uploads/img/'; 
      $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
      $config['max_size'] = '20488'; 
      $config['file_name'] = $nmfile; 
      $this->upload->initialize($config);
      if($_FILES['imageurl']['name'])
      {
        if (!$this->upload->do_upload('imageurl'))
        {
          $name_imageurl = NULL;
        }else{
          $gbr = $this->upload->data();
          $name_imageurl = $this->URL_PROD.$gbr['file_name'];
        }
      }else{
        $this->session->set_flashdata('error_msg','Gambar tidak dipilih');
        redirect('Profil/change_picture');
      }
      //

      $url = "api/Profil/updatepicture";
      $post_data = array(
        'userid' => $userid,
        'imageurl' => $name_imageurl,
        'secretkey' => $this->secretkey 
      );

      $post = $this->base->post_curl($url,$post_data);
      if($post['ResponseCode'] == '00'){
        $this->session->set_userdata('imageprofil', $name_imageurl);
        $this->session->set_flashdata('success_msg',$post['Message']);
        redirect('Panel');
      }else{
        $this->session->set_flashdata('error_msg',$post['Message']);
        redirect('Profil/change_picture');
      }
    }
    
}
           
