
        <!-- Begin Page Content -->
        <div class="container-fluid">
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
                  <h6 class="m-0 font-weight-bold text-primary">Tambah User (Cashier)</h6>
                </div>
                <form action="<?php echo site_url('User/insert');?>" method="post" role="form">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label>Email Login (Example : andi@companyname.com)</label>
                    <input type="text" class="form-control" name="username" required>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                  </div>

                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" name="fullname" required>
                  </div>

                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" name="birthdate" required>
                  </div>


                  <div class="form-group">
                    <select class="form-control" name="branch_id" required>
                      <option value="">--- Pilih Cabang ---</option>
                      <?php 
                      $json = json_encode($list_branch);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                        <option value="<?php echo $list->id;?>"><?php echo $list->branch_name;?></option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Nomor Telephone</label>
                    <input type="number" class="form-control" name="phonenumber" required>
                  </div>

                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" name="address" required>
                  </div>

                  <button type="submit" class="btn btn-success btn-lg btn-block">Simpan</button>
                </div>

                </form>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
