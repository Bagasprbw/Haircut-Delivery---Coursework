<?php session_start();
if (isset($_SESSION['success_message'])) {
    echo "<script>alert('" . $_SESSION['success_message'] . "');</script>";
    unset($_SESSION['success_message']);
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tambahkan meta tags untuk keamanan -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Login Page">
    
    <!-- Load hanya satu versi Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    
    <!-- Tambahkan CSRF token jika diperlukan -->
    <!-- <meta name="csrf-token" content="<?php // echo $_SESSION['csrf_token']; ?>"> -->
    
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
            margin: 0; /* Tambahkan ini */
        }
        body::before {
            content: '';
            background-image: url('img/bg-signin.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.75;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1; 
        }

        .login-container {
            background: #e0e0e0;
            opacity: 0.90; /* Naikkan sedikit opacity */
            padding: 30px;
            border-radius: 10px;
            width: 100%; /* Responsif */
            max-width: 490px; /* Batas maksimum */
            z-index: 1;
            box-shadow: 0 0 20px rgba(0,0,0,0.1); /* Shadow lebih halus */
        }

        @media (max-width: 576px) {
            .login-container {
                padding: 20px;
                margin: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container-xl mt-3 mb-5 d-flex flex-column align-items-center">
        <!-- Logo -->
        <img src="img/Logo-terang.png" alt="Logo" class="mb-3" style="width: 150px; height: auto;"> <!-- Tambahkan height auto -->

        <!-- Form Login -->
        <div class="login-container shadow">
            <!-- Tambahkan pesan error/success dari session -->
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['error_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>
            
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['success_message']); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <h4 class="text-center">SIGN IN</h4>
            <p class="text-center text-muted">Enter your username and password!</p>
            <hr>
            <form class="mt-4" method="POST" action="Controller/login_controller.php" autocomplete="on">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control shadow" id="username" name="username" 
                           placeholder="Enter your username" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control shadow" id="password" name="password" 
                           placeholder="Enter your password" required>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <a href="forgot-password.php" class="text-muted">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-dark w-100 py-2 mb-3">Sign In</button>
            </form>
            
            <div class="text-center mt-4">
                <small>Don't have an account? <a href="register.php" class="fw-bold">Sign Up</a></small>
                <div class="mt-2">
                    <a href="index.php" class="text-decoration-none">← Back to Home</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Gunakan hanya satu versi Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Tambahkan untuk toggle password visibility -->
    <script>
        // Contoh: Tambahkan fungsi untuk toggle password visibility
        // Anda bisa implementasi ini dengan icon mata
    </script>
</body>
</html>