
<!-- INI NABAR KHUSUS DI FOLDER MEMBERSHIP -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    margin: 0 15px;
    text-decoration: none;
}
.navbar .register {
    background-color: #007bff;
    border-color: #007bff;
    font-size: 1rem;
    padding: 10px 20px;
    border-radius: 25px;
}
/* Navbar End */

/* Sidebar */ 
/* Custom CSS */
.desktop-sidebar {
    width: 300px;
    position: fixed;
    overflow: auto;
    top: 0;
    right: -300px;
    height: 100vh;
    background: white;
    box-shadow: -5px 0 15px rgba(0,0,0,0.2);
    transition: right 0.3s ease;
    z-index: 1060; /* Lebih tinggi dari navbar (biasanya 1030-1050) */
}

.desktop-sidebar.show {
    right: 0;
}

.sidebar-toggle-btn {
    z-index: 1070; /* Lebih tinggi dari sidebar */
    width: 50px;
    height: 50px;
    border-radius: 25%;
    display: none;
}

/* Overlay background */
.sidebar-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1059; /* Dibawah sidebar tapi diatas konten lain */
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.sidebar-overlay.show {
    opacity: 1;
    visibility: visible;
}

/* Tampilkan hanya di desktop */
@media (min-width: 992px) {
    .sidebar-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: center;
    }
}
/* End Sidebar */
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-light">
      <div class="container-fluid px-5">
        <!-- Logo di ujung kiri -->
        <a class="navbar-brand" href="index.php">
          <img class="logo bg-light" src="../../img/logo barber.png" alt="images" />
        </a>
        <!-- Toggle button untuk mobile -->
        <button class="navbar-toggler  bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Menu di ujung kanan -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
          <div class="navbar-nav">
            <a class="isi-nav nav-link" href="../../index.php">Home</a>
            <a class="isi-nav nav-link" href="../../#services">Services</a>
            <a class="isi-nav nav-link" href="../../booking.php">Booking</a>
            <a class="isi-nav nav-link" href="../../#product">Product Catalog</a>
          </div>
        </div>
        <!-- Tombol Sidebar -->
        <button class="btn btn-light sidebar-toggle-btn" id="desktopSidebarToggle">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Sidebar -->
        <div class="desktop-sidebar" id="desktopSidebar">
          <div class="p-3 bg-primary text-white d-flex justify-content-between align-items-center">
              <h5 class="m-0">Menu Sidebar</h5>
              <!-- <button type="button" class="btn-close btn-close-white" id="closeSidebar"></button> -->
          </div>
          <div class="p-3">
              <ul class="nav flex-column">
                  <li class="nav-item">
                      <a class="nav-link active" href="#">
                          <i class="fas fa-home me-2"></i>Beranda
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../../login.php">
                          <i class="fas fa-user me-2"></i> Login
                      </a>
                  </li>
                  <li class="nav-item">
                      <!-- <a class="nav-link" href="/Feature/membership/membership.php"> -->
                      <a class="nav-link" href="../membership/paketWithPHP.php">
                          <i class="fa-solid fa-crown me-2"></i>Paket Langganan
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">
                          <i class="fa-solid fa-images me-2"></i>Gallery
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../dashboard/tambah_jasa.php">
                        <i class="fa-solid fa-list-check me-2"></i>Tambah Layanan(Jasa)
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="../dashboard/tambah_produk.php">
                        <i class="fa-solid fa-box me-2"></i>Tambah Produk(Katalog)
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">
                          <i class="fa-solid fa-phone me-2"></i>Contact Us
                      </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#">
                          <i class="fas fa-cog me-2"></i>Pengaturan
                      </a>
                  </li>
              </ul>
              
              <hr>
              
              <div class="mt-3">
                  <h6>Pengaturan Cepat</h6>
                  <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="darkModeSwitch">
                      <label class="form-check-label" for="darkModeSwitch">Mode Gelap</label>
                  </div>
                  <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="notifSwitch" checked>
                      <label class="form-check-label" for="notifSwitch">Notifikasi</label>
                  </div>
              </div>
          </div>
          <div class="p-3 bg-light position-absolute bottom-0 w-100">
              <button class="btn btn-primary w-100">
                  <i class="fas fa-sign-out-alt me-2"></i> Keluar
              </button>
          </div>
      </div>
      </div>
    </nav>    
</body>
</html>

