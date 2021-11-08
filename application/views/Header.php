<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Bidbong - Backoffice</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url()?>sbadmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url()?>sbadmin/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>sbadmin/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="<?php echo base_url()?>sbadmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('Panel');?>">
        <div class="sidebar-brand-icon">
          <i class="fas fa-cubes"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Bidbong</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('Panel');?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Key');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Key Settings</span></a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Master');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Master Admin</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Master/bidder');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Master Bidder</span></a>
      </li>


      <!-- <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Role');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Role</span></a>
      </li> -->

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Shipping');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Area Shipping</span></a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Room');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Room</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Products');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Products</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Category');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Category</span></a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Feedback');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Feedback</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Transaction');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Transaction</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('ConfigEmail');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Email Configuration</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Rate');?>">
          <i class="fas fa-fw fa-gavel"></i>
          <span>Rate App</span></a>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer" aria-expanded="true" aria-controls="customer">
          <i class="fas fa-fw fa-database"></i>
          <span>Customer</span>
        </a>
        <div id="customer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('Transaction/history');?>">Transaksi</a>
            <a class="collapse-item" href="<?php echo base_url('Transaction/history_product');?>">Stock Barang</a>
          </div>
        </div>
      </li> -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bid" aria-expanded="true" aria-controls="bid">
          <i class="fas fa-fw fa-database"></i>
          <span>Promotion Settings</span>
        </a>
        <div id="bid" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('Key/promotionkey');?>">Free Key</a>
          </div>
        </div>
      </li>


      <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#key" aria-expanded="true" aria-controls="key">
          <i class="fas fa-fw fa-database"></i>
          <span>Key Settings</span>
        </a>
        <div id="key" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?php echo base_url('Key');?>">List Key</a>
          </div>
        </div>
      </li> -->


      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Login/logout');?>" data-toggle="modal" data-target="#logoutModal">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form action="<?php echo site_url('Help');?>" method="post" role="form" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
              <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form action="<?php echo site_url('Help');?>" method="post" role="form" class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="keyword">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            

            <!-- Nav Item - Messages -->
            

            <!-- <div class="topbar-divider d-none d-sm-block"></div> -->

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo ucfirst($this->session->userdata('session_email'));?></span>
                <?php if($this->session->userdata('imageprofil') == NULL){?>
                  <img class="img-profile rounded-circle" src="<?php echo base_url()?>sbadmin/img/profil.png">
                <?php } else { ?>
                  <img class="img-profile rounded-circle" src="<?php echo $this->session->userdata('imageprofil');?>">
                <?php } ?>

              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <!-- <a class="dropdown-item" href="<?php echo base_url('Profil/change_picture');?>">
                  <i class="fas fa-image fa-sm fa-fw mr-2 text-gray-400"></i>
                  Change Picture
                </a> -->
                <a class="dropdown-item" href="<?php echo base_url('Profil/profil_setting');?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile Setting
                </a>
                <!-- <a class="dropdown-item" href="<?php echo base_url('Help');?>">
                  <i class="fas fa-question-circle fa-sm fa-fw mr-2 text-gray-400"></i>
                  Panduan
                </a> -->
                <!-- <a class="dropdown-item" href="<?php echo base_url('Profil/monitoring_log');?>">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a> -->
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('Login/logout');?>" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->
