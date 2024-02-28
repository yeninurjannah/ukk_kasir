<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah User</h5>
              
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
               

                <form action="<?= site_url('simpan-user'); ?>" method="post">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama User</label>
                  <div class="col-sm-10">
                    <input type="text" name="nama_user" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                    <input type="text" name="username" class="form-control">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="text" name="password" class="form-control">
                  </div>
                </div>
                
                <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Level</label>
                <div class="col-sm-9">
                    <select class="form-select" id="level" name="level" required>
                      <option selected>Pilih jenis level</option>
                      <option value="admin">Admin</option>
                      <option value="kasir">Kasir</option>
                    </select>
                    </div>
                    </div>
        
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                  </div>
                </div>

              </form><!-- End Tambah User-->

            </div>
          </div>

        </div>
        <?= $this->endSection(); ?>