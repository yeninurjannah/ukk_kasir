<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="p-2">
    <div class="pagetitle">
      <h1>Data Pengguna</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
      
          <div class="card">
            <div class="card-body">
            <?php
          if (session()->getFlashdata('pesan')){ ?>
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
              <?= session()->getFlashdata('pesan'); ?>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          
          <?php } ?>
          <div class="p-3">
              
              <a href="<?=site_url('tambah-user'); ?>" type="button" class="btn btn-primary">Tambah</a>
              </div>
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pengguna</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                  
                  </tr>
                </thead>
                <tbody>
                <?php if(isset($listUser)) {
                    $no = null;
                    foreach ($listUser as $k) {
                      $no++ ?>
                      <tr>
                        <td scope="row"><?=$no;?></td>
                        <td>
                            <?= $k['nama_user']?></td>
                      
                        <td>
                            <?= $k['username']?></td>
                      
                        <td>
                            <?= $k['password']?></td>
                      
                        <td>
                            <?= $k['level']?></td>
                        <td>
                        <a href="<?=site_url('/edit-user/'.$k['id_user']);?>" title="edit"><i class="btn btn-primary bi bi bi-pencil-fill"></i></a>
                        <form action="<?= site_url('hapus-user/' . $k['id_user']); ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <button type="submit" class="btn btn-danger bi bi bi-trash-fill" id="hapusUser"
                        data-id="<?= $k['id_user']; ?>" onclick="confirm('Yakin');" ></button>
                        
                        </form>
                    </td>
                  </tr>
                   <?php 
                   }
                  } 

                    ?>
                 </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>
      </div>
    
    </div>
  </main><!-- End #main -->
  <?= $this->endSection(); ?>