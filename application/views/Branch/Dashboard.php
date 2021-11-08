
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Daftar Cabang</h1>
            <a href="<?php echo base_url('Branch/add')?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah Cabang</a>
          </div>

          <?php if($this->session->flashdata('success_msg')) { ?>

              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Alert!</h4>
                 <?php echo $this->session->flashdata('success_msg')?>
              </div>

          <?php } ?>


          <?php if($this->session->flashdata('error_msg')) { ?>
              
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                <?php echo $this->session->flashdata('error_msg')?>
              </div>

          <?php } ?>


        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Cabang Toko</h6>
                </div>
                <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Cabang</th>
                      <th>Alamat</th>
                      <th>Nomor Telephone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $json = json_encode($list_branch);
                    $json_decoded = json_decode($json); 
                    foreach($json_decoded as $list){ ?>
                    <tr>
                      <td style="width: 2%;"><?php echo $no;?></td>
                      <td style="width: 38%;"><?php echo $list->branch_name;?></td>
                      <td style="width: 10%;"><?php echo $list->address;?></td>
                      <td style="width: 10%;"><?php echo $list->phonenumber;?></td>
                      <td style="width: 10%;">
                        <a href="<?php echo base_url();?>Branch/edit/<?php echo md5($list->id);?>" class="btn btn-warning btn-circle btn-sm">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?php echo base_url();?>Branch/delete/<?php echo md5($list->id);?>" class="btn btn-danger btn-circle btn-sm">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <?php $no++;}  ?>
                  </tbody>
                </table>
              </div>
            </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
