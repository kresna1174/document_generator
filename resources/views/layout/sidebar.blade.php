<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-flex" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= route('dashboard') ?>">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fa fa-envelope"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Document <sup>Generator</sup></div>
  </a>

  <hr class="sidebar-divider my-0">

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Master
  </div>

  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="javascript:void()" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-fw fa-database"></i>
      <span>Master</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="<?= route('koneksi') ?>">Koneksi</a>
        <a class="collapse-item" href="<?= route('objek') ?>">Objek</a>
        <a class="collapse-item" href="<?= route('jenis_dokumen') ?>">Jenis Dokumen</a>
      </div>
    </div>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Cetak
  </div>


  <!-- Nav Item - Charts -->
  <li class="nav-item">
    <a class="nav-link" href="<?= route('cetak') ?>">
      <i class="fas fa-fw fa-print"></i>
      <span>Cetak</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>