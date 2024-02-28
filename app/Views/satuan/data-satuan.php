<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

<div class="p-2">
    <div class="pagetitle">
      <h1>Data Satuan</h1>
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
        <a href="<?=site_url('tambahsatuan'); ?>" type="button" class="btn btn-primary">Tambah</a>
        </div>
              <!-- Table with stripped rows -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Satuan</th>
                    <th scope="col">Aksi</th>
                  
                  </tr>
                </thead>
                <tbody>
                <?php if(isset($listSatuan)) {
                    $no = null;
                    foreach ($listSatuan as $k) {
                      $no++
                      ?>
                      <tr>
                        <td scope="row"><?=$no;?></td>
                        <td><?= $k['nama_satuan']?></td>
                        <td>
                        <a href="<?=site_url('/edit-satuan/'.$k['id_satuan']);?>" title="edit"><i class="btn btn-primary bi bi bi-pencil-fill"></i></a>
                        <a button type="submit" class="btn btn-danger bi bi bi-trash-fill"
                        id="hapusSatuan" data-id="<?= $k['id_satuan']; ?>" onclick="confirm('Yakin');" ></a>
                        <?= csrf_field() ?> 
                    </td>
                  </tr>
                   <?php 
                   }
                  } 
            
        ?>
        </tr>
                </tbody>
              
            </div>
          </div>

        </div>
      </div>
    
    </div>
  </main><!-- End #main -->
  <?= $this->endSection(); ?>