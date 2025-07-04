<div class="row justify-content-center my-5">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-body text-center p-4">
                <i class="fas fa-check-circle fa-5x text-success mb-3"></i>
                <h2 class="card-title">Pesanan Berhasil!</h2>
                
                <!-- Pesan dinamis berdasarkan metode pembayaran -->
                <?php if($data_pesanan['pesanan']->metode_pembayaran == 'Tunai'): ?>
                    <p class="lead">Pesanan Anda akan diproses setelah pembayaran dikonfirmasi oleh kasir.</p>
                <?php else: ?>
                    <p class="lead">Pembayaran Anda telah kami terima. Pesanan Anda sedang kami proses.</p>
                <?php endif; ?>
                
                <hr>

                <h5>Detail Pesanan</h5>
                <p>
                    <strong>ID Pesanan:</strong> #<?= $data_pesanan['pesanan']->id_pesanan; ?><br>
                    <strong>Meja Nomor:</strong> <?= $data_pesanan['pesanan']->nomor_meja; ?><br>
                    <strong>Waktu Pesan:</strong> <?= date('d M Y, H:i', strtotime($data_pesanan['pesanan']->waktu_pesanan)); ?>
                </p>

                <ul class="list-group list-group-flush text-start mb-3">
                    <?php foreach($data_pesanan['detail'] as $item) : ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?= $item->nama_menu; ?> (x<?= $item->jumlah; ?>)</span>
                        <span>Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <hr>

                <h4 class="d-flex justify-content-between">
                    <span>Total Bayar:</span>
                    <span>Rp <?= number_format($data_pesanan['pesanan']->total_harga, 0, ',', '.'); ?></span>
                </h4>
                
                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Metode Pembayaran: <?= $data_pesanan['pesanan']->metode_pembayaran; ?></strong>
                    <br>
                    
                    <?php if($data_pesanan['pesanan']->metode_pembayaran == 'Tunai'): ?>
                        Silakan tunjukkan halaman ini ke kasir untuk melakukan pembayaran.
                    <?php else: ?>
                        Pembayaran telah LUNAS. Terima kasih!
                    <?php endif; ?>
                </div>

                <div class="d-grid gap-2 mt-3">
                    <a href="<?= base_url('pesan/meja/' . $data_pesanan['pesanan']->id_meja); ?>" class="btn btn-primary">
                        <i class="fas fa-utensils"></i> Pesan Lagi
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>