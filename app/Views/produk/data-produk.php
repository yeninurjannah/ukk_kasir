
<div class="p-2"><?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>

    <div class="pagetitle">
      <h1>Data Produk</h1>
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
              <a href="<?= site_url('tambah-produk'); ?>" type="button" class="btn btn-primary">Tambah</a>
              </div>
              <!-- Table with stripped rows -->
              
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Satuan Produk</th>
                    <th scope="col">Kategori Produk</th>
                    <th scope="col">Harga Beli</th>
                    <th scope="col">Harga Jual</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Aksi</th>
                  
                  </tr>
                </thead>
                <tbody>
                <?php $no = 1;?>
                   <?php foreach ($listProduk as $k):?> 
                      
                      <tr>
                        <td scope="row"><?=$no++?></td>
                        <td><?= $k['kode_produk']?></td>
                        <td><?= $k['nama_produk']?></td>
                        <td><?= $k['nama_satuan']?></td>
                        <td><?= $k['nama_kategori']?></td>
                        <td><?= $k['harga_beli']?></td>
                        <td><?= $k['harga_jual']?></td>
                        <td><?= $k['stok']?></td>
                        <td>
                        
                        <a href="<?= site_url('edit-produk/' . $k['id_produk']); ?>" class="bi bi-pencil-square btn btn-outline-primary"></a>
                      <form action="/produk/<?= $k['id_produk']; ?>" method="POST" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class=" btn btn-danger bi bi bi-trash-fill"
                          onClick="return confirm('Apakah anda yakin?');"></button>
                    </form>
                    </td> 
                    </tr>
                    <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main><!-- End #main -->
  <?= $this->endSection(); ?>