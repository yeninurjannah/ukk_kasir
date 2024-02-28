<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Kategori</h5>

              <?php if (session()->getFlashdata('erorrs')) : ?>
                            <div class="alert alert-danger alert=dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            <?php foreach (session('errors') as $error): ?>
                                <? $errors; ?>
                                <?php endforeach; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="alert"
                                aria-label="Close"></button>
                            </div>
                            <?php endif ?>

              <!-- Tambah Kategori -->
              <form method="post" action="simpanKategori">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Kategori</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_kategori">
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