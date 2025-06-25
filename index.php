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

        /* Judul Section */
        .title-line {
            height: 3px;
            width: 200px;
            background-color: #000;
            margin: 7px auto;
        }

        /* Rating Summary Card */
        .rating-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
            text-align: center;
            min-width: 250px;
        }

        .rating-score {
            font-size: 2.5rem;
            font-weight: bold;
            color: #333;
        }

        .stars-container {
            position: relative;
            display: inline-block;
        }

        .star-outer i {
            color: #ddd;
            font-size: 1.2rem;
        }

        .star-inner {
            position: absolute;
            top: 0;
            left: 0;
            overflow: hidden;
            white-space: nowrap;
            width: 0%;
        }

        .star-inner i {
            color: #ffc107;
            font-size: 1.2rem;
        }

        .total-reviews {
            font-size: 1rem;
            font-weight: 500;
            margin-top: 0.5rem;
            color: #444;
        }

        /* Rating Breakdown */
        .rating-breakdown .rating-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .rating-number {
            width: 20px;
            font-weight: bold;
            color: #333;
        }

        .progress {
            flex: 1;
            height: 10px;
            background-color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-bar {
            background-color: #ffc107;
            height: 100%;
            transition: width 0.5s ease;
        }

        /* Ulasan Kartu */
        .review-card {
            background: #fff;
            border-radius: 15px;
            padding: 1.2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
        }

        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.8rem;
        }

        .avatar-circle {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .avatar-circle i {
            color: white;
            font-size: 1rem;
        }

        .user-info {
            margin-left: 10px;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .username {
            font-size: 0.75rem;
            color: #888;
        }

        .rating-stars {
            font-size: 0.9rem;
        }

        .rating-stars .fa-star {
            margin-right: 2px;
        }

        .text-warning {
            color: #ffc107 !important;
        }

        .text-muted {
            color: #ddd !important;
        }

        .review-text {
            font-size: 0.9rem;
            line-height: 1.4;
            color: #555;
            margin-bottom: 0;
            text-align: left;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .rating-card {
                min-width: 100%;
                margin-bottom: 1rem;
            }

            .reviews-stats {
                flex-direction: column;
                align-items: center;
            }
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
        // Ambil data rating dari database
        $queryRating = mysqli_query($koneksi, "
            SELECT rating, COUNT(*) as jumlah 
            FROM ulasan 
            GROUP BY rating
            ORDER BY rating DESC
        ");

        $ratingData = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        $totalRating = 0;
        $totalCount = 0;

        while ($row = mysqli_fetch_assoc($queryRating)) {
            $star = intval($row['rating']);
            $count = intval($row['jumlah']);
            $ratingData[$star] = $count;
            $totalRating += $star * $count;
            $totalCount += $count;
        }

        $ratingAverage = $totalCount > 0 ? round($totalRating / $totalCount, 1) : 0;
        ?>

        <div class="container my-5" id="reviews">
            <div class="text-center mb-3">
                <h1 class="fw-bold">CUSTOMER REVIEWS</h1>
                <div class="title-line"></div>
            </div>

            <!-- Statistik Rating -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-10">
                    <div class="reviews-stats d-flex flex-column flex-md-row align-items-center gap-4">
                        <!-- Rata-rata Rating -->
                        <div class="rating-card">
                            <div class="rating-score"><?= $ratingAverage ?></div>
                            <div class="stars-container">
                                <div class="star-outer">
                                    <?php for ($i = 0; $i < 5; $i++) echo '<i class="fas fa-star"></i>'; ?>
                                    <div class="star-inner" style="width: <?= ($ratingAverage / 5) * 100 ?>%;">
                                        <?php for ($i = 0; $i < 5; $i++) echo '<i class="fas fa-star"></i>'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="total-reviews"><?= number_format($totalCount) ?> ulasan</div>
                        </div>

                        <!-- Breakdown Rating -->
                        <div class="rating-breakdown w-100">
                            <?php foreach ($ratingData as $star => $count): 
                                $percent = $totalCount > 0 ? ($count / $totalCount) * 100 : 0;
                            ?>
                            <div class="rating-row d-flex align-items-center mb-2">
                                <span class="rating-number"><?= $star ?></span>
                                <i class="fas fa-star text-warning mx-2"></i>
                                <div class="progress flex-grow-1 me-2">
                                    <div class="progress-bar" role="progressbar" style="width: <?= $percent ?>%;"></div>
                                </div>
                                <span class="rating-count"><?= $count ?></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Review -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-content-center">
                <?php
                $reviewQuery = mysqli_query($koneksi, "
                    SELECT u.pesan, u.rating, u.tanggal, us.nama 
                    FROM ulasan u 
                    JOIN user us ON u.id_user = us.id_user 
                    ORDER BY u.tanggal DESC 
                    LIMIT 8
                ");
                while ($r = mysqli_fetch_assoc($reviewQuery)) :
                ?>
                <div class="col">
                    <div class="review-card h-100">
                        <div class="review-header d-flex align-items-center mb-2">
                            <div class="avatar-circle me-2">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="user-info">
                                <div class="user-name"><?= htmlspecialchars($r['nama']) ?></div>
                                <small class="username"><?= date('d M Y', strtotime($r['tanggal'])) ?></small>
                            </div>
                        </div>
                        <div class="rating-stars mb-2">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fas fa-star <?= $i <= $r['rating'] ? 'text-warning' : 'text-muted' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <p class="review-text">"<?= htmlspecialchars($r['pesan']) ?>"</p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>

            <!-- Tombol Beri Ulasan (jika user login & punya pesanan selesai) -->
            <?php
            if (isset($_SESSION['id_user'])) {
                $id_user = $_SESSION['id_user'];
                $cekSelesai = mysqli_query($koneksi, "SELECT 1 FROM pesanan WHERE id_user = '$id_user' AND status_pesanan = 'Selesai'");
                if (mysqli_num_rows($cekSelesai) > 0): ?>
                <div class="text-center mt-4">
                    <button class="btn btn-dark px-4 py-2 mb-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#modalUlasan">
                        Beri Ulasan
                    </button>
                </div>
            <?php endif; } ?>
        </div>

        <!-- Modal Ulasan -->
        <div class="modal fade" id="modalUlasan" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="Controller/ulasan_controller.php" method="POST" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Beri Ulasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <div class="rating">
                                <?php for ($i = 5; $i >= 1; $i--): ?>
                                    <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required>
                                    <label for="star<?= $i ?>"><i class="fas fa-star"></i></label>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Kirim</button>
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