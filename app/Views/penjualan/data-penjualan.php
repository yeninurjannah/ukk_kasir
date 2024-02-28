<?= $this->extend('layout/tamplate'); ?>

<?= $this->section('content'); ?>
<div class="p-2">
  <div class="pagetitle">
    <h1>Transaksi</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="card md-12">
    <div class="card-header">
      <text disabled>
        No.Faktur : <?= $noFaktur; ?>
      </text>&emsp; &emsp; &emsp; &emsp; &emsp;
      <text disabled>
        Tanggal : <?php echo date("d-m-y"); ?>
      </text>&emsp; &emsp; &emsp; &emsp; &emsp;
      <text disabled>
        Waktu : <?php echo date("h:i:sa"); ?>
      </text>&emsp; &emsp; &emsp; &emsp; &emsp;
      <text disabled>
        Kasir : <?= session()->get('nama_user'); ?>
      </text>&emsp; &emsp; &emsp; &emsp; &emsp;
      </text>
    </div>
    <div class="card-body">
      <!-- Floating Labels Form -->
      <form class="row g-3" action="<?= site_url('transaksi-penjualan'); ?>" method="POST">
        <?= csrf_field(); ?>
        <input type="hidden" value="<?= $noFaktur?>" name="no_faktur">
        <div class="col-md-6">
          <div class="form-floating">
            <label for="namaProduk"></label>
            <select class="form-select js-example-basic-single" name="id_produk">
              <!-- <option selected="">Choose...</option> -->
              <?php if (isset($produkList)) :
                foreach ($produkList as $row) : ?>
                  <option value="<?= $row->id_produk; ?>"><?= $row->kode_produk; ?><?= $row->nama_produk; ?> | <?= $row->stok; ?> | <?= number_format($row->harga_jual, 0, ',', '.'); ?></option>
              <?php
                endforeach;
              endif; ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating">
            <input type="text" class="form-control" name="txtqty">
            <label for="floatingName">Jumlah Produk</label>
          </div>
        </div>
        <div class="text-end">
          <button type="sumbit" class="btn sm btn-succes"><i class="bi bi-cart-fill"></i></button>
        </div>
<div class="col-md-12"> 
        <table  class="table table-sm table-striped table-bordered text-center">
                <thead>
                 <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php if(isset($detailPenjualan) && !empty($detailPenjualan)) :
    $no = 1;
    foreach ($detailPenjualan as $detail) : ?>
    <tr>
        <td><?= $no++; ?></td>
        <td><?= $detail['nama_produk']; ?></td>
        <td><?= $detail['qty']; ?></td>
        <td><?= number_format($detail['total_harga'], 0, ',', '.'); ?></td>
    </tr>
<?php endforeach;
else: ?>
    <tr>
        <td colspan="4">Tidak ada produk</td>
    </tr>
<?php endif; ?>
              </tbody>
                 </table>
                  </div>
                <div class="col">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">TOTAL : RP <?= number_format($totalHarga, 0, ',', '.'); ?></h3>
                    </div>

      </form>

      <!-- Table with stripped rows -->
     
    </div>
  </div>
</div>



<!-- form penjualan -->
<div class="card">
  <div class="card-body">
    <h1 class="card-title">Form Pembayaran</h1>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingName" name="total" value="<?= number_format($totalHarga, 0, ',', '.'); ?>">
          <label for="floatingName">Total : </label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingName" name="bayar">
          <label for="floatingName">Bayar</label>
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-floating">
          <input type="text" class="form-control" id="floatingName" name="kembalian">
          <label for="floatingName">Kembalian</label>
        </div>
      </div>
    </div>
  </div>
</div>
</div> <!--end form penjualan -->

</div>
</div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen-elemen yang diperlukan
    var txtBayar = document.getElementById('txtbayar');
    var kembali = document.getElementById('kembali');
    var totalHarga = <?= $totalHarga ?>; // Ambil total harga dari controller dan diteruskan ke view

    // Tambahkan event listener untuk memantau perubahan pada input bayar
    txtBayar.addEventListener('input', function() {
      // Ambil nilai yang dibayarkan
      var bayar = parseFloat(txtBayar.value);

      // Hitung kembaliannya
      var kembalian = bayar - totalHarga;

      // Tampilkan kembaliannya pada input kembali
      if (kembalian >= 0) {
        kembali.value = kembalian.toFixed(2).replace(/(\.00)+$/, ''); // Menampilkan hingga 2 digit desimal
      } else {
        kembali.value = '0'; // Jika kembalian negatif, tampilkan '0.00'
      }
    });
  });
</script>



</main><!-- End #main -->
<?= $this->endSection(); ?>