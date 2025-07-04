<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Admin</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</div>

<div class="alert alert-info">
    Selamat Datang, <strong><?= $this->session->userdata('nama_user'); ?></strong>! Anda login sebagai Admin.
</div>

<div class="row">
    <!-- KOTAK MANAJEMEN MENU -->
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Manajemen Menu</div>
            <div class="card-body">
                <h5 class="card-title">Kelola Menu</h5>
                <p class="card-text">Tambah, ubah, dan hapus daftar menu yang tersedia di warung.</p>
                <a href="<?= base_url('admin/menu'); ?>" class="btn btn-outline-light">Masuk <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <!-- KOTAK MANAJEMEN MEJA (INI YANG BARU) -->
    <div class="col-md-4">
        <div class="card text-white bg-info mb-3">
            <div class="card-header">Manajemen Meja</div>
            <div class="card-body">
                <h5 class="card-title">Daftar Meja & Link Pesan</h5>
                <p class="card-text">Lihat daftar link pemesanan untuk setiap meja di warung.</p>
                <a href="<?= base_url('admin/meja'); ?>" class="btn btn-outline-light">Masuk <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

     <!-- KOTAK LAPORAN PENJUALAN -->
     <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Laporan Penjualan</div>
            <div class="card-body">
                <h5 class="card-title">Lihat Laporan</h5>
                <p class="card-text">Lihat laporan penjualan harian, mingguan, dan bulanan.</p>
                <a href="<?= base_url('admin/laporan'); ?>" class="btn btn-outline-light">Masuk <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>