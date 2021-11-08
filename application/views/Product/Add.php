
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
                  <h6 class="m-0 font-weight-bold text-primary">Tambah Produk</h6>
                </div>
                <form action="<?php echo site_url('Product/insert');?>" method="post" role="form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label>Pilih Cabang</label>
                    <select class="form-control" name="branch_id">
                      <option value="">--- Silahkan Pilih Cabang ---</option>
                      <?php 
                      $json = json_encode($list_branch);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->branch_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Pilih Kategori</label>
                    <select class="form-control" name="category_id">
                      <option value="">--- Silahkan Pilih Kategori ---</option>
                      <?php 
                      $json = json_encode($list_category);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->category_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Kode Produk</label>
                    <input type="text" class="form-control" name="code_product">
                  </div>
                  <div class="form-group">
                    <label>Nama Item</label>
                    <input type="text" class="form-control" name="title_product">
                  </div>
                  <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="text" class="form-control" name="price_buy">
                  </div>
                  <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="text" class="form-control" name="price_sell">
                  </div>

                  <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" class="form-control" name="imageurl">
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
