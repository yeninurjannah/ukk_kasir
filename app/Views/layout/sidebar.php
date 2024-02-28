<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <?php if (session()->get('level') == 'admin') : ?>
      <li class="nav-item">
        <a class="nav-link " href="dashboard-admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
    <?php endif; ?>


    <?php if (session()->get('level') == 'kasir') : ?>
      <li class="nav-item">
        <a class="nav-link " href="dashboard-admin">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
    <?php endif; ?>

    <?php if (session()->get('level') == 'admin') : ?>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-clipboard"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <a href="<?= site_url('data-kategori'); ?>">
            <i class="bi bi-circle"></i><span>Kategori produk</span>
          </a>
      </li>
    <?php endif; ?>

    <?php if (session()->get('level') == 'admin') : ?>
      <li class="nav-item">
        <a href="/data-satuan">
          <i class="bi bi-circle"></i><span>Satuan produk</span>
        </a>
      </li>
    <?php endif; ?>

    <?php if (session()->get('level') == 'admin') : ?>
      <li>
        <a href="<?= site_url('data-produk'); ?>">
          <i class="bi bi-circle"></i><span>Produk</span>
        </a>
      </li>
  </ul>
<?php endif; ?>

</li><!-- End Components Nav -->

<?php if (session()->get('level') == 'kasir') : ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= site_url('transaksi-penjualan'); ?>">
      <i class="bi bi-cash-coin"></i><span>Transaksi</span></i>
    </a>
  </li><!-- End Tables Nav -->
<?php endif; ?>

<?php if (session()->get('level') == 'admin') : ?>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-cart-check-fill"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="laporan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="<?= site_url('laporan'); ?>">
          <i class="bi bi-circle"></i><span>Laporan Produk</span>
        </a>
      </li>
    </ul>
  </li><!-- End Tables Nav -->
<?php endif; ?>

<?php if (session()->get('level') == 'admin') : ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="
          <i class=" bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Dashboard Nav -->
<?php endif; ?>



<?php if (session()->get('level') == 'admin') : ?>
  <li class="nav-item">
    <a class="nav-link collapsed" href="<?= site_url('data-user'); ?>">
      <i class="bi bi-person-fill-add"></i>
      <span>Pengguna</span>
    </a>
  </li><!-- End Pengguna Page Nav -->
<?php endif; ?>



<li class="nav-item">
  <a class="nav-link collapsed" href="<?= site_url('logout'); ?>" onclick="return confirm('Anda yakin ingin logout?')">

    <i class="bi bi-arrow-right-square"></i>
    <span>Logout</span>
  </a>
</li><!-- End Login Page Nav -->




</ul>

</aside><!-- End Sidebar-->