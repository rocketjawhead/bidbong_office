<?php
class M_base extends CI_Model {

      public function __construct()
      {
              parent::__construct();
              $this->service_url = $this->config->item("service_url");
      }
     

      //CURL PHP
    //   function post_curl($url,$data)
    //   {

    //         $content = json_encode($data);

    //         date_default_timezone_set('Asia/Jakarta');

    //         $start_curl_post = date('Y-m-d h:i:s');

    //         $curl = curl_init($this->service_url.$url);
    //         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
    //         curl_setopt($curl, CURLOPT_HEADER, false);
    //         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //         curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json",'Content-Length: ' . strlen($content)));
    //         curl_setopt($curl, CURLOPT_POST, true);
    //         curl_setopt($curl, CURLOPT_TIMEOUT, 15);//10 detik timedelay simulator
    //         curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    //         curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //         curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    //         $response = curl_exec($curl);
    //         $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);    

    //         curl_close($curl);
    //         return $response = json_decode($response,true);
    // }


    //CURL NODEJS

      function post_curl($url,$data)
      {

            $content = json_encode($data);
            
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => $this->service_url.$url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>$content,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));    
            $response = curl_exec($curl);

            curl_close($curl);
            return $response = json_decode($response,true);
      }

      public function update_transaction_waiting_payment($host,$user,$pass,$port,$product_name,$email_post,$image_product,$nominal,$cost_delivery,$number_order,$tracking_code,$paymentDate,$country)
      {
        // $this->load->view('Transaction/email/WaitingPayment');
        //sendemail
        $product_price = $nominal;
        $delivery_price = $cost_delivery;
        $total_price = $product_price + $delivery_price;
            $this->load->library('email');
            $config['useragent'] = 'CodeIgniter';
            $config['protocol'] = 'sendmail';
            // $config['smtp_host'] = 'mail.hey-io.com';
            // $config['smtp_user'] = 'rocket@hey-io.com';
            // $config['smtp_pass'] = 'p455w0rd1!.';
            // $config['smtp_port'] = 465;
            $config['smtp_host'] = $host;
            $config['smtp_user'] = $user;
            $config['smtp_pass'] = $pass;
            $config['smtp_port'] = $port; 
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
            // $email = $email_post;
            $this->email->to($email);
            $this->email->subject("Transaction Bidbong");

            $message = "<!DOCTYPE html><html><head><title>Waiting For Payment</title><style>* {box-sizing: border-box;}
                          .columnOrder {float: left;width: 25%;padding: 10px;height: 100px;}
                          .columnCheckout {float: left;
                            width: 33.3%;padding: 10px;height: 100px; 
                          }.column10 {
                            float: left;width: 10%;padding: 10px;height: 150px; 
                          }.column20 {
                            float: left;width: 20%;padding: 10px;height: 150px; 
                          }.column30 {float: left;width: 30%;padding: 10px;height: 150px; 
                          }.column20Total {float: left;width: 20%;padding: 10px;height: 80px; 
                          }.column30Total {float: left;width: 30%;padding: 10px;height: 80px; 
                          }.column30garis {float: left;width: 30%;padding: 10px;height: 10px; 
                          }.column40 {float: left;width: 40%;padding: 10px;height: 150px; 
                          }.column40garis {float: left;width: 40%;padding: 10px;height: 10px; 
                          }.row:after {content: '';display: table;clear: both;
                          }
                          </style>
                        </head>
                        <body style='background-image: url('http://bidbong.hey-io.com/assets/email/bg_email.jpg');background-repeat: no-repeat;
                            background-size: 100% 100%;'>
                        <center><img style='height: 100px;width: 100px;' src='http://bidbong.hey-io.com/assets/bidbong_logo.png'></center>
                        <center>
                          <p>Hi User, Thank you for participate in our auction, We are still waiting your payment Let's checkout!</p>
                          <br/>
                          <img style='height: 150px;width: 60%;' src='http://bidbong.hey-io.com/assets/payment/waiting_for_payment.JPG'>
                        </center>


                        <div class='row'>
                          <div class='columnOrder'>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Date</p>
                              <p><b>'".$paymentDate."'</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Number</p>
                              <p><b>#'".$number_order."'</b></p> 
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
                            <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='".$image_product."' alt=''>
                          </div>
                          </div>
                          <div class='column20'>
                            <p>'".$product_name."'</p>
                            <p style='color: #A09FAA;'>Qty: 1</p>
                          </div>
                          <div class='column10'>
                            <p style='text-align: right;'>$ '".$product_price."'</p>
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
                            <p style='text-align: right;'>$ '".$product_price."'</p>
                            <p style='text-align: right;'>$ '".$delivery_price."'</p>  
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
                            <p style='text-align: right;'>$ '".$total_price."'</p>  
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

      public function update_payment_confirmation($host,$user,$pass,$port,$product_name,$email_post,$image_product,$nominal,$cost_delivery,$number_order,$tracking_code,$paymentDate,$country)
      {
        // $this->load->view('Transaction/email/WaitingPayment');
        //sendemail

        $product_price = $nominal;
        $delivery_price = $cost_delivery;
        $total_price = $product_price + $delivery_price;
            $this->load->library('email');
            $config['useragent'] = 'CodeIgniter';
            $config['protocol'] = 'sendmail';
            // $config['smtp_host'] = 'mail.hey-io.com';
            // $config['smtp_user'] = 'rocket@hey-io.com';
            // $config['smtp_pass'] = 'p455w0rd1!.';
            // $config['smtp_port'] = 465;
            $config['smtp_host'] = $host;
            $config['smtp_user'] = $user;
            $config['smtp_pass'] = $pass;
            $config['smtp_port'] = $port; 
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
            // $email = $email_post;
            $this->email->to($email);
            $this->email->subject("Transaction Bidbong - Payment Confirmation");

            $message = "<!DOCTYPE html>
                        <html>
                        <head>
                          <title>Payment Confirmation</title>
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
                        <body style='background-image: url('http://bidbong.hey-io.com/assets/email/bg_email.jpg');background-repeat: no-repeat;
                            background-size: 100% 100%;'>
                        <center><img style='height: 100px;width: 100px;' src='http://bidbong.hey-io.com/assets/bidbong_logo.png'></center>
                        <center>
                          <p>Hi User, Thank you for your payment. Hold on, and let us checking</p>
                          <br/>
                          <img style='height: 150px;width: 60%;' src='http://bidbong.hey-io.com/assets/payment/payment_confirmation.JPG'>
                        </center>

                        <center>
                        <div class='row' style='width: 600px;'>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Date</p>
                              <p><b>".$paymentDate."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Number</p>
                              <p><b>#".$number_order."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Payment Method</p>
                              <p><b>Visa/MC/Amex</b></p>  
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Destination</p>
                              <p><b>".$country."</b></p>  
                            </center>
                          </div>
                        </div>
                        </center>

                        <br/><br/><br/>
                        <div class='row'>
                          <div class='column30'></div>
                          <div class='column10'>
                            <div>
                            <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='".$image_product."' alt=''>
                          </div>
                          </div>
                          <div class='column20'>
                            <p>".$product_name."</p>
                            <p style='color: #A09FAA;'>Qty: 1</p>
                          </div>
                          <div class='column10'>
                            <p style='text-align: right;'>$ ".$product_price."</p>
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
                            <p style='text-align: right;'>$ ".$product_price."</p>
                            <p style='text-align: right;'>$ ".$delivery_price."</p>  
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
                            <p style='text-align: right;'>$ ".$total_price."</p>  
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

      public function update_order_confirmation($host,$user,$pass,$port,$product_name,$email_post,$image_product,$nominal,$cost_delivery,$number_order,$tracking_code,$paymentDate,$country)
      {
        // $this->load->view('Transaction/email/WaitingPayment');
        //sendemail

        $product_price = $nominal;
        $delivery_price = $cost_delivery;
        $total_price = $product_price + $delivery_price;
            $this->load->library('email');
            $config['useragent'] = 'CodeIgniter';
            $config['protocol'] = 'sendmail';
            // $config['smtp_host'] = 'mail.hey-io.com';
            // $config['smtp_user'] = 'rocket@hey-io.com';
            // $config['smtp_pass'] = 'p455w0rd1!.';
            // $config['smtp_port'] = 465;
            $config['smtp_host'] = $host;
            $config['smtp_user'] = $user;
            $config['smtp_pass'] = $pass;
            $config['smtp_port'] = $port; 
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
            // $email = $email_post;
            $this->email->to($email);
            $this->email->subject("Transaction Bidbong - Order Confirmation");

            $message = "<!DOCTYPE html>
                        <html>
                        <head>
                          <title>Order Confirmation</title>
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
                        <body style='background-image: url('http://bidbong.hey-io.com/assets/email/bg_email.jpg');background-repeat: no-repeat;
                            background-size: 100% 100%;'>
                        <center><img style='height: 100px;width: 100px;' src='http://bidbong.hey-io.com/assets/bidbong_logo.png'></center>
                        <center>
                          <p>Hi User, Yeay you order has been confirmed. Will contact you again while the order is being shipped!</p>
                          <br/>
                          <img style='height: 150px;width: 60%;' src='http://bidbong.hey-io.com/assets/payment/order_confirmed.JPG'>
                        </center>

                        <center>
                        <div class='row' style='width: 600px;'>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Date</p>
                              <p><b>".$paymentDate."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Number</p>
                              <p><b>#".$number_order."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Payment Method</p>
                              <p><b>Visa/MC/Amex</b></p>  
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Destination</p>
                              <p><b>".$country."</b></p>  
                            </center>
                          </div>
                        </div>
                        </center>

                        <br/><br/><br/>
                        <div class='row'>
                          <div class='column30'></div>
                          <div class='column10'>
                            <div>
                            <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='".$image_product."' alt=''>
                          </div>
                          </div>
                          <div class='column20'>
                            <p>".$product_name."</p>
                            <p style='color: #A09FAA;'>Qty: 1</p>
                          </div>
                          <div class='column10'>
                            <p style='text-align: right;'>$ ".$product_price."</p>
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
                            <p style='text-align: right;'>$ ".$product_price."</p>
                            <p style='text-align: right;'>$ ".$delivery_price."</p>  
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
                            <p style='text-align: right;'>$ ".$total_price."</p>  
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

      public function update_item_delivery($host,$user,$pass,$port,$product_name,$email_post,$image_product,$nominal,$cost_delivery,$number_order,$tracking_code,$paymentDate,$country)
      {
        // $this->load->view('Transaction/email/WaitingPayment');
        //sendemail

        $product_price = $nominal;
        $delivery_price = $cost_delivery;
        $total_price = $product_price + $delivery_price;
            $this->load->library('email');
            $config['useragent'] = 'CodeIgniter';
            $config['protocol'] = 'sendmail';
            // $config['smtp_host'] = 'mail.hey-io.com';
            // $config['smtp_user'] = 'rocket@hey-io.com';
            // $config['smtp_pass'] = 'p455w0rd1!.';
            // $config['smtp_port'] = 465;
            $config['smtp_host'] = $host;
            $config['smtp_user'] = $user;
            $config['smtp_pass'] = $pass;
            $config['smtp_port'] = $port; 
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
            // $email = $email_post;
            $this->email->to($email);
            $this->email->subject("Transaction Bidbong - Item on Delivery");

            $message = "<!DOCTYPE html>
                        <html>
                        <head>
                          <title>Item on Delivery</title>
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
                        <body style='background-image: url('http://bidbong.hey-io.com/assets/email/bg_email.jpg');background-repeat: no-repeat;
                            background-size: 100% 100%;'>
                        <center><img style='height: 100px;width: 100px;' src='http://bidbong.hey-io.com/assets/bidbong_logo.png'></center>
                        <center>
                          <p>Hi User, GOOD NEWS!! Your order is on the way. Please check this tracking number #".$number_order."</p>
                          <br/>
                          <img style='height: 150px;width: 60%;' src='http://bidbong.hey-io.com/assets/payment/item_shipment.JPG'>
                        </center>

                        <center>
                        <div class='row' style='width: 600px;'>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Date</p>
                              <p><b>".$paymentDate."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Number</p>
                              <p><b>#".$number_order."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Payment Method</p>
                              <p><b>Visa/MC/Amex</b></p>  
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Destination</p>
                              <p><b>".$country."</b></p>  
                            </center>
                          </div>
                        </div>
                        </center>

                        <br/><br/><br/>
                        <div class='row'>
                          <div class='column30'></div>
                          <div class='column10'>
                            <div>
                            <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='".$image_product."' alt=''>
                          </div>
                          </div>
                          <div class='column20'>
                            <p>".$product_name."</p>
                            <p style='color: #A09FAA;'>Qty: 1</p>
                          </div>
                          <div class='column10'>
                            <p style='text-align: right;'>$ ".$product_price."</p>
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
                            <p style='text-align: right;'>$ ".$product_price."</p>
                            <p style='text-align: right;'>$ ".$delivery_price."</p>  
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
                            <p style='text-align: right;'>$ ".$total_price."</p>  
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

      public function update_item_arrived($host,$user,$pass,$port,$product_name,$email_post,$image_product,$nominal,$cost_delivery,$number_order,$tracking_code,$paymentDate,$country)
      {
        // $this->load->view('Transaction/email/WaitingPayment');
        //sendemail

        $product_price = $nominal;
        $delivery_price = $cost_delivery;
        $total_price = $product_price + $delivery_price;
            $this->load->library('email');
            $config['useragent'] = 'CodeIgniter';
            $config['protocol'] = 'sendmail';
            // $config['smtp_host'] = 'mail.hey-io.com';
            // $config['smtp_user'] = 'rocket@hey-io.com';
            // $config['smtp_pass'] = 'p455w0rd1!.';
            // $config['smtp_port'] = 465;
            $config['smtp_host'] = $host;
            $config['smtp_user'] = $user;
            $config['smtp_pass'] = $pass;
            $config['smtp_port'] = $port; 
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
            // $email = $email_post;
            $this->email->to($email);
            $this->email->subject("Transaction Bidbong - Item Arrived");

            $message = "<!DOCTYPE html>
                        <html>
                        <head>
                          <title>Item Arrived</title>
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
                        <body style='background-image: url('http://bidbong.hey-io.com/assets/email/bg_email.jpg');background-repeat: no-repeat;
                            background-size: 100% 100%;'>
                        <center><img style='height: 100px;width: 100px;' src='http://bidbong.hey-io.com/assets/bidbong_logo.png'></center>
                        <center>
                          <p>Hi User, Thank you for shopping at Bidbong. Based on the information we have, your order<br/> has been successfully received. We hope you are satisfied with our services.</p>
                          <br/>
                          <img style='height: 150px;width: 60%;' src='http://bidbong.hey-io.com/assets/payment/item_received.JPG'>
                        </center>

                        <center>
                        <div class='row' style='width: 600px;'>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Date</p>
                              <p><b>".$paymentDate."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Order Number</p>
                              <p><b>#".$number_order."</b></p> 
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Payment Method</p>
                              <p><b>Visa/MC/Amex</b></p>  
                            </center>
                          </div>
                          <div class='columnOrder'>
                            <center>
                              <p style='color: #A09FAA;'>Destination</p>
                              <p><b>".$country."</b></p>  
                            </center>
                          </div>
                        </div>
                        </center>

                        <br/><br/><br/>
                        <div class='row'>
                          <div class='column30'></div>
                          <div class='column10'>
                            <div>
                            <img style='vertical-align:middle;width: 100%;height: 100%; border-radius: 10px;' src='".$image_product."' alt=''>
                          </div>
                          </div>
                          <div class='column20'>
                            <p>".$product_name."</p>
                            <p style='color: #A09FAA;'>Qty: 1</p>
                          </div>
                          <div class='column10'>
                            <p style='text-align: right;'>$ ".$product_price."</p>
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
                            <p style='text-align: right;'>$ ".$product_price."</p>
                            <p style='text-align: right;'>$ ".$delivery_price."</p>  
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
                            <p style='text-align: right;'>$ ".$total_price."</p>  
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
    
}
?>