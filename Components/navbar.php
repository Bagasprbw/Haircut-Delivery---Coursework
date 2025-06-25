<style>
    /* Navbar Start */
    .navbar {
        background: transparent;
        transition: backdrop-filter 0.3s ease-in-out, background-color 0.3s ease-in-out;
        padding: 10px 0;
    }
    .navbar.scrolled {
        background-color: rgba(27, 27, 27, 0.8);
        backdrop-filter: blur(5px);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .navbar .logo {
        border-radius: 10px;
        padding: 5px;
    }
    .navbar .isi-nav {
        color: #fff;
        margin: 0 10px;
        text-decoration: none;
    }
    /* Navbar End */
</style>
<?php
// session_start();
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
?>

<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid px-5">
        <!-- Logo di ujung kiri -->
        <a class="navbar-brand" href="index.php">
            <img class="logo bg-light" src="img/logo barber.png" alt="images" />
        </a>

        <!-- Toggle button untuk mobile -->
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu di tengah -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
            <div class="navbar-nav">
                <a class="isi-nav nav-link" href="index.php">Home</a>
                <a class="isi-nav nav-link" href="layanan.php">Services</a>
                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] === 'Customer'): ?>
                    <!-- Tampilkan untuk guest dan customer -->
                    <a class="isi-nav nav-link" href="<?= $isLoggedIn ? 'booking.php' : 'login.php?redirect=booking' ?>">
                        Booking
                        <!-- <?php if (!$isLoggedIn): ?>
                            <span class="badge bg-warning text-dark ms-1" data-bs-toggle="tooltip" title="Login untuk mengakses">!</span>
                        <?php endif; ?> -->
                    </a>
                <?php endif; ?>
                <a class="isi-nav nav-link" href="produk.php">Product Catalog</a>
            </div>
            <!-- Menu di ujung kanan (login/register atau profil) -->
            <div class="d-flex align-items-center">
                <?php if (!$isLoggedIn): ?>
                    <div class="navbar-nav">
                        <a class="isi-nav nav-link mt-1" href="login.php">Login</a>
                        <a class="isi-nav nav-link register btn btn-primary" href="register.php">Register</a>
                    </div>
                <?php else: ?>
                    <div class="dropdown d-flex align-items-center ms-3">
                        <button class="btn dropdown-toggle text-white" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: transparent; border: none;">
                            <?= htmlspecialchars($_SESSION['nama'] ?? 'User'); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="profile.php">Profil</a></li>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                                <li><a class="dropdown-item" href="Dashboard/dashboard.php">Admin Dashboard</a></li> 
                            <?php elseif (isset($_SESSION['role']) && $_SESSION['role'] === 'Customer'): ?>
                                <li><a class="dropdown-item" href="pesanan_saya.php">Pesanan Saya</a></li>   
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="pengaturan.php">Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                        </ul>
                        <i class="fas fa-user-circle fa-2x text-white me-2"></i>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
    // Mengubah navbar menjadi transparan saat scroll
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
    const bookingLink = document.querySelector('.booking-link');
    const isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
    
    if (!isLoggedIn) {
        bookingLink.addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = this.getAttribute('data-login-url');
        });
        
        bookingLink.style.cursor = 'pointer';
        bookingLink.title = 'Login untuk mengakses fitur booking';
    }
    });
</script>