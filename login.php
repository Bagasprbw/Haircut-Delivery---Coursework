<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/navbar-fixed/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }
        body::before {
            content: '';
            background-image: url('img/bg-signin.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.75; /* Atur opacity di sini (0.0 - 1.0) */
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1; 
        }

        .login-container {
            background: #e0e0e0;
            opacity: 0.80;
            padding: 30px;
            border-radius: 10px;
            width: 490px;
            max-height: 600px;
            z-index: 1; /* Pastikan di atas background */
        }

        .btn-dark {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container-xl mt-3 mb-5 d-flex flex-column align-items-center">
        <!-- Logo -->
        <img src="img/Logo-terang.png" alt="Logo" class="mb-3" style="width: 150px;">

        <!-- Form Login -->
        <div class="login-container d-flex flex-column justify-content-between shadow">
            <div>
                <h4 class="text-center">SIGN IN</h4>
                <p class="text-center text-muted">Enter your email and password!</p>
                <hr>
                <form class="mt-5">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control shadow" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control shadow" id="password" placeholder="Enter your password">
                    </div>
                    <div class="row mb-3 mt-4 d-flex">
                        <div class="col align-self-center">
                            <a href="#" class="text-muted">Forgot Password?</a>
                        </div>
                        <div class="col text-end">
                            <button type="submit" class="btn btn-dark w-75">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Teks paling bawah -->
            <div class="text-center mt-5 mx-auto">
                <a class="me-3 fw-bold" href="index.php">Home</a>
                <small>Don't have an account yet? <a href="register.php" class="fw-bold">Sign Up</a></small>
            </div>
        </div>
    </div>
    
    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
    