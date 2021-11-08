
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Update Produk Jasa</h6>
                </div>
                <form action="<?php echo site_url('Service/update/');?><?php echo $this->uri->segment(3);?>" method="post" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <select class="form-control" name="branch_id" required>
                      <option value="<?php echo $branch_id;?>">Cabang Terpilih : <?php echo $branch_name;?></option>
                      <?php 
                      $json = json_encode($list_branch);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->branch_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" name="category_id" required>
                      <option value="<?php echo $category_id;?>">Kategori Terpilih : <?php echo $category_name;?></option>
                      <?php 
                      $json = json_encode($list_category);
                      $json_decoded = json_decode($json); 
                      foreach($json_decoded as $list){ ?>
                      <option value="<?php echo $list->id;?>"><?php echo $list->category_name;?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="code_product" placeholder="Kode Jasa (Optional)" value="<?php echo $code_product;?>">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="title_product" placeholder="Judul" value="<?php echo $title_product;?>">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="price_sell" placeholder="Harga Jual" value="<?php echo $price_sell;?>">
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
