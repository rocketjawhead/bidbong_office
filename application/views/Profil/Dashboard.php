
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Profile Setting</h6>
                </div>
                <form action="<?php echo site_url('Profil/update');?>" method="post" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label>First</label>
                    <input type="text" class="form-control" name="first" value="<?php echo $first;?>">
                  </div>
                  
                  <div class="form-group">
                    <label>Last</label>
                    <input type="text" class="form-control" name="last" value="<?php echo $last;?>">
                  </div>

                  <div class="form-group">
                    <label>Birthdate <?php echo $birthdate;?></label>
                    <input type="date" class="form-control" name="birthdate" value="<?php echo $birthdate;?>">
                  </div>

                  <div class="form-group">
                    <label>Phonenumber</label>
                    <input type="number" class="form-control" name="phone" value="<?php echo $phone;?>">
                  </div>

                  <div class="form-group">
                    <label>address</label>
                    <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
                  </div>

                  <div class="form-group">
                    <label>city</label>
                    <input type="text" class="form-control" name="city" value="<?php echo $city;?>">
                  </div>

                  <div class="form-group">
                    <label>zipcode</label>
                    <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode;?>">
                  </div>

                  <div class="form-group">
                    <label>state</label>
                    <input type="text" class="form-control" name="state" value="<?php echo $state;?>">
                  </div>

                  <div class="form-group">
                    <label>country</label>
                    <input type="text" class="form-control" name="country" value="<?php echo $country;?>">
                  </div>



                  <button type="submit" class="btn btn-success btn-lg btn-block" data-toggle="modal" data-target="#loadingProcess">Simpan</button>
                </div>

                </form>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
