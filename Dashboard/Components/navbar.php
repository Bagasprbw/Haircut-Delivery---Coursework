<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
                <i class="bi bi-scissors me-2"></i> Dashboard
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto d-flex align-items-center">
                    <li class="nav-item">
                        <a href="../../" class="nav-link px-2 text-white">Landing Page</a>
                    </li>
                    <li class="nav-item">
                        <a href="tambah_jasa.php" class="nav-link px-2 text-white">Tambah Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a href="tambah_produk.php" class="nav-link px-2 text-white">Tambah Produk</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="btn btn-light dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-manage-fill me-1"></i> Data Master
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="data_produk.php">Data Produk</a></li>
                            <li><a class="dropdown-item" href="data_jasa.php">Data Jasa(Services)</a></li>
                        </ul>
                    </li>

                    <li class="nav-item profile-container ms-3">
                        <i class="bi bi-person-circle fs-4 text-white"></i>
                        <div class="dropdown">
                            <a class="nav-link text-white" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical fs-4"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item text-danger" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>