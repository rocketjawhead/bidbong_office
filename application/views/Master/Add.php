
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
                  <h6 class="m-0 font-weight-bold text-primary">Add Admin</h6>
                </div>
                <form action="<?php echo site_url('Master/insert');?>" method="post" role="form">
                <div class="card-body">

                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" name="first" required>
                  </div>

                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" name="last" required>
                  </div>

                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="email" required>
                  </div>

                  <div class="form-group">
                    <label>Phonenumber</label>
                    <input type="text" class="form-control" name="phone" required>
                  </div>
                  
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required>
                  </div>

                  <div class="form-group">
                    <label>Confirmation Password</label>
                    <input type="password" class="form-control" name="conf_password" required>
                  </div>

                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" name="role" required>
                      <option value="">--- Choose Role ---</option>
                      <?php 
                      $json = json_encode($list_role);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ 
                        if($list->id == 1 || $list->id == 2 || $list->id == 3){?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->name;?></option>
                      <?php }} ?>
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
