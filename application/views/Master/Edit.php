
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
                <form action="<?php echo site_url('Master/update/');?><?php echo $this->uri->segment(3);?>" method="post" role="form">
                <div class="card-body">
                  

                  <div class="form-group">
                    <label>Role</label>
                    <input type="text" class="form-control" value="<?php echo $role_name;?>" readonly>
                  </div>

                  <input type="hidden" class="form-control" name="role_id" value="<?php echo $role_id;?>" readonly>
                  

                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first" value="<?php echo $first;?>">
                  </div>

                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last" value="<?php echo $last;?>">
                  </div>

                  <div class="form-group">
                    <label>Birthdate</label>
                    <input type="date" class="form-control" name="birthdate" value="<?php echo $birthdate;?>">
                  </div>

                  <div class="form-group">
                    <label>Phonenumber</label>
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone;?>">
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                  </div>

                  <div class="form-group">
                    <label>City</label>
                    <input type="text" class="form-control" name="city" value="<?php echo $city;?>">
                  </div>

                  <div class="form-group">
                    <label>Zipcode</label>
                    <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode;?>">
                  </div>

                  <div class="form-group">
                    <label>State</label>
                    <input type="text" class="form-control" name="state" value="<?php echo $state;?>">
                  </div>

                  <div class="form-group">
                    <label>Country</label>
                    <input type="text" class="form-control" name="" value="<?php echo $countryshipping;?>" readonly>
                  </div>

                  

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                      <option value="<?php echo $status;?>"><?php if($status == 1){echo "Active";}else{echo "Deactive";}?></option>
                      <option value="0">Deactive</option>
                      <option value="1">Active</option>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#loadingProcess">Save</button>
                </div>

                </form>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
