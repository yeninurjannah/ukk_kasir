<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">Tambah Pengguna</h5>
    <!-- Tambah Pengguna -->
    <form method="POST" action="<?= site_url('update-user'); ?>">
      <div class="row mb-3">
          <input type="hidden" class="form-control" name="id_user" value="<?= $listUser[0]['id_user']; ?>">
          <label for="inputNanme4" class="form-label">IdUser</label>
          <input type="text" class="form-control" id="inputName4" name="nama_user" value="<?= $listUser[0]['nama_user']; ?>">
          <label for="inputNanme4" class="form-label">Username</label>
          <input type="text" class="form-control" id="inputName4" name="username" value="<?= $listUser[0]['username']; ?>">
          <label for="inputNanme4" class="form-label">Password</label>
          <input type="password" class="form-control" id="inputName4" name="password" value="<?= $listUser[0]['password']; ?>">
          <label for="inputNanme4" class="form-label">Level</label>
          <input type="text" class="form-control" id="inputName4" name="level" value="<?= $listUser[0]['level']; ?>">
          <required name="user" placeholder="Masukan Nama Pengguna">
      </div>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
  </div>
  </form><!-- End Tambah Pengguna -->
  
</div>
</div>   
</div>
<?= $this->endSection(); ?>