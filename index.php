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
        <div class="container d-flex justify-content-center align-items-center flex-column text-center my-5" id="product" style="height: 450px;">
            <h1 class="fw-bold">OUR PRODUCT</h1>
            <span style="height: 3px; width: 200px; background-color: #000;"></span>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-4 justify-content-center">
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
                        <img src="img/hairpowder.png" alt="Hair Powder">
                        <h5 class="fw-bold">HAIR POWDER</h5>
                        <p> Volume instan tanpa rasa berat. Solusi cepat untuk rambut lebih tebal, fresh, dan bervolume sepanjang hari.</p>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card p-3">
                        <img src="img/hairtonic.png" alt="Hair Tonic">
                        <h5 class="fw-bold">HAIR TONIC</h5>
                        <p>Nutrisi untuk rambut dan kulit kepala. Menyegarkan, menyehatkan, dan menjaga rambut tetap kuat serta mudah diatur.</p>
                    </div>
                </div>
            </div>
            <button class="btn btn-dark mt-4 px-4 py-2 rounded-pill">VIEW ALL</button>
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