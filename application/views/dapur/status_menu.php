<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $judul; ?></h1>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<a href="<?= base_url('dapur'); ?>" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow-sm">
    <div class="card-header">
        Daftar Menu
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Status Saat Ini</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($menu_list as $menu) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><strong><?= $menu->nama_menu; ?></strong></td>
                            <td>
                                <?php 
                                    $badge_class = ($menu->status == 'Tersedia') ? 'bg-success' : 'bg-danger';
                                ?>
                                <span class="badge <?= $badge_class; ?>"><?= $menu->status; ?></span>
                            </td>
                            <td>
                                <?php if ($menu->status == 'Tersedia'): ?>
                                    <a href="<?= base_url('dapur/ubah_status_menu/' . $menu->id_menu . '/Tersedia'); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin mengubah status menu ini menjadi HABIS?')">
                                        <i class="fas fa-times-circle"></i> Tandai Habis
                                    </a>
                                <?php else: ?>
                                    <a href="<?= base_url('dapur/ubah_status_menu/' . $menu->id_menu . '/Habis'); ?>" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin mengubah status menu ini menjadi TERSEDIA?')">
                                        <i class="fas fa-check-circle"></i> Tandai Tersedia
                                    </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>