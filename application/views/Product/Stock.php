
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Update Stock</h6>
                </div>
                <form action="<?php echo site_url('Product/update_stock/');?><?php echo $this->uri->segment(3);?>" method="post" role="form">
                <div class="card-body">

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
                    <input type="text" class="form-control" name="qty" placeholder="Jumlah Stock Baru">
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