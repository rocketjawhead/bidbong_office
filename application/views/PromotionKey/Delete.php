
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Delete Key</h6>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label>QTY</label>
                    <input type="text" class="form-control" value="<?php echo $qty;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Valid From</label>
                    <input type="text" class="form-control" value="<?php echo $valid_from;?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Valid To</label>
                    <input type="text" class="form-control" value="<?php echo $valid_to;?>" readonly>
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
            <div class="modal-body">Delete Data ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-danger" href="<?php echo base_url('Key/dodelete/');?><?php echo $this->uri->segment(3);?>">Delete</a>
            </div>
          </div>
        </div>
      </div>
