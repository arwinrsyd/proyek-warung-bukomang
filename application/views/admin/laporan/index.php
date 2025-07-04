<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $judul; ?></h1>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<a href="<?= base_url('admin'); ?>" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>

<div class="card shadow-sm mb-4">
    <div class="card-header">
        Pilih Tanggal Laporan
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/laporan'); ?>" method="post">
            <div class="row">
                <div class="col-md-4">
                    <input type="date" name="tanggal" class="form-control" value="<?= $tanggal_laporan; ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Laporan untuk tanggal: <strong><?= date('d F Y', strtotime($tanggal_laporan)); ?></strong></span>
        <!-- Tombol Cetak (menggunakan JavaScript) -->
        <button class="btn btn-success" onclick="window.print()"><i class="fas fa-print"></i> Cetak Laporan</button>
    </div>
    <div class="card-body">
        <?php 
            $total_pendapatan = 0;
            $total_item = 0;
        ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Jumlah Terjual</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($laporan)): ?>
                        <?php $no = 1; foreach($laporan as $item): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $item->nama_menu; ?></td>
                                <td><?= $item->jumlah; ?></td>
                                <td>Rp <?= number_format($item->subtotal, 0, ',', '.'); ?></td>
                            </tr>
                            <?php 
                                $total_pendapatan += $item->subtotal;
                                $total_item += $item->jumlah;
                            ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada penjualan pada tanggal ini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <tfoot class="table-light fw-bold">
                    <tr>
                        <td colspan="2">Total</td>
                        <td><?= $total_item; ?> Item</td>
                        <td>Rp <?= number_format($total_pendapatan, 0, ',', '.'); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>