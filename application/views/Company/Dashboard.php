
        <!-- Begin Page Content -->
        <div class="container-fluid">
        
          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-12">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Company Setting</h6>
                </div>
                <form action="<?php echo site_url('Company/save_company');?>" method="post" role="form">
                <div class="card-body">

                  <div class="form-group">
                    <label>Perusahaan</label>
                    <input type="text" class="form-control" name="company_name" value="<?php echo $company_name;?>" required>
                  </div>

                  <div class="form-group">
                    <label>Tipe Perusahaan</label>
                    <select class="form-control" name="company_type" required>
                      <option value="<?php echo $company_type;?>">Data Terpilih : <?php if($company_type == 1){ echo "Penjualan Barang";}else{ echo "Jasa/Service"; }?></option>
                      <option value="1">Penjualan Barang</option>
                      <option value="2">Jasa/Service</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Provinsi</label>
                    <select name="provinsi" class="form-control" id="provinsi" required>
                      <option value="<?php echo $provinsi_id;?>">Data Terpilih : <?php echo $provinsi_name;?></option>
                      <?php 
                        foreach($provinsi as $prov)
                        {
                          echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
                        }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kabupaten</label>
                    <select name="kabupaten" class="form-control" id="kabupaten" required>
                      <option value="<?php echo $kabupaten_id;?>">Data Terpilih : <?php echo $kabupaten_name;?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kecamatan</label>
                    <select name="kecamatan" class="form-control" id="kecamatan" required>
                      <option value="<?php echo $kecamatan_id;?>">Data Terpilih : <?php echo $kecamatan_name;?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Kelurahan</label>
                    <select name="kelurahan" class="form-control" id="desa" required>
                      <option value="<?php echo $kelurahan_id;?>">Data Terpilih : <?php echo $kelurahan_name;?></option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>No.Telephone</label>
                    <input type="number" class="form-control" name="phonenumber" value="<?php echo $phonenumber;?>" required>
                  </div>

                  <div class="form-group">
                    <label>Website</label>
                    <input type="text" class="form-control" name="website" value="<?php echo $website;?>">
                  </div>

                  <div class="form-group">
                    <label>Instagram</label>
                    <input type="text" class="form-control" name="instagram" value="<?php echo $instagram;?>">
                  </div>

                  <div class="form-group">
                    <label>Facebook</label>
                    <input type="text" class="form-control" name="facebook" value="<?php echo $facebook;?>">
                  </div>

                  <div class="form-group">
                    <label>Twitter</label>
                    <input type="text" class="form-control" name="twitter" value="<?php echo $twitter;?>">
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
      <script src="<?php echo base_url()?>sbadmin/js/jquery-2.2.4.min.js"></script>
      <script>
            $(document).ready(function(){
                $("#provinsi").change(function (){
                    var url = "<?php echo site_url('Wilayah/add_ajax_kab');?>/"+$(this).val();
                    $('#kabupaten').load(url);
                    return false;
                })
       
            $("#kabupaten").change(function (){
                    var url = "<?php echo site_url('Wilayah/add_ajax_kec');?>/"+$(this).val();
                    $('#kecamatan').load(url);
                    return false;
                })
       
            $("#kecamatan").change(function (){
                    var url = "<?php echo site_url('Wilayah/add_ajax_des');?>/"+$(this).val();
                    $('#desa').load(url);
                    return false;
                })
            });
        </script>
