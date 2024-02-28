<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>



<div class="pagetitle">
  <h1>Data Kategori</h1>
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
        <a href="<?=site_url('tambahkategori'); ?>" type="button" class="btn btn-primary">Tambah</a>
        </div>
          
          <!-- Table with stripped rows -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kategori</th>
                 <th scope="col">Aksi</th>
                 </tr>
                 </thead>
                 <tbody>
                  <?php if(isset($listKategori)) {
                    $no = null;
                    foreach ($listKategori as $k) {
                      $no++
                      ?>
                      <tr>
                        <td scope="row"><?=$no;?></td>
                        <td><?= $k['nama_kategori']?></td>
                        <td>
                        <a href="<?=site_url('/edit-kategori/'.$k['id_kategori']);?>" title="edit"><i class="btn btn-primary bi bi bi-pencil-fill"></i></a>
                        <a button type="submit" class="btn btn-danger bi bi bi-trash-fill"
                        id="hapusKategori" data-id="<?= $k['id_kategori']; ?>" onclick="confirm('Yakin');" ></a>
                        <?= csrf_field() ?> 
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

<?= $this->endSection(); ?>
