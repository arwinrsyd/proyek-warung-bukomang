<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $judul; ?></h1>
    <a href="<?= base_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</div>

<a href="<?= base_url('admin'); ?>" class="btn btn-secondary mb-3"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMenuModal">
  <i class="fas fa-plus"></i> Tambah Menu Baru
</button>
<a href="<?= base_url('admin/status_menu'); ?>" class="btn btn-warning mb-3">
    <i class="fas fa-toggle-on"></i> Ubah Status Menu
</a>
<?= $this->session->flashdata('message'); ?>

<div class="card shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($menu_list as $menu) : ?>
                    <tr>
                        <th scope="row"><?= $no++; ?></th>
                        <td>
                            <img src="<?= base_url('assets/img/menu/' . $menu->gambar); ?>" alt="<?= $menu->nama_menu; ?>" class="img-thumbnail" width="100">
                        </td>
                        <td><?= $menu->nama_menu; ?></td>
                        <td><?= $menu->kategori; ?></td>
                        <td>Rp <?= number_format($menu->harga, 0, ',', '.'); ?></td>
                        <td>
                            <?php if ($menu->status == 'Tersedia') : ?>
                                <span class="badge bg-success"><?= $menu->status; ?></span>
                            <?php else : ?>
                                <span class="badge bg-danger"><?= $menu->status; ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editMenuModal<?= $menu->id_menu; ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="<?= base_url('admin/hapus_menu/' . $menu->id_menu); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <!-- Modal Edit Menu -->
                    <div class="modal fade" id="editMenuModal<?= $menu->id_menu; ?>" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Menu: <?= $menu->nama_menu; ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <?= form_open_multipart('admin/edit_menu/' . $menu->id_menu); ?>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="nama_menu" class="form-label">Nama Menu</label>
                                            <input type="text" class="form-control" name="nama_menu" value="<?= $menu->nama_menu; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori</label>
                                            <select name="kategori" class="form-select" required>
                                                <option value="Makanan" <?= $menu->kategori == 'Makanan' ? 'selected' : ''; ?>>Makanan</option>
                                                <option value="Minuman" <?= $menu->kategori == 'Minuman' ? 'selected' : ''; ?>>Minuman</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input type="number" class="form-control" name="harga" value="<?= $menu->harga; ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" class="form-select" required>
                                                <option value="Tersedia" <?= $menu->status == 'Tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                                                <option value="Habis" <?= $menu->status == 'Habis' ? 'selected' : ''; ?>>Habis</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Gambar Saat Ini</label><br>
                                            <img src="<?= base_url('assets/img/menu/' . $menu->gambar); ?>" width="100" class="img-thumbnail">
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Ganti Gambar (Opsional)</label>
                                            <input class="form-control" type="file" name="gambar">
                                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade" id="tambahMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <?= form_open_multipart('admin/tambah_menu'); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_menu" class="form-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu" placeholder="Contoh: Nasi Ayam Geprek" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select name="kategori" class="form-select" required>
                            <option value="Makanan">Makanan</option>
                            <option value="Minuman">Minuman</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga" placeholder="Contoh: 20000" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="Tersedia">Tersedia</option>
                            <option value="Habis">Habis</option>
                        </select>
                    </div>
                     <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Menu</label>
                        <input class="form-control" type="file" name="gambar">
                        <small class="form-text text-muted">Biarkan kosong untuk menggunakan gambar default.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Menu</button>
                </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>