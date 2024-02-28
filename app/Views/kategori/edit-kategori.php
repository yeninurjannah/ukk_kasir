<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Kategori</h5>

              <!-- Tambah Kategori -->

              <form method="POST" action="<?=site_url('updatekategori');?>">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="hidden" name="id_kategori" value="<?=$listKategori[0]['id_kategori'];?>">
                    <input type="text" class="form-control"id="inputName4" name="nama_kategori"value="<?=$listKategori[0]['nama_kategori'];?>">
                  </div>
                </div>
                
                
        
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </div>

              </form><!-- End Tambah Kategori -->

            </div>
          </div>

        </div>
        <?= $this->endSection(); ?>