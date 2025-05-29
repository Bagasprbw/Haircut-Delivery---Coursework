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
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <!-- Navbar And Sidebar -->
    <?php include 'Components/navbar.php'?>

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
      <div class="container-fluid d-flex justify-content-center align-items-center" id="services"  style="height: 550px; padding: 2.5em 3.5em;">
        <div class="left w-50 mr-5 text-start">
          <h1 class="services-title mb-4">
            SERVICE <br />
            & PRICE
          </h1>
          <span class="line"></span>
          <p class="services-text mb-4">
            Kami menawarkan berbagai layanan yang <br />dapat disesuaikan dengan
            kebutuhan Anda. <br />Dari potongan rambut hingga perawatan rambut,
            <br />kami memiliki semua yang Anda butuhkan untuk <br />tampil dan
            merasa percaya diri.
          </p>
          <a class="btn btn-primary" href="#" role="button">VIEW ALL</a>
          <!-- <a class="btn btn-primary" href="./Feature/simulasiPerhitungan.php" role="button">Hitung Simulasimu</a> -->
          <a class="btn btn-primary" href="simulasi_perhitungan.php" role="button">Hitung Simulasimu</a>
        </div>
        <div class="right w-50 row justify-content-center">
          <div class="card col-5 align-items-center py-3" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
            <img src="./img/haircut-icon.png" alt="img1" class="mb-2" style="width: 35px; height: 35px;" />
            <h4 class="card-title fs-5">Haircut</h4>
            <p class="text-center fs-1">
              Seni memahat rambut agar tampak segar, rapi, dan sesuai karakter pelanggan. Teknik presisi menghasilkan potongan yang stylish dan maskulin.
            </p>
          </div>
          <div class="card col-5 align-items-center py-3" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
            <img src="./img/clipper-icon.png" alt="img1" class="mb-2" style="width: 35px; height: 35px;" />
            <h4 class="card-title fs-5">Trimming</h4>
            <p class="text-center fs-1">
              Sentuhan akhir untuk menjaga kerapihan. Baik itu rambut, jenggot, atau kumis, trimming memastikan tampilan tetap tajam tanpa perubahan drastis.
            </p>
          </div>
          <div class="card col-5 align-items-center py-3" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
            <img src="./img/razor-icon.png" alt="img1" class="mb-2" style="width: 35px; height: 35px;" />
            <h4 class="card-title fs-5">Shaving</h4>
            <p class="text-center fs-1">
              Ritual mencukur yang memberikan hasil halus dan bersih. Menggunakan teknik klasik atau modern, menciptakan tampilan fresh dan maskulin.
            </p>
          </div>
          <div class="card col-5 align-items-center py-3" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
            <img src="./img/comb-icon.png" alt="img1" class="mb-2" style="width: 35px; height: 35px;" />
            <h4 class="card-title fs-5">Styling</h4>
            <p class="text-center fs-1">
              Sentuhan akhir yang membuat gaya rambut semakin berkarakter. Dengan bantuan pomade, wax, atau gel, rambut siap tampil maksimal sepanjang hari.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- Works Container -->
    <div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">OUR WORKS</h1>
        <div style="height: 3px; width: 200px; background-color: #000; margin: 10px auto;"></div>
    </div>

    <!-- Gallery Container -->
    <div class="gallery-container position-relative">
        <button class="scroll-btn scroll-btn-left" onclick="scrollGallery(-1)">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        
        <div class="works-container" id="worksContainer">
            <div class="work-item">
                <img src="./img/haircut1.jpg" alt="Haircut 1">
            </div>
            <div class="work-item">
                <img src="./img/haircut2.jpg" alt="Haircut 2">
            </div>
            <div class="work-item">
                <img src="./img/haircut3.jpg" alt="Haircut 3">
            </div>
            <div class="work-item">
                <img src="./img/haircut4.jpg" alt="Haircut 4">
            </div>
            <div class="work-item">
                <img src="./img/haircut5.jpg" alt="Haircut 5">
            </div>
        </div>

        <button class="scroll-btn scroll-btn-right" onclick="scrollGallery(1)">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- Image Upload Form -->
    <div class="container mt-5">
        <h3 class="text-center mb-4">Tambahkan Gambar</h3>
        <form id="imageUploadForm" class="mx-auto" style="max-width: 500px;">
            <div class="mb-3">
                <label for="imageFile" class="form-label">Choose Image</label>
                <input class="form-control" type="file" id="imageFile" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="imageAlt" class="form-label">Image Description</label>
                <input type="text" class="form-control" id="imageAlt" placeholder="Enter image description" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Upload Image</button>
            </div>
        </form>
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
  </body>
</html>