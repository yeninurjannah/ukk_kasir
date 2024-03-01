<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>


<div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Update Produk</h5>

                        <!-- Floating Labels Form -->
                        <form class="row g-3" action="<?= site_url('updateproduk'); ?>" method="POST">
                            <?= csrf_field(); ?>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="hidden" class="form-control" id="id_produk" value="<?= $listProduk[0]['id_produk']; ?>" name="id_produk">
                                    <input type="text" class="form-control" id="kode_produk" value="<?= $listProduk[0]['kode_produk']; ?>" name="kode_produk">
                                    <label for="kodeProduk">Kode Produk</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="namaProduk" name="namaProduk"value="<?= $listProduk[0]['nama_produk']; ?>">
                                    <label for="namaProduk">Nama Produk</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control money" id="hargaBeli" name="hargaBeli"value="<?= $listProduk[0]['harga_beli']; ?>">
                                    <label for="hargaBeli">Harga Beli</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control money" id="hargaJual" name="hargaJual"value="<?= $listProduk[0]['harga_jual']; ?>">
                                    <label for="hargaJual">Harga Jual</label>
                                </div>
                            </div>

                            
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State" name="Satuan">
                                                         
                                        <?php if (isset($satuan)) {
                                            $no = null;
                                            foreach ($satuan as $row) {
                                                $no++;
                                                $listProduk[0]['id_satuan'] == $row['id_satuan'] ? $pilih='selected' : $pilih=null;
                                                echo '<option value=' . $row['id_satuan'] . '">' . $row['nama_satuan'] . '</option>';
                                            }
                                        }?>
                                      
                                    </select>
                                    <label for="floating Select">Satuan Produk</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelect" aria-label="State" name="Kategori">
                                     
                                    <?php if (isset($kategori)) {
                                            $no = null;
                                            foreach ($kategori as $row) {
                                                $no++;
                                                $listProduk[0]['id_kategori'] == $row['id_kategori'] ? $pilih='selected' : $pilih=null;
                                                echo '<option value=' . $row['id_kategori'] . '">' . $row['nama_kategori'] . '</option>';

                                            }
                                        }?>
                                    </select>
                                    <label for="floatingSelect">Kategori Produk</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="stok" name="stok"value="<?= $listProduk[0]['stok']; ?>">
                                    <label for="stok">Stok</label> 
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            
                            </div>
                        </form><!-- End floating Labels Form -->

                    </div>
                </div>
          <?= $this->endSection(); ?>