
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Menghapus data produk</h6>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" class="form-control" name="category_code" placeholder="Kode Kategori" value="<?php echo $branch_name;?>" readonly>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" name="category_name" placeholder="Nama Kategori" value="<?php echo $category_name;?>" readonly>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" name="code_product" placeholder="Nama Kategori" value="<?php echo $code_product;?>" readonly>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" name="title_product" placeholder="Nama Kategori" value="<?php echo $title_product;?>" readonly>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" name="price_buy" placeholder="Nama Kategori" value="<?php echo $price_buy;?>" readonly>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" name="price_sell" placeholder="Nama Kategori" value="<?php echo $price_sell;?>" readonly>
                  </div>
                  
                  <button type="submit" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#deleteModal">Delete</button>
                </div>
              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <!-- Logout Modal-->
      <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Alert Data</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Apakah anda yakin ingin menghapus data ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
              <a class="btn btn-danger" href="<?php echo base_url('Product/dodelete/');?><?php echo $this->uri->segment(3);?>">Hapus</a>
            </div>
          </div>
        </div>
      </div>
