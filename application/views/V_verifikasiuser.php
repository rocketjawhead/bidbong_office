<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HEY-POS</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url()?>assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url()?>assets/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?php echo base_url()?>assets/vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>assets/build/css/custom.min.css" rel="stylesheet">
  </head>



  <body class="login">
           
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <div class="card-body">
        <form method="post" action="<?php echo base_url();?>login/validate" method="post" id="login">
  <div class='preload login--container'>
    
    <div class='login--form'>

              <div class="alert alert-success" class="close">
                <?php
            echo "Selamat kamu telah memverifikasi akun kamu";
            echo "<br><br>";
            ?>
              </div>

           


            
            <a class="btn btn-info" href="<?php echo base_url('login')?>">Kembali ke Menu Login</a>

            
      
      
    </div>
   
  </div>
</form>
      </div>


          </section>
<div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Account Baru ?
                  <a href="<?php echo base_url('Register')?>" class="to_register"> Buat Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <img src="<?php echo base_url('assets/HEY-POS.png');?>">
                  <p>©2018 All Rights Reserved. HEY-POS adalah System Point Of Sales Terbaik !</p>
                </div>
              </div>
        </div>



       
      </div>
    </div>
  </body>
</html>
