<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Modern</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --info-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --dark-bg: #1a1a2e;
            --card-bg: rgba(255, 255, 255, 0.1);
            --text-light: #ffffff;
            --shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* Animated Background Particles */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        /* Header Styles */
        .dashboard-header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            margin-bottom: 30px;
            padding: 25px;
            box-shadow: var(--shadow);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: slideDown 0.8s ease-out;
        }

        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .dashboard-title {
            color: var(--text-light);
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #fff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .logout-btn {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(255, 107, 107, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(255, 107, 107, 0.4);
            color: white;
        }

        /* Welcome Alert */
        .welcome-alert {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        @keyframes fadeInUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Card Styles */
        .management-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 0;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            overflow: hidden;
            position: relative;
            animation: fadeInUp 1s ease-out both;
        }

        .management-card:nth-child(1) { animation-delay: 0.4s; }
        .management-card:nth-child(2) { animation-delay: 0.6s; }
        .management-card:nth-child(3) { animation-delay: 0.8s; }

        .management-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: var(--hover-shadow);
        }

        .card-header-custom {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
            color: white;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
            font-size: 1.1rem;
        }

        .card-body-custom {
            padding: 25px;
            color: white;
        }

        .card-title-custom {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: white;
        }

        .card-text-custom {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* Icon Styles */
        .card-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            opacity: 0.8;
            transition: all 0.3s ease;
        }

        .management-card:hover .card-icon {
            transform: scale(1.1) rotate(5deg);
            opacity: 1;
        }

        /* Button Styles */
        .btn-custom {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-custom:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Specific card colors */
        .card-menu {
            background: var(--primary-gradient);
        }

        .card-meja {
            background: var(--info-gradient);
        }

        .card-laporan {
            background: var(--success-gradient);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-title {
                font-size: 2rem;
            }
            
            .management-card {
                margin-bottom: 20px;
            }
            
            .card-body-custom {
                padding: 20px;
            }
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Pulse Animation for Important Elements */
        .pulse-animation {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
            100% { box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Animated Background Particles -->
    <div class="particles" id="particles"></div>

    <div class="container-fluid px-4">
        <!-- Dashboard Header -->
        <div class="dashboard-header d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <h1 class="dashboard-title">
                <i class="fas fa-tachometer-alt me-3"></i>
                Dashboard Admin
            </h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <a href="<?= base_url('auth/logout'); ?>" class="btn logout-btn pulse-animation">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Logout
                </a>
            </div>
        </div>

        <!-- Welcome Alert -->
        <div class="welcome-alert">
            <i class="fas fa-user-shield me-2"></i>
            Selamat Datang, <strong>Admin</strong>! Anda login sebagai Administrator.
        </div>

        <!-- Management Cards -->
        <div class="row">
            <!-- Menu Management Card -->
            <div class="col-md-4">
                <div class="card management-card card-menu">
                    <div class="card-header-custom">
                        <i class="fas fa-utensils me-2"></i>
                        Manajemen Menu
                    </div>
                    <div class="card-body-custom text-center">
                        <div class="card-icon">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <h5 class="card-title-custom">Kelola Menu</h5>
                        <p class="card-text-custom">
                            Tambah, ubah, dan hapus daftar menu yang tersedia di warung dengan mudah dan cepat.
                        </p>
                        <a href="<?= base_url('admin/menu'); ?>" class="btn btn-custom">
                            <i class="fas fa-arrow-right"></i>
                            Masuk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Table Management Card -->
            <div class="col-md-4">
                <div class="card management-card card-meja">
                    <div class="card-header-custom">
                        <i class="fas fa-table me-2"></i>
                        Manajemen Meja
                    </div>
                    <div class="card-body-custom text-center">
                        <div class="card-icon">
                            <i class="fas fa-table"></i>
                        </div>
                        <h5 class="card-title-custom">Daftar Meja & Link Pesan</h5>
                        <p class="card-text-custom">
                            Lihat dan kelola daftar link pemesanan untuk setiap meja di warung Anda.
                        </p>
                        <a href="<?= base_url('admin/meja'); ?>" class="btn btn-custom">
                            <i class="fas fa-arrow-right"></i>
                            Masuk
                        </a>
                    </div>
                </div>
            </div>

            <!-- Sales Report Card -->
            <div class="col-md-4">
                <div class="card management-card card-laporan">
                    <div class="card-header-custom">
                        <i class="fas fa-chart-line me-2"></i>
                        Laporan Penjualan
                    </div>
                    <div class="card-body-custom text-center">
                        <div class="card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h5 class="card-title-custom">Lihat Laporan</h5>
                        <p class="card-text-custom">
                            Analisis laporan penjualan harian, mingguan, dan bulanan untuk insight bisnis.
                        </p>
                        <a href="<?= base_url('admin/laporan'); ?>" class="btn btn-custom">
                            <i class="fas fa-arrow-right"></i>
                            Masuk
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Hide loading overlay when page loads
        window.addEventListener('load', function() {
            const loadingOverlay = document.getElementById('loadingOverlay');
            setTimeout(() => {
                loadingOverlay.style.opacity = '0';
                setTimeout(() => {
                    loadingOverlay.style.display = 'none';
                }, 500);
            }, 1000);
        });

        // Create animated particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 50;

            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 6 + 's';
                particle.style.animationDuration = (Math.random() * 3 + 3) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles
        createParticles();

        // Add hover sound effect simulation
        document.querySelectorAll('.management-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-10px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Add click ripple effect
        document.querySelectorAll('.btn-custom').forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add subtle parallax effect
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const particles = document.getElementById('particles');
            particles.style.transform = `translateY(${scrolled * 0.5}px)`;
        });

        // Add dynamic time greeting
        function updateGreeting() {
            const hour = new Date().getHours();
            const welcomeAlert = document.querySelector('.welcome-alert');
            let greeting = '';
            
            if (hour < 12) {
                greeting = 'Selamat Pagi';
            } else if (hour < 18) {
                greeting = 'Selamat Siang';
            } else {
                greeting = 'Selamat Malam';
            }
            
            welcomeAlert.innerHTML = `
                <i class="fas fa-user-shield me-2"></i>
                ${greeting}, <strong>Admin</strong>! Anda login sebagai Administrator.
            `;
        }

        // Update greeting on load
        updateGreeting();
    </script>
</body>
</html>
