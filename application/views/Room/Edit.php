<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
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
                <form action="<?php echo site_url('Room/update/');?><?php echo $this->uri->segment(3);?>" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  

                  <div class="form-group">
                    <label>Key</label>
                    <select class="form-control" name="allowKey">
                      <option value="<?php echo $allowKey;?>">Selected : <?php echo $keyName;?></option>
                      <?php 
                      $json = json_encode($list_key);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->name;?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Product</label>
                    <select class="form-control" name="productId">
                      <option value="<?php echo $productId;?>">Selected : <?php echo $productName;?></option>
                      <?php 
                      $json = json_encode($list_products);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  

                  <div class="form-group">
                    <label>Maxx Bidder</label>
                    <input type="number" class="form-control" name="maxBidder" value="<?php echo $maxBidder;?>">
                  </div>

                  <div class="form-group">
                    <label>Start Bid</label>
                    <input type="date" class="form-control" name="startBid" value="<?php echo $startBid;?>">
                  </div>

                  <div class="form-group">
                    <label>End Bid</label>
                    <input type="date" class="form-control" name="endBid" value="<?php echo $endBid;?>">
                  </div>

                  <div class="form-group">
                    <label>Winner Date</label>
                    <input type="date" class="form-control" name="setWinnerDate" value="<?php echo $setWinnerDate;?>">
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
