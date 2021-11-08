
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail History Transaction </h1>
            <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" onclick="printDiv('printableArea')"><i class="fas fa-print fa-sm text-white-100"></i> Print</button>
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
          <div class="row" id="printableArea">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-body">
                  <div class="table-responsive">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h6 mb-0 text-gray-800">
                      <?php echo $CompanyName;?><br/>
                      Cabang : <?php echo $BranchName;?>
                      </h1>
                    <h1 class="h6 mb-0 text-gray-800">
                      Invoice : <?php echo $InvoiceNumber;?><br/>
                      Transaction Date : <?php echo $TransactionDate;?></h1>
                  </div>
                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Item</th>
                          <th>Qty</th>
                          <th>Total</th>
                          <!-- <th>Transaction Date</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        $json = json_encode($list_detail_history_transaction);
                        $json_decoded = json_decode($json); 
                        foreach($json_decoded as $list){ ?>
                        <tr>
                          <td style="width: 2%;"><?php echo $no;?></td>
                          <td><?php echo $list->item;?></td>
                          <td><?php echo $list->qty;?></td>
                          <td><?php echo "Rp ".number_format($list->total);?></td>
                          <!-- <td><?php echo $list->transaction_date;?></td> -->
                        </tr>
                        <?php $no++;}  ?>
                        <tr>
                          <td colspan="3">Catatan</td>
                          <td><?php echo $Note;?></td>
                        </tr>
                        <tr>
                          <td colspan="3">Payment Method</td>
                          <td><?php echo $PaymentName;?></td>
                        </tr>
                        <tr>
                          <td colspan="3">Total</td>
                          <td><?php echo "Rp ".number_format($TotalTransaction);?></td>
                        </tr>
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
      <script>
          function printDiv(divName) {
           var printContents = document.getElementById("printableArea").innerHTML;
           var originalContents = document.body.innerHTML;

           document.body.innerHTML = printContents;

           window.print();

           document.body.innerHTML = originalContents;
      }
      </script>
