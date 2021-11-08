
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">History</h1>
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


          <!-- search -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">
              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Search</h6>
                </div>
                <div class="card-body">
                  <form action="<?php echo site_url('Transaction/history');?>" method="post" role="form">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <input type="date" class="form-control" name="start_date" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <input type="date" class="form-control" name="end_date" required>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <select class="form-control" name="branch_id" required>
                          <option value="">--- Pilih Cabang ---</option>
                          <?php 
                          $json = json_encode($list_branch);
                          $json_decoded = json_decode($json); 
                          foreach($json_decoded as $list){ ?>
                            <option value="<?php echo $list->id;?>"><?php echo $list->branch_name;?></option>
                          <?php }?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label></label>
                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-rocket" data-toggle="modal" data-target="#loadingProcess"> Search</i></button>
                        <a href="<?php echo base_url('Transaction/history');?>" class="btn btn-danger btn-sm">
                          <i class="fas fa-trash"> Reset</i>
                        </a>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
          <!-- end search -->
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">History Transaction</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Invoice Number</th>
                          <th>Method</th>
                          <th>Cabang</th>
                          <th>Catatan</th>
                          <th>Total</th>
                          <th>Transaction Date</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        $json = json_encode($list_history_transaction);
                        $json_decoded = json_decode($json); 
                        foreach($json_decoded as $list){ ?>
                        <tr>
                          <td style="width: 2%;"><?php echo $no;?></td>
                          <td><a href="<?php echo base_url();?>Transaction/history_detail/<?php echo md5($list->id);?>"><?php echo $list->invoice_number;?></a></td>
                          <td><?php echo $list->payment_name;?></td>
                          <td><?php echo $list->branch_name;?></td>
                          <td><?php echo $list->note;?></td>
                          <td><?php echo "Rp ".number_format($list->total);?></td>
                          <td><?php echo $list->transaction_date;?></td>
                          <td style="width: 12%;">
                            <a href="<?php echo base_url();?>Transaction/history_detail/<?php echo md5($list->id);?>" class="btn btn-info btn-sm">
                              <i class="fas fa-rocket"> Detail</i>
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
