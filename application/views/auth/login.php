<?php
// LOKASI: application/views/auth/login.php
?>

<!-- CSS Kustom untuk Halaman Login -->
<style>
    /* Mengubah warna latar belakang seluruh halaman */
    body {
        background-color: #f4f7f6;
    }
    
    /* Desain kartu login kustom */
    .login-card-custom {
        background: linear-gradient(to bottom right, #FFC107, #FD7E14);
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        color: #343a40;
    }

    /* Menghilangkan latar belakang default header dan footer kartu */
    .login-card-custom .card-header,
    .login-card-custom .card-footer {
        background-color: transparent;
        border-bottom: 0;
        border-top: 0;
    }
    
    /* Memberi sedikit bayangan pada tombol agar lebih menonjol */
    .btn-login-custom {
        box-shadow: 0 0.2rem 0.5rem rgba(0, 0, 0, 0.2);
    }

    /* === KELAS BARU UNTUK MEMBUAT LOGO BUNDAR === */
    .logo-circle {
        width: 150px;       /* Menetapkan lebar */
        height: 150px;      /* Menetapkan tinggi agar menjadi lingkaran sempurna */
        border-radius: 50%; /* Ini properti kunci yang membuatnya bundar */
        object-fit: cover;  /* Memastikan gambar mengisi area lingkaran dengan pas */
        border: 4px solid white; /* Opsional: memberi bingkai putih */
    }
</style>

<div class="row justify-content-center mt-5">
    <div class="col-lg-5 col-md-7">
        
        <div class="card login-card-custom">

            <div class="card-header text-center">
                <!-- Pastikan nama file logo Anda benar (misal: wbk_logo.jpg atau wbk_logo.png) -->
                <!-- PERUBAHAN: Menambahkan kelas 'logo-circle' -->
                <img src="<?= base_url('assets/img/wbk_logo.jpg'); ?>" alt="Logo Warung Bu Komang" class="my-3 logo-circle">
                <h3 class="fw-light">Login Staff</h3>
            </div>

            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                
                <form action="<?= base_url('auth'); ?>" method="post">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= set_value('username'); ?>" />
                        <label for="username">Username</label>
                        <?= form_error('username', '<small class="text-danger ps-2">', '</small>'); ?>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" />
                        <label for="password">Password</label>
                         <?= form_error('password', '<small class="text-danger ps-2">', '</small>'); ?>
                    </div>
                    <div class="d-grid mt-4 mb-0">
                        <button type="submit" class="btn btn-dark btn-lg btn-login-custom">Login</button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center py-3">
                <div class="small">Warung Bu Komang &copy; 2025</div>
            </div>
        </div>

    </div>
</div>