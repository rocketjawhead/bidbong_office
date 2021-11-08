<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #36b9cc;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
  color: #fff;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Transactions</h1>
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
                  <h6 class="m-0 font-weight-bold text-primary">List Transactions</h6>
                </div>
                <div class="card-body">
                <div class="tab">
                  <button class="tablinks" onclick="openCity(event, 'All')">All</button>
                  <button class="tablinks" onclick="openCity(event, 'Payment')">Payment</button>
                  <button class="tablinks" onclick="openCity(event, 'Order')">Order</button>
                  <button class="tablinks" onclick="openCity(event, 'Delivery')">Delivery</button>
                </div>
                <div id="All" class="tabcontent">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Buyer</th>
                        <th>Product</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Create Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      $json = json_encode($list_transactions);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <tr>
                        <td style="width: 2%;"><?php echo $no;?></td>
                        <td><?php echo $list->first.' '.$list->last;?></td>
                        <td><?php echo $list->product_name;?></td>
                        <td><?php echo number_format($list->nominal);?></td>
                        <td><?php echo $list->statusName;?></td>
                        <td><?php echo $list->payment_date;?></td>
                        <td><?php echo $list->createdAt;?></td>
                        <td>
                          <a href="<?php echo base_url();?>Transaction/edit/<?php echo $list->id;?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"> Update</i>
                          </a>
                        </td>
                      </tr>
                      <?php $no++;}  ?>
                    </tbody>
                  </table>
                </div>
                </div>

                <div id="Payment" class="tabcontent">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Buyer</th>
                        <th>Product</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Create Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      $json = json_encode($list_transactions_payment);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <tr>
                        <td style="width: 2%;"><?php echo $no;?></td>
                        <td><?php echo $list->first.' '.$list->last;?></td>
                        <td><?php echo $list->product_name;?></td>
                        <td><?php echo number_format($list->nominal);?></td>
                        <td><?php echo $list->statusName;?></td>
                        <td><?php echo $list->payment_date;?></td>
                        <td><?php echo $list->createdAt;?></td>
                        <td>
                          <a href="<?php echo base_url();?>Transaction/edit/<?php echo $list->id?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"> Update</i>
                          </a>
                        </td>
                      </tr>
                      <?php $no++;}  ?>
                    </tbody>
                  </table>
                </div>
                </div>

                <div id="Order" class="tabcontent">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Buyer</th>
                        <th>Product</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Create Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      $json = json_encode($list_transactions_order);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <tr>
                        <td style="width: 2%;"><?php echo $no;?></td>
                        <td><?php echo $list->first.' '.$list->last;?></td>
                        <td><?php echo $list->product_name;?></td>
                        <td><?php echo number_format($list->nominal);?></td>
                        <td><?php echo $list->statusName;?></td>
                        <td><?php echo $list->payment_date;?></td>
                        <td><?php echo $list->createdAt;?></td>
                        <td>
                          <a href="<?php echo base_url();?>Transaction/edit/<?php echo $list->id?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"> Update</i>
                          </a>
                        </td>
                      </tr>
                      <?php $no++;}  ?>
                    </tbody>
                  </table>
                </div>
                </div>

                <div id="Delivery" class="tabcontent">
                  <div class="table-responsive">
                  <table class="table table-bordered" id="" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Buyer</th>
                        <th>Product</th>
                        <th>Nominal</th>
                        <th>Status</th>
                        <th>Payment Date</th>
                        <th>Create Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $no=1;
                      $json = json_encode($list_transactions_delivery);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <tr>
                        <td style="width: 2%;"><?php echo $no;?></td>
                        <td><?php echo $list->first.' '.$list->last;?></td>
                        <td><?php echo $list->product_name;?></td>
                        <td><?php echo number_format($list->nominal);?></td>
                        <td><?php echo $list->statusName;?></td>
                        <td><?php echo $list->payment_date;?></td>
                        <td><?php echo $list->createdAt;?></td>
                        <td>
                          <a href="<?php echo base_url();?>Transaction/edit/<?php echo $list->id?>" class="btn btn-warning btn-sm">
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

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <script>
      function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
      }
      </script>
