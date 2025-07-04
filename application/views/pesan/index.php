<!-- Custom CSS untuk efek modern -->
<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        --card-shadow: 0 10px 30px rgba(0,0,0,0.1);
        --card-hover-shadow: 0 20px 40px rgba(0,0,0,0.15);
        --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    .hero-section {
        background: var(--primary-gradient);
        color: white;
        padding: 3rem 0;
        border-radius: 0 0 50px 50px;
        margin-bottom: 2rem;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="white" opacity="0.1"><polygon points="0,100 1000,0 1000,100"/></svg>');
        background-size: cover;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .table-badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.3);
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 1.5rem;
        font-weight: bold;
        display: inline-block;
        margin: 1rem 0;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .menu-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
        border: none;
        position: relative;
        transform: translateY(0);
    }

    .menu-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(102, 126, 234, 0.1), rgba(118, 75, 162, 0.1));
        opacity: 0;
        transition: var(--transition);
        z-index: 1;
    }

    .menu-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--card-hover-shadow);
    }

    .menu-card:hover::before {
        opacity: 1;
    }

    .menu-unavailable .menu-image {
        /* Membuat gambar menjadi hitam-putih (grayscale) */
        filter: grayscale(100%);
    }

    .menu-unavailable:hover {
        /* Menonaktifkan efek hover jika menu tidak tersedia */
        transform: translateY(0);
        box-shadow: var(--card-shadow);
    }

    .menu-card .card-body {
        position: relative;
        z-index: 2;
        padding: 1.5rem;
    }

    .menu-image {
        height: 200px;
        object-fit: cover;
        transition: var(--transition);
        filter: brightness(0.9);
    }

    .menu-card:hover .menu-image {
        filter: brightness(1);
        transform: scale(1.05);
    }

    .price-tag {
        background: var(--success-gradient);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: bold;
        display: inline-block;
        margin: 0.5rem 0;
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
    }

    .add-to-cart-btn {
        background: var(--primary-gradient);
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 50px;
        font-weight: bold;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .add-to-cart-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: var(--transition);
    }

    .add-to-cart-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .add-to-cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .cart-container {
        background: white;
        border-radius: 25px;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        position: sticky;
        top: 2rem;
        border: none;
    }

    .cart-header {
        background: var(--primary-gradient);
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .cart-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }

    .cart-item {
        padding: 1rem;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        transition: var(--transition);
        position: relative;
    }

    .cart-item:hover {
        background: rgba(102, 126, 234, 0.05);
        transform: translateX(5px);
    }

    .cart-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .remove-btn {
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .remove-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
    }

    .total-section {
        background: var(--success-gradient);
        color: white;
        padding: 1.5rem;
        margin: 0 -1rem;
        border-radius: 20px 20px 0 0;
        position: relative;
        overflow: hidden;
    }

    .total-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" fill="white" opacity="0.1"><circle cx="50" cy="50" r="40"/></svg>');
        background-size: 30px 30px;
        animation: move 20s linear infinite;
    }

    @keyframes move {
        0% { transform: translateX(0); }
        100% { transform: translateX(30px); }
    }

    .payment-options {
        margin: 1.5rem 0;
    }

    .payment-option {
        background: rgba(102, 126, 234, 0.1);
        border: 2px solid transparent;
        border-radius: 15px;
        padding: 1rem;
        margin: 0.5rem 0;
        transition: var(--transition);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .payment-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: var(--transition);
    }

    .payment-option:hover::before {
        left: 100%;
    }

    .payment-option:hover {
        border-color: var(--primary-gradient);
        transform: translateY(-2px);
    }

    .payment-option.selected {
        background: var(--primary-gradient);
        color: white;
        border-color: var(--primary-gradient);
    }

    .confirm-btn {
        background: var(--success-gradient);
        border: none;
        padding: 1rem 2rem;
        border-radius: 50px;
        font-weight: bold;
        font-size: 1.1rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .confirm-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: var(--transition);
    }

    .confirm-btn:hover::before {
        width: 300px;
        height: 300px;
    }

    .confirm-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(17, 153, 142, 0.4);
    }

    .empty-cart {
        text-align: center;
        padding: 3rem 1rem;
        color: #6c757d;
    }

    .empty-cart-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.3;
    }

    /* Loading animation */
    .loading {
        position: relative;
        overflow: hidden;
    }

    .loading::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.8), transparent);
        animation: loading 1.5s infinite;
    }

    @keyframes loading {
        0% { left: -100%; }
        100% { left: 100%; }
    }

    /* Responsive improvements */
    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 0;
            border-radius: 0 0 30px 30px;
        }
        
        .cart-container {
            position: static;
            margin-top: 2rem;
        }
        
        .menu-card {
            margin-bottom: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-section">
    <div class="container">
        <div class="hero-content text-center">
            <h1 class="display-4 fw-bold mb-3">🍽️ Selamat Datang di Warung Bu Komang</h1>
            <div class="table-badge">
                Meja Nomor: <?= $meja->nomor_meja; ?>
            </div>
            <p class="lead mt-3">Nikmati hidangan lezat kami dengan pelayanan terbaik</p>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Kolom Daftar Menu (75% lebar) -->
        <div class="col-lg-8">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php foreach ($menu_list as $menu) : ?>
                <div class="col">
                    <?php
                        // Cek apakah menu tersedia atau tidak
                        $is_available = ($menu->status == 'Tersedia');
                        // Tambahkan kelas CSS khusus jika menu tidak tersedia
                        $card_class = $is_available ? '' : 'menu-unavailable';
                    ?>
                    <div class="card menu-card h-100">
                        <div class="position-relative overflow-hidden">
                            <img src="<?= base_url('assets/img/menu/' . $menu->gambar); ?>" 
                                 class="card-img-top menu-image" 
                                 alt="<?= $menu->nama_menu; ?>">
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold mb-3"><?= $menu->nama_menu; ?></h5>
                            <div class="price-tag">
                                Rp <?= number_format($menu->harga, 0, ',', '.'); ?>
                            </div>
                            <?php if ($is_available): ?>
                            <!-- Form untuk menambah ke keranjang -->
                            <form action="<?= base_url('pesan/tambah_ke_keranjang'); ?>" method="post" class="mt-3">
                                <input type="hidden" name="id" value="<?= $menu->id_menu; ?>">
                                <input type="hidden" name="name" value="<?= $menu->nama_menu; ?>">
                                <input type="hidden" name="price" value="<?= $menu->harga; ?>">
                                <input type="hidden" name="gambar" value="<?= $menu->gambar; ?>">
                                <button type="submit" class="btn add-to-cart-btn w-100">
                                    <i class="fas fa-cart-plus me-2"></i>Tambah ke Keranjang
                                </button>
                            </form>
                            <?php else: ?>
                                <!-- JIKA HABIS: Tampilkan tombol yang tidak bisa diklik -->
                                <div class="mt-3">
                                    <button type="button" class="btn w-100" disabled style="background-color: #6c757d; color: white; border-radius: 50px; padding: 0.8rem 1.5rem; font-weight: bold;">
                                        <i class="fas fa-times-circle me-2"></i>Stok Habis
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Kolom Keranjang Belanja (25% lebar) -->
        <div class="col-lg-4">
            <div class="card cart-container">
                <div class="cart-header">
                    <h4 class="mb-0 text-white position-relative">
                        <i class="fas fa-shopping-cart me-2"></i>Keranjang Belanja
                    </h4>
                </div>
                <div class="card-body p-0">
                    <?php if ($this->cart->contents()) : ?>
                        <!-- Mulai Form -->
                        <form action="<?= base_url('pesan/proses_pesanan'); ?>" method="post">
                            
                            <!-- Daftar Item Keranjang -->
                            <div class="cart-items">
                                <?php foreach ($this->cart->contents() as $item) : ?>
                                <div class="cart-item d-flex align-items-center">
                                    <img src="<?= base_url('assets/img/menu/' . $item['options']['gambar']); ?>" 
                                         class="cart-item-image me-3" 
                                         alt="<?= $item['name']; ?>">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1 fw-bold"><?= $item['name']; ?></h6>
                                        <small class="text-muted">Qty: <?= $item['qty']; ?></small>
                                        <div class="fw-bold text-success">
                                            Rp <?= number_format($item['subtotal'], 0, ',', '.'); ?>
                                        </div>
                                    </div>
                                    <a href="<?= base_url('pesan/hapus_dari_keranjang/' . $item['rowid']); ?>" 
                                       class="remove-btn text-white">
                                        <i class="fas fa-times"></i>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            
                            <!-- Total Section -->
                            <div class="total-section position-relative">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0 position-relative">Total Pembayaran:</h5>
                                    <h4 class="mb-0 fw-bold position-relative">
                                        Rp <?= number_format($this->cart->total(), 0, ',', '.'); ?>
                                    </h4>
                                </div>
                            </div>

                            <!-- Pilihan Metode Pembayaran -->
                            <div class="payment-options p-3">
                                <label class="form-label fw-bold mb-3">💳 Pilih Metode Pembayaran:</label>
                                
                                <div class="payment-option" onclick="selectPayment('tunai')">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="metode_pembayaran" 
                                               id="tunai" value="Tunai" checked>
                                        <label class="form-check-label fw-bold" for="tunai">
                                            <i class="fas fa-money-bill-wave me-2"></i>Tunai (Bayar di Kasir)
                                        </label>
                                    </div>
                                </div>
                                
                                                                <!-- GUNAKAN BLOK DIV INI SEBAGAI PENGGANTI -->
                                <div class="payment-option" onclick="selectPayment('bca_va')">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="metode_pembayaran" 
                                            id="bca_va" value="BCA_VA">
                                        <label class="form-check-label fw-bold" for="bca_va">
                                            <i class="fas fa-university me-2"></i>BCA Virtual Account
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3">
                                <button type="submit" class="btn confirm-btn w-100">
                                    <i class="fas fa-check-circle me-2"></i>Konfirmasi Pesanan
                                </button>
                            </div>
                        </form>
                        <!-- Akhir Form -->
                    <?php else : ?>
                        <div class="empty-cart">
                            <div class="empty-cart-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h5 class="mb-2">Keranjang Kosong</h5>
                            <p class="mb-0">Pilih menu favorit Anda untuk memulai pesanan</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk interaksi -->
<script>
    // Fungsi untuk memilih metode pembayaran
    function selectPayment(method) {
        // Reset semua payment options
        document.querySelectorAll('.payment-option').forEach(option => {
            option.classList.remove('selected');
        });
        
        // Set yang dipilih
        document.querySelector(`#${method}`).checked = true;
        document.querySelector(`#${method}`).closest('.payment-option').classList.add('selected');
    }

    // Inisialisasi payment option yang terpilih
    document.addEventListener('DOMContentLoaded', function() {
        const checkedPayment = document.querySelector('input[name="metode_pembayaran"]:checked');
        if (checkedPayment) {
            checkedPayment.closest('.payment-option').classList.add('selected');
        }
    });

    // Animasi loading saat form disubmit
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            }
        });
    });

    // Smooth scroll untuk mobile
    if (window.innerWidth <= 768) {
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                setTimeout(() => {
                    document.querySelector('.cart-container').scrollIntoView({
                        behavior: 'smooth'
                    });
                }, 100);
            });
        });
    }
</script>