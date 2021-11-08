
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Rate App</h1>
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
                  <h6 class="m-0 font-weight-bold text-primary">List Rate</h6>
                </div>
                <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Email</th>
                      <th>User</th>
                      <th>Rate</th>
                      <th>Description</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $json = json_encode($list_rate);
                    $json_decoded = json_decode($json); 
                    foreach($json_decoded as $list){ ?>
                    <tr>
                      <td style="width: 2%;"><?php echo $no;?></td>
                      <td><?php echo $list->email;?></td>
                      <td><?php echo $list->first;?></td>
                      <td><?php if($list->rateid == 1){
                        echo "Product Item";
                      }elseif($list->rateid == 2){
                        echo "App Experience";
                      }elseif($list->rateid == 3){
                        echo "Price";
                      }else{
                        echo "Other";
                      }?></td>
                      <td><?php echo $list->desc_rate;?></td>
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
