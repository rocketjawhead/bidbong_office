
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
                  <h6 class="m-0 font-weight-bold text-primary">Update Data</h6>
                </div>
                <form action="<?php echo site_url('Shipping/update/');?><?php echo $this->uri->segment(3);?>" method="post" role="form">
                <div class="card-body">

                  <div class="form-group">
                    <label>Shipping Code</label>
                    <input type="text" class="form-control" name="shippingCode" value="<?php echo $shippingCode;?>">
                  </div>

                  <div class="form-group">
                    <label>Shipping Name</label>
                    <input type="text" class="form-control" name="shippingName" value="<?php echo $shippingName;?>">
                  </div>

                  <div class="form-group">
                    <label>Shipping Description</label>
                    <input type="text" class="form-control" name="shippingDescription" value="<?php echo $shippingDescription;?>">
                  </div>

                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" class="form-control" name="price" value="<?php echo $price;?>">
                  </div>

                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" name="country" value="<?php echo $country;?>">
                  </div>
                  
                  <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control" name="state" value="<?php echo $state;?>">
                  </div>


                  <div class="form-group">
                    <label>Estimate (Days)</label>
                    <input type="number" class="form-control" name="estimate" value="<?php echo $estimate;?>">
                  </div>

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
