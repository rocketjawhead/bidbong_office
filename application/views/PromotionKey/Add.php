
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
                  <h6 class="m-0 font-weight-bold text-primary">Insert Data</h6>
                </div>
                <form action="<?php echo site_url('Key/insertpromotionkey');?>" method="post" role="form">
                <div class="card-body">

                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title_promo">
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="desc_promo">
                  </div>

                  <div class="form-group">
                    <label>Free Key</label>
                    <select class="form-control" name="key_id" required>
                      <option value="">--- Choose ---</option>
                      <?php 
                      $json = json_encode($list_master_key);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->name;?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" class="form-control" name="amount">
                  </div>

                  <div class="form-group">
                    <label>Valid From</label>
                    <input type="date" class="form-control" name="valid_from">
                  </div>

                  <div class="form-group">
                    <label>Valid To</label>
                    <input type="date" class="form-control" name="valid_to" >
                  </div>

                  <!-- <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="<?php echo $status;?>"><?php if($status == 1){echo "Active";}else{echo "Deactive";}?></option>
                      <option value="0">Deactive</option>
                      <option value="1">Active</option>
                    </select>
                  </div> -->

                  <button type="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#loadingProcess">Update</button>
                </div>

                </form>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
