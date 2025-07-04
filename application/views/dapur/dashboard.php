<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $judul; ?></h1>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="alert alert-info">
    <i class="fas fa-info-circle"></i> Halaman ini akan memuat ulang secara otomatis setiap 15 detik untuk menampilkan pesanan baru.
</div>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        Pengaturan Cepat
    </div>
    <div class="card-body">
        <p>Jika ada bahan yang habis, segera ubah status menu melalui tombol di bawah ini.</p>
        <a href="<?= base_url('dapur/status_menu'); ?>" class="btn btn-warning">
            <i class="fas fa-toggle-on"></i> Ubah Status Ketersediaan Menu
        </a>
    </div>
</div>

<div class="row">
    <?php if (!empty($daftar_pesanan)) : ?>
        <?php foreach($daftar_pesanan as $pesanan) : ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between">
                        <h5 class="mb-0">Pesanan #<?= $pesanan->id_pesanan; ?></h5>
                        <h5 class="mb-0">Meja <?= $pesanan->nomor_meja; ?></h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <?php foreach($pesanan->detail as $item): ?>
                                <li class="list-group-item">
                                    <strong><?= $item->nama_menu; ?></strong>
                                    <span class="badge bg-dark float-end">x<?= $item->jumlah; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-footer d-grid">
                        <a href="<?= base_url('dapur/tandai_siap/' . $pesanan->id_pesanan); ?>" class="btn btn-success" onclick="return confirm('Tandai pesanan ini sebagai Siap Disajikan?')">
                            <i class="fas fa-check"></i> Tandai Siap Disajikan
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col">
            <p class="text-center text-muted">Belum ada pesanan yang perlu disiapkan.</p>
        </div>
    <?php endif; ?>
</div>

<!-- JavaScript untuk auto-refresh halaman -->
<script>
    setTimeout(function(){
       window.location.reload(1);
    }, 15000); // 15000 milidetik = 15 detik
</script>