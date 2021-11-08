
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
                  <h6 class="m-0 font-weight-bold text-primary">Add Data</h6>
                </div>
                <form action="<?php echo site_url('Products/insert');?>" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="name" required>
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description">
                  </div>

                  <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="categoryId" required>
                      <option value="">--- Choose Category ---</option>
                      <?php 
                      $json = json_encode($list_category);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->name;?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" step="0.01" class="form-control" name="price">
                  </div>


                  <div class="form-group">
                    <div class="row">
                      <div class="col-lg-3">
                        <div class="form-group">
                          <center><label>Image 1</label>
                          <br>
                          <img id="image1" style="height: 50px;width: 50px;" src="<?php echo base_url()?>sbadmin/img/profil.png"/>
                          </center>
                          <br>
                          <input type="file" class="form-control" name="image_1" onchange="readURLimage1(this);" >
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <center><label>image 2</label>
                          <br>
                          <img id="image2" style="height: 50px;width: 50px;" src="<?php echo base_url()?>sbadmin/img/profil.png"/>
                          </center>
                          <br>
                          <input type="file" class="form-control" name="image_2" onchange="readURLimage2(this);" >
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <center><label>image 3</label>
                          <br>
                          <img id="image3" style="height: 50px;width: 50px;" src="<?php echo base_url()?>sbadmin/img/profil.png"/>
                          </center>
                          <br>
                          <input type="file" class="form-control" name="image_3" onchange="readURLimage3(this);" >
                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="form-group">
                          <center><label>image 4</label>
                          <br>
                          <img id="image4" style="height: 50px;width: 50px;" src="<?php echo base_url()?>sbadmin/img/profil.png"/>
                          </center>
                          <br>
                          <input type="file" class="form-control" name="image_4" onchange="readURLimage4(this);" >
                        </div>
                      </div>
                    </div>
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
      <script type="text/javascript">
        function readURLimage1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image1')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
      </script>

      <script type="text/javascript">
        function readURLimage2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image2')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
      </script>

      <script type="text/javascript">
        function readURLimage3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image3')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
      </script>

      <script type="text/javascript">
        function readURLimage4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image4')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(100);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
      </script>
