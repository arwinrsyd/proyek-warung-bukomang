<?php
// LOKASI: application/views/auth/login.php
?>

<!-- CSS Kustom untuk Halaman Login Premium -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    * {
        font-family: 'Poppins', sans-serif;
    }
    
    /* Animated gradient background */
    body {
        background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #f5576c, #4facfe, #00f2fe);
        background-size: 400% 400%;
        animation: gradientShift 15s ease infinite;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Floating particles background */
    .particles {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 1;
    }
    
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
    }
    
    .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
    .particle:nth-child(2) { left: 20%; animation-delay: 1s; }
    .particle:nth-child(3) { left: 30%; animation-delay: 2s; }
    .particle:nth-child(4) { left: 40%; animation-delay: 3s; }
    .particle:nth-child(5) { left: 50%; animation-delay: 4s; }
    .particle:nth-child(6) { left: 60%; animation-delay: 5s; }
    .particle:nth-child(7) { left: 70%; animation-delay: 6s; }
    .particle:nth-child(8) { left: 80%; animation-delay: 7s; }
    .particle:nth-child(9) { left: 90%; animation-delay: 8s; }
    
    @keyframes float {
        0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
        10% { opacity: 1; }
        90% { opacity: 1; }
        100% { transform: translateY(-100px) rotate(360deg); opacity: 0; }
    }
    
    /* Main container */
    .login-container {
        position: relative;
        z-index: 2;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    
    /* Glass morphism card */
    .login-card-premium {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 25px;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.2);
        color: #fff;
        overflow: hidden;
        position: relative;
        transform: translateY(0);
        transition: all 0.3s ease;
        animation: slideUp 0.8s ease-out;
    }
    
    @keyframes slideUp {
        0% { transform: translateY(50px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    
    .login-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 35px 70px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.15),
            inset 0 1px 0 rgba(255, 255, 255, 0.25);
    }
    
    /* Card header */
    .login-card-premium .card-header {
        background: transparent;
        border: none;
        padding: 2rem 2rem 1rem;
        position: relative;
    }
    
    /* Logo styling with premium effects */
    .logo-premium {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.3);
        box-shadow: 
            0 15px 35px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1),
            inset 0 2px 0 rgba(255, 255, 255, 0.2);
        position: relative;
        transition: all 0.3s ease;
        animation: logoGlow 2s ease-in-out infinite alternate;
    }
    
    @keyframes logoGlow {
        0% { box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2), 0 0 20px rgba(255, 255, 255, 0.1); }
        100% { box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3), 0 0 30px rgba(255, 255, 255, 0.2); }
    }
    
    .logo-premium:hover {
        transform: scale(1.05);
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.3),
            0 0 40px rgba(255, 255, 255, 0.2);
    }
    
    /* Title styling */
    .login-title {
        font-weight: 600;
        font-size: 2rem;
        margin-top: 1.5rem;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #fff, #f0f0f0);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        animation: titleShine 3s ease-in-out infinite;
    }
    
    @keyframes titleShine {
        0%, 100% { filter: brightness(1); }
        50% { filter: brightness(1.2); }
    }
    
    /* Form styling */
    .login-card-premium .card-body {
        padding: 1rem 2rem 2rem;
    }
    
    .form-floating-premium {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .form-floating-premium .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        color: #fff;
        font-size: 1rem;
        padding: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .form-floating-premium .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.1);
        transform: translateY(-2px);
    }
    
    .form-floating-premium .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }
    
    .form-floating-premium label {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 500;
    }
    
    /* Premium button */
    .btn-login-premium {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 15px;
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
        padding: 1rem 2rem;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-login-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-login-premium:hover::before {
        left: 100%;
    }
    
    .btn-login-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    
    .btn-login-premium:active {
        transform: translateY(-1px);
    }
    
    /* Footer styling */
    .login-card-premium .card-footer {
        background: transparent;
        border: none;
        padding: 1rem 2rem 2rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
    }
    
    /* Error message styling */
    .text-danger {
        color: #ff6b6b !important;
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    
    /* Flash message styling */
    .alert {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        color: #fff;
        margin-bottom: 1.5rem;
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .login-card-premium {
            margin: 1rem;
            border-radius: 20px;
        }
        
        .logo-premium {
            width: 100px;
            height: 100px;
        }
        
        .login-title {
            font-size: 1.5rem;
        }
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
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
</style>

<!-- Floating particles background -->
<div class="particles">
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
    <div class="particle"></div>
</div>

<div class="login-container">
    <div class="col-lg-5 col-md-7 col-sm-9">
        
        <div class="card login-card-premium">

            <div class="card-header text-center">
                <img src="<?= base_url('assets/img/wbk_logo.jpg'); ?>" alt="Logo Warung Bu Komang" class="logo-premium">
                <h3 class="login-title">Login Staff</h3>
            </div>

            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>
                
                <form action="<?= base_url('auth'); ?>" method="post" id="loginForm">
                    <div class="form-floating-premium">
                        <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= set_value('username'); ?>" required />
                        <label for="username">Username</label>
                        <?= form_error('username', '<small class="text-danger ps-2">', '</small>'); ?>
                    </div>
                    
                    <div class="form-floating-premium">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" required />
                        <label for="password">Password</label>
                        <?= form_error('password', '<small class="text-danger ps-2">', '</small>'); ?>
                    </div>
                    
                    <div class="d-grid mt-4 mb-0">
                        <button type="submit" class="btn btn-login-premium" id="loginBtn">
                            <span class="btn-text">Login</span>
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-footer text-center">
                <div class="small">✨ Warung Bu Komang &copy; 2025 ✨</div>
            </div>
        </div>

    </div>
</div>

<!-- JavaScript untuk efek interaktif -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Loading effect pada form submit
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const btnText = loginBtn.querySelector('.btn-text');
    
    loginForm.addEventListener('submit', function() {
        loginBtn.classList.add('loading');
        btnText.textContent = 'Logging in...';
        loginBtn.disabled = true;
    });
    
    // Animasi input focus
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });
    
    // Parallax effect untuk particles
    document.addEventListener('mousemove', function(e) {
        const particles = document.querySelectorAll('.particle');
        const x = e.clientX / window.innerWidth;
        const y = e.clientY / window.innerHeight;
        
        particles.forEach((particle, index) => {
            const speed = (index + 1) * 0.5;
            const xPos = x * speed;
            const yPos = y * speed;
            
            particle.style.transform = `translate(${xPos}px, ${yPos}px)`;
        });
    });
    
    // Smooth card entrance
    const card = document.querySelector('.login-card-premium');
    setTimeout(() => {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);
});
</script>
