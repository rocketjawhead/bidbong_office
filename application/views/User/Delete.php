
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Menghapus data cashier</h6>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>Email Login</label>
                    <input type="text" class="form-control" value="<?php echo $username;?>" readonly>
                  </div>
                  
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" class="form-control" value="<?php echo $fullname;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" class="form-control" value="<?php echo $birthdate;?>" readonly>
                  </div>


                  <div class="form-group">
                    <label>Cabang</label>
                    <input type="date" class="form-control"  value="<?php echo $branch_name;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Nomor Telephone</label>
                    <input type="number" class="form-control" value="<?php echo $phonenumber;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" class="form-control" value="<?php echo $address;?>" readonly>
                  </div>

                  <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#deleteModal">Delete</button>

                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Logout Modal-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alert Data</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Apakah anda yakin ingin menghapus data ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
              <a class="btn btn-danger" href="<?php echo base_url('User/dodelete/');?><?php echo $this->uri->segment(3);?>">Hapus</a>
            </div>
          </div>
        </div>
      </div>
