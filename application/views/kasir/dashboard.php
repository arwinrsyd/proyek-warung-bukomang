<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $judul; ?></h1>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow-sm">
    <div class="card-header">
        Daftar Pesanan Aktif
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Meja</th>
                        <th>Waktu Pesan</th>
                        <th>Total</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($daftar_pesanan)) : ?>
                        <?php foreach($daftar_pesanan as $pesanan) : ?>
                            <tr>
                                <td><strong>#<?= $pesanan->id_pesanan; ?></strong></td>
                                <td><?= $pesanan->nomor_meja; ?></td>
                                <td><?= date('H:i:s', strtotime($pesanan->waktu_pesanan)); ?></td>
                                <td>Rp <?= number_format($pesanan->total_harga, 0, ',', '.'); ?></td>
                                <td><?= $pesanan->metode_pembayaran; ?></td>
                                <td>
                                    <?php 
                                        $badge_class = 'bg-secondary';
                                        if ($pesanan->status_pesanan == 'Menunggu Pembayaran') $badge_class = 'bg-warning text-dark';
                                        if ($pesanan->status_pesanan == 'Diproses') $badge_class = 'bg-info text-dark';
                                        if ($pesanan->status_pesanan == 'Siap Disajikan') $badge_class = 'bg-success';
                                    ?>
                                    <span class="badge <?= $badge_class; ?>"><?= $pesanan->status_pesanan; ?></span>
                                </td>
                                <td>
                                    <!-- Tombol Detail -->
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#detailModal<?= $pesanan->id_pesanan; ?>">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>

                                    <!-- Tombol Konfirmasi hanya muncul jika status 'Menunggu Pembayaran' -->
                                    <?php if($pesanan->status_pesanan == 'Menunggu Pembayaran'): ?>
                                    <a href="<?= base_url('kasir/konfirmasi_pembayaran/' . $pesanan->id_pesanan); ?>" class="btn btn-sm btn-success" onclick="return confirm('Konfirmasi pembayaran untuk pesanan ini?')">
                                        <i class="fas fa-check"></i> Konfirmasi Bayar
                                    </a>
                                    <?php endif; ?>
                                </td>
                            </tr>

                            <!-- Modal Detail Pesanan -->
                            <div class="modal fade" id="detailModal<?= $pesanan->id_pesanan; ?>" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Pesanan #<?= $pesanan->id_pesanan; ?></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <strong>Meja:</strong> <?= $pesanan->nomor_meja; ?><br>
                                                <strong>Total:</strong> Rp <?= number_format($pesanan->total_harga, 0, ',', '.'); ?>
                                            </p>
                                            <h6>Item yang Dipesan:</h6>
                                            <ul class="list-group">
                                                <?php foreach($pesanan->detail as $item): ?>
                                                    <li class="list-group-item d-flex justify-content-between">
                                                        <span><?= $item->nama_menu; ?> (x<?= $item->jumlah; ?>)</span>
                                                        <span>Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></span>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pesanan aktif.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>