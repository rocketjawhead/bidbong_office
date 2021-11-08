
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Cabang : <?php echo $branch_name;?></h1>
            <a href="<?php echo base_url('Cashier/pos/')?><?php echo $this->uri->segment(3);?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-rocket fa-sm text-white-50"></i> Refresh</a>
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
            <div class="col-xl-7 col-lg-6">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Item</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <!-- <th>No</th> -->
                          <th>Kode</th>
                          <th>Kategori</th>
                          <th>Item</th>
                          <th >Qty</th>
                          <th>Harga</th>
                          <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $no=1;
                        $json = json_encode($list_product_branch);
                        $json_decoded = json_decode($json); 
                        foreach($json_decoded as $list){ ?>
                        <tr>
                          <!-- <td style="width: 2%;"><?php echo $no;?></td> -->
                          <td><?php echo $list->code_product;?></td>
                          <td><?php echo $list->category_name;?></td>
                          <td><?php echo $list->title_product;?></td>
                          <!-- <td><?php echo $list->qty;?></td> -->
                          <td><input style="width: 65px;" type="number" name="qty" id="<?php echo $list->id;?>" value="1" class="quantity form-control"></td>
                          <td><?php echo $list->price_sell;?></td>
                          <td style="width: 10%;justify-content: center;align-content: center;text-align: center;">
                            <button class="add_cart btn btn-info btn-circle btn-sm" data-id="<?php echo $list->id;?>" data-title_product="<?php echo $list->title_product;?>" data-qty="<?php echo $list->qty;?>" data-price="<?php echo $list->price_sell;?>">
                              <i class="fas fa-plus"></i>
                            </button>
                          </td>
                        </tr>
                        <?php $no++;}  ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-xl-5 col-lg-6">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Checkout</h6>
                </div>
                <div class="card-body">
                  <form action="<?php echo site_url('Cashier/insert_transaction/');?><?php echo $this->uri->segment(3);?>" method="post" role="form">
                  <table id="myTable" class="table table-bordered" style="width: 100%;" cellspacing="0">
                      <thead>
                        <tr>
                          <th style="width: 50%;">Item</th>
                          <th style="width: 20%;">Qty</th>
                          <th style="width: 35%;">Total</th>
                          <th style="justify-content: center;align-content: center;text-align: center;">#</th>
                        </tr>
                      </thead>
                      <tbody id="detail_cart">

                      </tbody>
                      
                    </table>
                    <div class="form-group">
                      <select id="pay_method" class="form-control" name="pay_method">
                        <option value="">--- Pilih Metode Pembayaran ---</option>
                        <?php 
                        $json = json_encode($list_payment_method);
                        $json_decoded = json_decode($json); 
                        foreach($json_decoded as $list){ ?>
                        <option value="<?php echo $list->id;?>"><?php echo $list->payment_name;?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Catatan</label>
                      <input type="text" class="form-control" name="note" placeholder="Catatan/No meja (Optional)">
                    </div>
                    <div class="form-group">
                      <label>Total Transaksi</label>
                      <input type="text" id="grand_total" class="form-control" name="grand_total" readonly required>
                    </div>
                    <div class="form-group pay_cash_form" style="display:none">
                      <label>Masukan Uang</label>
                      <input id="pay_cash" name="pay_cash" class="form-control" onkeyup="myFunction()" placeholder="Rp.">

                      <label>Kembalian</label>
                      <input type="text" id="cash_return" name="total_kembalian" placeholder="hasil" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#loadingProcess"> Proses </button>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
      <!-- <script type="text/javascript">
        $(document).ready(function(){
          alert('asdasdas');
        });
      </script> -->
      <script type="text/javascript">
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var id    = $(this).data("id");
            var title_product  = $(this).data("title_product");
            // var qty  = $(this).data("qty");
            var price  = $(this).data("price");
            var qty      = $('#' + id).val();




            $.ajax({
                url : "<?php echo site_url('Cashier/add_to_cart');?>",
                method : "POST",
                data : {id: id, title_product: title_product, qty: qty, price: price},
                success: function(data){
                    $('#detail_cart').html(data);
                    var total = document.getElementById("nilaisubtotal");
                    document.getElementById('grand_total').value = total.value;
                }
            });
        });

        
        $('#detail_cart').load("<?php echo site_url('Cashier/load_cart');?>");

        
        $(document).on('click','.romove_cart',function(){
            var row_id=$(this).attr("id"); 
            $.ajax({
                url : "<?php echo site_url('Cashier/delete_cart');?>",
                method : "POST",
                data : {row_id : row_id},
                success :function(data){
                    $('#detail_cart').html(data);
                    var total = document.getElementById("nilaisubtotal");
                    document.getElementById('grand_total').value = total.value;
                }
            });
        });
    });
</script>
<script>
function myFunction() {
  var cash = document.getElementById("pay_cash");
  var total = document.getElementById("nilaisubtotal");
  // x.value = x.value.toUpperCase();
  var res = cash.value - total.value;
  document.getElementById('cash_return').value = res;
  
}
</script>
<script type="text/javascript">
$(function(){
    $('#pay_method').change(function(){
       var opt = $(this).val();
        if(opt == '1'){
            $('.pay_cash_form').show();
            // $('#pay_cash').prop('required',true);
        }else{
            $('.pay_cash_form').hide();
        }
    });
});
</script>
