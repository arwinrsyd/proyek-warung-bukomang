<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $judul; ?></h1>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<a href="<?= base_url('admin'); ?>" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>


<div class="row">
    <?php foreach ($meja_list as $meja) : ?>
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Meja Nomor <?= $meja->nomor_meja; ?></h5>
            </div>
            <div class="card-body">
                <div class="row align-items-center">
                    <!-- Kolom untuk Gambar QR Code -->
                    <div class="col-md-5 text-center">
                        <img src="<?= base_url('assets/qrcodes/meja-' . $meja->id_meja . '.png'); ?>" 
                             alt="QR Code Meja <?= $meja->nomor_meja; ?>" 
                             class="img-fluid rounded"
                             onerror="this.onerror=null;this.src='https://placehold.co/150x150/EFEFEF/AAAAAA&text=QR+Belum+Ada';">
                        <a href="<?= base_url('assets/qrcodes/meja-' . $meja->id_meja . '.png'); ?>" class="btn btn-sm btn-success mt-2" download>
                            <i class="fas fa-download"></i> Unduh
                        </a>
                    </div>

                    <!-- Kolom untuk Link -->
                    <div class="col-md-7">
                        <p class="mb-1">Link untuk pemesanan:</p>
                        <input type="text" class="form-control" value="<?= base_url('pesan/meja/' . $meja->id_meja); ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>