
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Products Settings</h1>
            <a href="<?php echo base_url('Products/add')?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Add Data</a>
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
                  <h6 class="m-0 font-weight-bold text-primary">List Products</h6>
                </div>
                <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Images</th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $no=1;
                    $json = json_encode($list_products);
                    $json_decoded = json_decode($json); 
                    foreach($json_decoded as $list){ ?>
                    <tr>
                      <td style="width: 2%;"><?php echo $no;?></td>
                      <td><img style="height: 60px;width: 60px;" src="<?php echo $list->images;?>"><img style="height: 60px;width: 60px;" src="<?php echo $list->images1;?>"><img style="height: 60px;width: 60px;" src="<?php echo $list->images2;?>"><img style="height: 60px;width: 60px;" src="<?php echo $list->images3;?>"></td>
                      <td><?php echo $list->name;?></td>
                      <td><?php echo $list->categoryName;?></td>
                      <td><?php echo $list->description;?></td>
                      <td><?php echo $list->price;?></td>
                      <td><?php if($list->status == 1){echo "Active";}else{echo "Deactive";}?></td>
                      <td>
                        <a href="<?php echo base_url();?>Products/edit/<?php echo md5($list->id);?>" class="btn btn-warning btn-sm">
                          <i class="fas fa-edit"> Update</i>
                        </a>
                      </td>
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
