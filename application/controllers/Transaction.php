<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

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

      $post_data = array(
        'userid' => $userid
      );
      //listTransactions
      $url = "v1/users/listTransactions";
      $post = $this->base->post_curl($url,$post_data);
      $data['list_transactions'] = $post['values'];
      //listTransactionsPayment
      $url = "v1/users/listTransactionsPayment";
      $post = $this->base->post_curl($url,$post_data);
      $data['list_transactions_payment'] = $post['values'];
      //listTransactionsOrder
      $url = "v1/users/listTransactionsOrder";
      $post = $this->base->post_curl($url,$post_data);
      $data['list_transactions_order'] = $post['values'];
      //listTransactionsDelivery
      $url = "v1/users/listTransactionsDelivery";
      $post = $this->base->post_curl($url,$post_data);
      $data['list_transactions_delivery'] = $post['values'];
      $this->load->view('Header',$data);
      $this->load->view('Transaction/Dashboard',$data);
      $this->load->view('Footer',$data);
    }


    public function edit($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');
      
      $url = "v1/Users/detailTransactions";
      $post_data = array(
        'id' => $id,
        'userid' => $userid,
        'secretkey' => $this->secretkey 
      );
      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200)
      {
        
        //liststatus
        $url_key = "v1/Users/listStatusTransactions";
        $post_key = $this->base->post_curl($url_key,$post_data);
        $data['list_status_transaction'] = $post_key['values'];
        //
        $res = json_encode($post['values'][0]);
        $res_dec = json_decode($res,true);
        
        $data['id'] = $res_dec['id'];
        $data['storeId'] = $res_dec['storeId'];
        $data['first'] = $res_dec['first'];
        $data['last'] = $res_dec['last'];
        $data['product_name'] = $res_dec['product_name'];
        $data['nominal'] = $res_dec['nominal'];
        $data['status_name'] = $res_dec['status_name'];
        $data['status_code'] = $res_dec['status_code'];
        $data['payment_date'] = $res_dec['payment_date'];

        $this->load->view('Header',$data);
        $this->load->view('Transaction/Edit',$data);
        $this->load->view('Footer',$data);
      }else{
        $this->session->set_flashdata('error_msg','Try Again');
        redirect('Transaction');
      }
    }

    public function update($id){
      $userid = $this->session->userdata('session_userid');
      $data['email'] = $this->session->userdata('session_email');


      $paymentStatus = $this->input->post('paymentStatus');
      $url = "v1/Users/updateTransactions";
      $post_data = array(
        'id' => $id,
        'paymentStatus' => $paymentStatus,
        'updatedAt' => date("Y-m-d H:i:s"),
        'secretkey' => $this->secretkey 
      );

      //config email
      $url_config = "v1/Users/configEmail";
      $post_config = $this->base->post_curl($url_config,$post_data);
      $res = json_encode($post_config['values'][0]);
      $res_dec = json_decode($res,true);
      $data['Host'] = $res_dec['Host'];
      $data['User'] = $res_dec['User'];
      $data['Pass'] = $res_dec['Pass'];
      $data['Port'] = $res_dec['Port'];
      //end config email

      //detailProduct
      $post_data_product = array(
        'id' => $this->input->post('storeId'),
        'secretkey' => $this->secretkey 
      );
      $url_product = "v1/Users/detailRoomSendEmail";
      $post_email = $this->base->post_curl($url_product,$post_data_product);
      $res_email = json_encode($post_email['values'][0]);
      $res_email_dec = json_decode($res_email,true);
      //

      //paymentconfirm
      if($paymentStatus == 13){
        $send_email = $this->base->update_payment_confirmation($data['Host'],$data['User'],$data['Pass'],$data['Port'],$res_email_dec['productName'],$res_email_dec['email'],$res_email_dec['images'],$res_email_dec['nominal'],$res_email_dec['delivery_price'],$res_email_dec['payment_trxid'],$res_email_dec['tracking_code'],$res_email_dec['paymentDate'],$res_email_dec['country']);
      }
      //

      //orderconfirm
      if($paymentStatus == 21){
        $send_email = $this->base->update_order_confirmation($data['Host'],$data['User'],$data['Pass'],$data['Port'],$res_email_dec['productName'],$res_email_dec['email'],$res_email_dec['images'],$res_email_dec['nominal'],$res_email_dec['delivery_price'],$res_email_dec['payment_trxid'],$res_email_dec['tracking_code'],$res_email_dec['paymentDate'],$res_email_dec['country']);
      }
      //

      //itemondelivery
      if($paymentStatus == 31){
        $send_email = $this->base->update_item_delivery($data['Host'],$data['User'],$data['Pass'],$data['Port'],$res_email_dec['productName'],$res_email_dec['email'],$res_email_dec['images'],$res_email_dec['nominal'],$res_email_dec['delivery_price'],$res_email_dec['payment_trxid'],$res_email_dec['tracking_code'],$res_email_dec['paymentDate'],$res_email_dec['country']);
      }
      //

      //itemarrived
      if($paymentStatus == 32){
        $send_email = $this->base->update_item_arrived($data['Host'],$data['User'],$data['Pass'],$data['Port'],$res_email_dec['productName'],$res_email_dec['email'],$res_email_dec['images'],$res_email_dec['nominal'],$res_email_dec['delivery_price'],$res_email_dec['payment_trxid'],$res_email_dec['tracking_code'],$res_email_dec['paymentDate'],$res_email_dec['country']);
      }
      //



      $post = $this->base->post_curl($url,$post_data);
      if($post['status'] == 200){
        $this->session->set_flashdata('success_msg','Success Update Data');
        redirect('Transaction');
      }else{
        $this->session->set_flashdata('error_msg','Failed Update Data');
        redirect('Transaction/edit/'.$id);
      }
    }

    public function update_transaction_waiting_payment()
    {
      // $this->load->view('Transaction/email/WaitingPayment');
      //sendemail
          $this->load->library('email');
          $config['useragent'] = 'CodeIgniter';
          $config['protocol'] = 'sendmail';
          $config['smtp_host'] = 'mail.hey-io.com';
          $config['smtp_user'] = 'rocket@hey-io.com';
          $config['smtp_pass'] = 'p455w0rd1!.';
          $config['smtp_port'] = 465; 
          $config['smtp_timeout'] = 5;
          $config['wordwrap'] = TRUE;
          $config['wrapchars'] = 76;
          $config['mailtype'] = 'html';
          $config['charset'] = 'utf-8';
          $config['validate'] = FALSE;
          $config['priority'] = 3;
          $config['crlf'] = "\r\n";
          $config['newline'] = "\r\n";
          $config['bcc_batch_mode'] = FALSE;
          $config['bcc_batch_size'] = 200;
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->email->set_header('Content-type', 'text/html');
            //end config
          $this->load->library('email');
            //$this->email->initialize($config);
            //konfigurasi pengiriman
          $this->email->from($config['smtp_user']);
          $email = 'rocket.jawhead@gmail.com';
          $this->email->to($email);
          $this->email->subject("Transaction Bidbong");

          $message = "<!DOCTYPE html>
                      <html>
                      <head>
                        <title>Waiting For Payment</title>
                        <style>
                        * {
                          box-sizing: border-box;
                        }
                        .columnOrder {
                          float: left;
                          width: 25%;
                          padding: 10px;
                          height: 100px; 
                        }
                        .columnCheckout {
                          float: left;
                          width: 33.3%;
                          padding: 10px;
                          height: 100px; 
                        }
                        .column10 {
                          float: left;
                          width: 10%;
                          padding: 10px;
                          height: 150px; 
                        }
                        .column20 {
                          float: left;
                          width: 20%;
                          padding: 10px;
                          height: 150px; 
                        }
                        .column30 {
                          float: left;
                          width: 30%;
                          padding: 10px;
                          height: 150px; 
                        }
                        .column20Total {
                          float: left;
                          width: 20%;
                          padding: 10px;
                          height: 80px; 
                        }
                        .column30Total {
                          float: left;
                          width: 30%;
                          padding: 10px;
                          height: 80px; 
                        }
                        .column30garis {
                          float: left;
                          width: 30%;
                          padding: 10px;
                          height: 10px; 
                        }
                        .column40 {
                          float: left;
                          width: 40%;
                          padding: 10px;
                          height: 150px; 
                        }
                        .column40garis {
                          float: left;
                          width: 40%;
                          padding: 10px;
                          height: 10px; 
                        }
                        .row:after {
                          content: '';
                          display: table;
                          clear: both;
                        }
                        </style>
                      </head>
                      <body style='background-image: url('<?php echo base_url()?>assets/email/bg_email.jpg');background-repeat: no-repeat;
                          background-size: 100% 100%;'>
                      <center><img style='height: 100px;width: 100px;' src='<?php echo base_url()?>assets/bidbong_logo.png'></center>
                      <center>
                        <p>Hi User, Thank you for participate in our auction, We are still waiting your payment Let's checkout!</p>
                        <br/>
                        <img style='height: 160px;width: 50%;' src='<?php echo base_url()?>assets/payment/waiting_for_payment.jpg'>
                      </center>


                      <div class='row'>
                        <div class='columnOrder'>
                        </div>
                        <div class='columnOrder'>
                          <center>
                            <p style='color: #A09FAA;'>Order Date</p>
                            <p><b>12 Dec 2020</b></p> 
                          </center>
                        </div>
                        <div class='columnOrder'>
                          <center>
                            <p style='color: #A09FAA;'>Order Number</p>
                            <p><b>#1234567890</b></p> 
                          </center>
                        </div>
                        <div class='columnOrder'>
                        </div>
                      </div>
                      <br/><br/><br/>
                      <hr/>
                      <div class='row'>
                        <div class='column30'></div>
                        <div class='column10'>
                          <div>
                          <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='https://d2pa5gi5n2e1an.cloudfront.net/webp/global/images/product/laptops/ASUS_Laptop_E410MA/ASUS_Laptop_E410MA_L_1.jpg' alt=''>
                        </div>
                        </div>
                        <div class='column20'>
                          <p>asdads asdjasndjasdsa asdnjsadnsa asjdnjasndas </p>
                          <p style='color: #A09FAA;'>Qty: 1</p>
                        </div>
                        <div class='column10'>
                          <p style='text-align: right;'>$ 3000</p>
                        </div>
                        <div class='column30'></div>
                      </div>
                      <hr/>
                      <div class='row'>
                        <div class='column30Total'></div>
                        <div class='column20Total'>
                          <p>Sub Total</p>
                          <p>Shipping Cost</p>
                        </div>
                        <div class='column20Total'>
                          <p style='text-align: right;'>$ 3000</p>
                          <p style='text-align: right;'>$ 3000</p>  
                        </div>
                        <div class='column30Total'></div>
                      </div>
                      <div class='row'>
                        <div class='column30garis'></div>
                        <div class='column40garis'>
                          <hr/>
                        </div>
                        <div class='column30garis'></div>
                      </div>
                      <div class='row'>
                        <div class='column30Total'></div>
                        <div class='column20Total'>
                          <p>Total</p>
                        </div>
                        <div class='column20Total'>
                          <p style='text-align: right;'>$ 3000</p>  
                        </div>
                        <div class='column30Total'></div>
                      </div>

                      <div style='background: rgba(196, 196, 196, 0.25);margin: auto;padding: 10px;'>
                        <center><p>Contact Us Contact@BidBong.com | +44 33 01 33 25 19 <br/>© 2021 bidbong.com - All Rights Reserved</p></center>
                      </div>
                      </body>
                      </html>";
          $this->email->message($message);
      
          $result_email = $this->email->send();
    }

    public function update_transaction_payment_confirmation()
    {
      $this->load->view('Transaction/email/PaymentConfirmation');
    }

    public function update_order_confirmed()
    {
      $this->load->view('Transaction/email/OrderConfirmed');
    }

    public function update_item_shipment()
    {
      $this->load->view('Transaction/email/ItemShipment');
    }

    public function update_item_received()
    {
      $this->load->view('Transaction/email/ItemReceived');
    }


    public function forget_password()
    {
      $this->load->view('Transaction/email/ForgetPassword');
    }

    public function otp_password()
    {
      $this->load->view('Transaction/email/OtpPassword');
    }

    function update_transaction()
    {
          //sendemail
          $this->load->library('email');
          $config['useragent'] = 'CodeIgniter';
          $config['protocol'] = 'sendmail';
          $config['smtp_host'] = 'mail.hey-io.com';
          $config['smtp_user'] = 'rocket@hey-io.com';
          $config['smtp_pass'] = 'p455w0rd1!.';
          $config['smtp_port'] = 465; 
          $config['smtp_timeout'] = 5;
          $config['wordwrap'] = TRUE;
          $config['wrapchars'] = 76;
          $config['mailtype'] = 'html';
          $config['charset'] = 'utf-8';
          $config['validate'] = FALSE;
          $config['priority'] = 3;
          $config['crlf'] = "\r\n";
          $config['newline'] = "\r\n";
          $config['bcc_batch_mode'] = FALSE;
          $config['bcc_batch_size'] = 200;
          $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
          $this->email->set_header('Content-type', 'text/html');
            //end config
          $this->load->library('email');
            //$this->email->initialize($config);
            //konfigurasi pengiriman
          $this->email->from($config['smtp_user']);
          $email = 'rocket.jawhead@gmail.com';
          $this->email->to($email);
          $this->email->subject("Transaction Bidbong");

          $message = '
                    <html>
                    <head>
                    <title>Birthday Reminders for August</title>
                    </head>
                    <body>
                    <p>Here are the birthdays upcoming in August!</p>
                    <table>
                    <tr>
                    <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
                    </tr>
                    <tr>
                    <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
                    </tr>
                    <tr>
                    <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
                    </tr>
                    </table>
                    </body>
                    </html>
                    ';
          $this->email->message($message);
      
          $result_email = $this->email->send(); 
          echo "Success sent email";
    }



    
    
}    
  