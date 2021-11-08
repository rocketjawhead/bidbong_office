
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
                <form action="<?php echo site_url('Transaction/update/');?><?php echo $this->uri->segment(3);?>" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  
                  <input type="hidden" name="storeId" value="<?php echo md5($storeId);?>">

                  <div class="form-group">
                    <label>Buyer</label>
                    <input type="text" class="form-control" value="<?php echo $first.' '.$last;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" value="<?php echo $product_name;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Nominal</label>
                    <input type="text" class="form-control" value="<?php echo number_format($nominal);?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Payment Date</label>
                    <input type="text" class="form-control" value="<?php echo $payment_date;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select id="paymentStatus" class="form-control select2" name="paymentStatus">
                      <option value="<?php echo $status_code;?>">Selected : <?php echo $status_name;?></option>
                      <?php 
                      $json = json_encode($list_status_transaction);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ if($list->statusCode == '13' || $list->statusCode == '21' || $list->statusCode == '31' || $list->statusCode == '32') {?>
                      <option value="<?php echo $list->statusCode;?>"><?php echo $list->statusCode.'-'.$list->statusName;?></option>
                      <?php } }?>
                    </select>
                  </div>

                  <div class="form-group input_resi" style="display:none">
                    <label>Track Number</label>
                    <input type="text" name="resi" class="form-control">
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
      <script type="text/javascript" src="//code.jquery.com/jquery-1.8.3.js">  </script>
      <script type="text/javascript">
      $(function(){
          $('#paymentStatus').change(function(){
             var opt = $(this).val();
              if(opt == '31'){
                  $('.input_resi').show();
              }else{
                  $('.input_resi').hide();
              }
          });
      });
      </script>
