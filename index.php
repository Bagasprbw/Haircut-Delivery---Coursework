<?php
session_start();
require_once 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trim Corner</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="CSS/style.css" />
    <!-- STYLING RATING -->
        <style>
        .rating {
            direction: rtl;
            display: flex;
            gap: 5px;
        }
        .rating input {
            display: none;
        }
        .rating label {
            font-size: 1.5rem;
            color: #ccc;
            cursor: pointer;
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffc107;
        }
        </style>
</head>

<body>
    <!-- Navbar And Sidebar -->
    <?php include 'Components/navbar.php' ?>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Opening -->
        <div class="backgorund container-fluid d-flex justify-content-center align-items-center flex-column">
            <h1>WE ARE TRIM CORNER</h1>
            <p class="fs-6">
                Kami bukan sekadar tempat cukur — kami adalah rumah bagi gaya dan
                kepercayaan diri. Di sini, setiap potongan <br />rambut adalah karya
                seni, dan setiap pelanggan adalah prioritas utama kami.
            </p>
            <a href="booking.php" class="btn btn-light px-4 py-2 rounded-pill" role="button">
                Booking Now
            </a>
        </div>

        <!-- Services Container -->
        <div class="container-fluid d-flex justify-content-center align-items-center" id="services">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Content -->
                    <div class="col-lg-6 col-md-12">
                        <div class="left-content">
                            <h1 class="services-title mb-4">
                                SERVICE <br />
                                & PRICE
                            </h1>
                            <span class="line"></span>
                            <p class="services-text">
                                Kami menawarkan berbagai layanan yang <br class="d-none d-lg-block" />dapat disesuaikan dengan
                                kebutuhan Anda. <br class="d-none d-lg-block" />Dari potongan rambut hingga perawatan rambut,
                                <br class="d-none d-lg-block" />kami memiliki semua yang Anda butuhkan untuk <br class="d-none d-lg-block" />tampil dan
                                merasa percaya diri.
                            </p>
                            <div class="btn-container">
                                <a class="btn btn-primary" href="layanan.php" role="button">VIEW ALL</a>
                                <a class="btn btn-primary" href="simulasi_perhitungan.php" role="button">Hitung Simulasimu</a>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Services Cards -->
                    <div class="col-lg-6 col-md-12">
                        <div class="row g-3">
                            <div class="service-container col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="service-card">
                                    <img src="./img/haircut-icon.png" alt="Haircut Icon" />
                                    <h4>Haircut</h4>
                                    <p>
                                        Seni memahat rambut agar tampak segar, rapi, dan sesuai karakter pelanggan. Teknik presisi menghasilkan potongan yang stylish dan maskulin.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="service-card">
                                    <img src="./img/clipper-icon.png" alt="Trimming Icon" />
                                    <h4>Trimming</h4>
                                    <p>
                                        Sentuhan akhir untuk menjaga kerapihan. Baik itu rambut, jenggot, atau kumis, trimming memastikan tampilan tetap tajam tanpa perubahan drastis.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="service-card">
                                    <img src="./img/razor-icon.png" alt="Shaving Icon" />
                                    <h4>Shaving</h4>
                                    <p>
                                        Ritual mencukur yang memberikan hasil halus dan bersih. Menggunakan teknik klasik atau modern, menciptakan tampilan fresh dan maskulin.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                <div class="service-card">
                                    <img src="./img/comb-icon.png" alt="Styling Icon" />
                                    <h4>Styling</h4>
                                    <p>
                                        Sentuhan akhir yang membuat gaya rambut semakin berkarakter. Dengan bantuan pomade, wax, atau gel, rambut siap tampil maksimal sepanjang hari.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Works Container -->
        <div class="container my-5">
            <div class="text-center mb-4">
                <h1 class="fw-bold">GALLERY</h1>
                <div style="height: 3px; width: 200px; background-color: #000; margin: 10px auto;"></div>
            </div>

            <!-- New Gallery Container -->
            <div class="gallery-container">
                <div class="gallery-scroll" id="galleryScroll">
                    <!-- Items will be added by JavaScript -->
                </div>  
            </div>
        </div>


        <!-- Product Container -->
        <div class="container-fluid bg-light">
            <div class="container d-flex justify-content-center align-items-center flex-column text-center product-section" id="product">
                <h1 class="fw-bold mb-3">OUR PRODUCT</h1>
                <div class="section-divider"></div>
                
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-4 g-3 g-md-4 mt-2 mt-md-4 justify-content-center w-100 row-equal-height">
                    <div class="col">
                        <div class="product-card p-3">
                            <img src="img/pomade.png" alt="Pomade">
                            <h5 class="fw-bold">POMADE</h5>
                            <p>Rahasia gaya rambut sleek dan rapi dengan kilau elegan. Cocok untuk slick back, side part, hingga pompadour.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product-card p-3">
                            <img src="img/clay.png" alt="Clay">
                            <h5 class="fw-bold">CLAY</h5>
                            <p>Tekstur matte, daya rekat tinggi, dan hasil natural. Ideal untuk tampilan messy atau textured crop yang effortless.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product-card p-3">
                            <img src="img/hairPowder.png" alt="Hair Powder">
                            <h5 class="fw-bold">HAIR POWDER</h5>
                            <p>Volume instan tanpa rasa berat. Solusi cepat untuk rambut lebih tebal, fresh, dan bervolume sepanjang hari.</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="product-card p-3">
                            <img src="img/hairTonic.png" alt="Hair Tonic">
                            <h5 class="fw-bold">HAIR TONIC</h5>
                            <p>Nutrisi untuk rambut dan kulit kepala. Menyegarkan, menyehatkan, dan menjaga rambut tetap kuat serta mudah diatur.</p>
                        </div>
                    </div>
                </div>
                
                <button class="btn btn-dark mt-3 mt-md-4 px-4 py-2 rounded-pill">VIEW ALL</button>
            </div>
        </div>
        <!-- ULASAN SECTION -->
        <?php
        // Ambil ulasan dari database
        $queryUlasan = mysqli_query($koneksi, "SELECT u.pesan, u.rating, u.tanggal, us.nama FROM ulasan u JOIN user us ON u.id_user = us.id_user ORDER BY u.tanggal DESC LIMIT 5");
        ?>

        <?php
            if (isset($_SESSION['ulasan_status'])) {
                echo '<div class="container mt-4">';
                if ($_SESSION['ulasan_status'] === 'berhasil') {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Terima kasih! Ulasan Anda telah dikirim.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                } elseif ($_SESSION['ulasan_status'] === 'gagal') {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Maaf, terjadi kesalahan saat menyimpan ulasan Anda.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
                }
                echo '</div>';
                unset($_SESSION['ulasan_status']); // Hapus agar tidak muncul terus
            }
        ?>

        <div class="container my-5" id="ulasan">
            <div class="text-center mb-4">
                <h1 class="fw-bold">Testimony</h1>
                <div style="height: 3px; width: 200px; background-color: #000; margin: 10px auto;"></div>
            </div>

            <div class="row justify-content-center">
                <?php while ($ulasan = mysqli_fetch_assoc($queryUlasan)) : ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <div class="card shadow-sm p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <strong><?= htmlspecialchars($ulasan['nama']) ?></strong>
                                <small><?= date('d M Y', strtotime($ulasan['tanggal'])) ?></small>
                            </div>
                            <div class="text-warning mb-2">
                                <?php for ($i = 0; $i < $ulasan['rating']; $i++) echo '<i class="fas fa-star"></i>'; ?>
                                <?php for ($i = $ulasan['rating']; $i < 5; $i++) echo '<i class="far fa-star"></i>'; ?>
                            </div>
                            <p>"<?= htmlspecialchars($ulasan['pesan']) ?>"</p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php
            // Tampilkan tombol beri ulasan jika user login dan punya pesanan yang selesai
            if (isset($_SESSION['id_user'])) {
                $id_user = $_SESSION['id_user'];
                $cekSelesai = mysqli_query($koneksi, "SELECT * FROM pesanan WHERE id_user = '$id_user' AND status_pesanan = 'Selesai'");
                if (mysqli_num_rows($cekSelesai) > 0) :
            ?>
                <div class="text-center mt-4">
                    <button class="btn btn-dark mb-5 px-4 py-2 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalUlasan">Beri Ulasan</button>
                </div>
            <?php endif;
            } ?>
        </div>

        <!-- MODAL BERIKAN ULASAN -->
        <div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="Controller/ulasan_controller.php" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalUlasanLabel">Beri Ulasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating">
                                <?php for ($i = 5; $i >= 1; $i--) : ?>
                                    <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                                    <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                                <?php endfor; ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea name="pesan" id="pesan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Kirim Ulasan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- End Section -->
    </section>

    <!-- Footer -->
    <?php include 'Components/footer.php' ?>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="JS/interaktif.js"></script>
    <script src="JS/gallery.js"></script>
</body>

</html>