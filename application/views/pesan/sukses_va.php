<!-- LOKASI: application/views/pesan/sukses_va.php -->

<!-- CSS Kustom untuk Halaman Pembayaran -->
<style>
    :root {
        --primary-color: #007bff;
        --success-color: #28a745;
        --light-gray: #f8f9fa;
        --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }
    body {
        background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
    }
    .payment-card {
        background: white;
        border-radius: 20px;
        box-shadow: var(--card-shadow);
        border: none;
        animation: fadeIn 0.8s ease-out;
        overflow: hidden;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .payment-card .card-header {
        background: var(--primary-color);
        color: white;
        padding: 1.5rem;
        border-bottom: none;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    .payment-card .card-header .icon {
        font-size: 2.5rem;
    }
    .va-box {
        background-color: var(--light-gray);
        border: 2px dashed var(--primary-color);
        border-radius: 15px;
        padding: 1.5rem;
        margin-top: 1rem;
    }
    .va-number {
        font-family: 'Courier New', Courier, monospace;
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 2px;
        color: #333;
        word-break: break-all; /* Mencegah nomor VA meluber di layar kecil */
    }
    .copy-btn {
        background: none;
        border: none;
        color: var(--primary-color);
        cursor: pointer;
        font-size: 1.2rem;
        transition: var(--transition);
    }
    .copy-btn:hover {
        transform: scale(1.2);
    }
    .action-btn {
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        font-weight: bold;
        transition: var(--transition);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
</style>

<div class="row justify-content-center my-5">
    <div class="col-lg-7">
        <div class="card payment-card">
            <div class="card-header">
                <i class="fas fa-file-invoice-dollar icon"></i>
                <div>
                    <h2 class="mb-0">Selesaikan Pembayaran Anda</h2>
                    <p class="mb-0 opacity-75">Pesanan #<?= $data_pesanan['pesanan']->id_pesanan; ?> telah kami terima.</p>
                </div>
            </div>

            <div class="card-body p-4 p-md-5 text-center">
                
                <p class="lead">Silakan lakukan pembayaran sejumlah:</p>
                <h1 class="display-4 fw-bold text-primary mb-3">
                    Rp <?= number_format($data_pesanan['pesanan']->total_harga, 0, ',', '.'); ?>
                </h1>

                <div class="va-box">
                    <p class="mb-1">ke Nomor Virtual Account di bawah ini:</p>
                    <div class="d-flex justify-content-center align-items-center">
                        <span id="va-number" class="va-number me-2"><?= $data_pesanan['pesanan']->nomor_va; ?></span>
                        <button class="copy-btn" onclick="copyVA()" title="Salin Nomor VA">
                            <i class="far fa-copy"></i>
                        </button>
                    </div>
                </div>

                <!-- Tombol dan Pesan Status -->
                <div class="d-grid gap-2 mt-4">
                    <a href="<?= base_url('pesan/cek_status/' . $data_pesanan['pesanan']->order_id); ?>" class="btn btn-success btn-lg action-btn">
                        <i class="fas fa-check-circle"></i> Saya Sudah Bayar, Cek Status
                    </a>
                </div>
                
                <?php if(isset($status_message)): ?>
                <div class="mt-3">
                    <?= $status_message; ?>
                </div>
                <?php endif; ?>

                <div class="d-grid gap-2 mt-2">
                    <a href="<?= base_url('pesan/meja/' . $data_pesanan['pesanan']->id_meja); ?>" class="btn btn-outline-secondary action-btn">
                        <i class="fas fa-utensils"></i> Kembali ke Menu
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk fungsionalitas tambahan -->
<script>
    // Fungsi untuk menyalin nomor VA ke clipboard
    function copyVA() {
        const vaNumberElement = document.getElementById('va-number');
        const vaNumber = vaNumberElement.innerText;
        
        // Menggunakan metode fallback jika navigator.clipboard tidak didukung
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(vaNumber).then(function() {
                alert('Nomor Virtual Account berhasil disalin!');
            });
        } else {
            // Fallback untuk koneksi http atau browser lama
            const textArea = document.createElement("textarea");
            textArea.value = vaNumber;
            document.body.appendChild(textArea);
            textArea.select();
            try {
                document.execCommand('copy');
                alert('Nomor Virtual Account berhasil disalin!');
            } catch (err) {
                alert('Gagal menyalin nomor. Coba salin secara manual.');
            }
            document.body.removeChild(textArea);
        }
    }
</script>
