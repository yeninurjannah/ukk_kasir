<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Satuan</h5>

              <!-- Tambah Satuan -->

              <form method="POST" action="<?=site_url('updatesatuan');?>">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Satuan</label>
                  <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="hidden" name="id_satuan" value="<?=$listSatuan[0]['id_satuan'];?>">
                    <input type="text" class="form-control"id="inputName4" name="nama_satuan"value="<?=$listSatuan[0]['nama_satuan'];?>">
                  </div>
                </div>
                
                
        
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </div>

              </form><!-- End Tambah Satuan -->

            </div>
          </div>

        </div>
        <?= $this->endSection(); ?>