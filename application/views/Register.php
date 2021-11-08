<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>HEYPOS - POINT OF SALES</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block">
                <img src="<?php echo base_url()?>assets/assets/img/hero-img.png" class="img-fluid animated" alt="">
              </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Register</h1>
                <?php
                  if($this->session->flashdata('success_msg'))
                  {
                ?>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                     <?php echo $this->session->flashdata('success_msg')?>
                  </div>
                <?php
                  }
                ?>
                <?php
                  if($this->session->flashdata('error_msg'))
                  {
                ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <?php echo $this->session->flashdata('error_msg')?>
                  </div>

                <?php
                  }
                ?>
              </div>
              <form action="<?php echo site_url('Register/submit');?>" method="post" role="form" class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="first_name" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="last_name" required>
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="Company Name" name="company_name" required>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email" required>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="password_conf" required>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block" data-toggle="modal" data-target="#loadingLogin">
                  Register Account
                </button>
                <!-- <hr> -->
                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> -->
              </form>
              <hr>
              <div class="text-center">
                <!-- <a class="small" href="forgot-password.html">Lupa Kata Sandi ?</a> -->
              </div>
              <div class="text-center">
                <a class="small" href="<?php echo base_url('Login')?>">Sudah Memiliki Akun ? Silahkan Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url()?>sbadmin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url()?>sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url()?>sbadmin/js/sb-admin-2.min.js"></script>
    <div class="modal fade" id="loadingLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="height: 100%;">
        <div style="margin-top: 30%;margin-bottom: 30%;">
          <center>
          <div class="spinner-border" style="width: 10rem; height: 10rem;justify-content: center;" role="status">
            <span class="sr-only">Loading...</span>
          </div>
          <h1>Loading...</h1>
          </center>
        </div>
        
      </div>
    </div>
  </div>

</body>

</html>
