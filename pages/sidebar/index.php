<?php
  $cur = $_SERVER['REQUEST_URI'];
 ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="../../dist/img/AdminLTELogo.png"
         alt="AdminLTE Logo"
         class="brand-image img-circle elevation-3"
         style="opacity: .8">
    <span class="brand-text font-weight-light">GTT Group</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">
          <?= ucwords($_SESSION['username']); ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="/index.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Data Master
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a class="nav-link <?= strpos($cur, 'eoq/pages/admin/') ? 'active' : '' ?>" href="/eoq/pages/admin">
                <i class="far fa-user nav-icon"></i>
                <p>Data User</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= strpos($cur, 'eoq/pages/item/') ? 'active' : '' ?>" href="/eoq/pages/item">
                <i class="fas fa-box nav-icon"></i>
                <p>Data Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?= strpos($cur, 'eoq/pages/reseller/') ? 'active' : '' ?>" href="/eoq/pages/reseller">
                <i class="fas fa-user-tie nav-icon"></i>
                <p>Data Reseller</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="/eoq/pages/stock" class="nav-link <?= strpos($cur, 'eoq/pages/stock/') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-warehouse"></i>
            <p>Stock</p>
          </a>
        </li>
        <?php if ($_SESSION['role']=="admin" or $_SESSION['role']=="pengadaan") : ?>
        <li class="nav-item">
          <a href="/eoq/pages/pembelian" class="nav-link <?= strpos($cur, 'eoq/pages/pembelian/') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-box"></i>
            <p>Pembelian</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/eoq/pages/perhitungan-eoq" class="nav-link <?= strpos($cur, 'eoq/pages/perhitungan-eoq/') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-calculator"></i>
            <p>Perhitungan EOQ</p>
          </a>
        </li>
        <?php endif; ?>
        <?php if ($_SESSION['role']=="admin" or $_SESSION['role']=="penjualan") : ?>
        <li class="nav-item">
          <a href="/eoq/pages/penjualan" class="nav-link <?= strpos($cur, 'eoq/pages/penjualan/') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cart-plus"></i>
            <p>Penjualan</p>
          </a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a href="/eoq/pages/laporan" class="nav-link <?= strpos($cur, 'eoq/pages/laporan/') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-scroll"></i>
            <p>Laporan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/eoq/backend/session/logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
