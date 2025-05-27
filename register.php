<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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

        /* Overlay untuk background */
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

        .register-container {
            background: #e0e0e0;
            opacity: 0.80;
            padding: 30px;
            border-radius: 10px;
            width: 490px;
            max-height: 600px;
            z-index: 1;
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

        <!-- Form Register -->
        <div class="register-container d-flex flex-column justify-content-between shadow">
            <div>
                <form method="POST" action="Controller/register_controller.php">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control shadow" id="name" name="nama" placeholder="Enter your name">
                        </div>
                        <div class="col">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control shadow" id="username" name="username" placeholder="Enter your username">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control shadow" id="address" name="alamat" placeholder="Enter your address">
                    </div>
                    <div class="mb-3">
                            <label for="telp" class="form-label">Telp</label>
                            <input type="tel" class="form-control shadow" id="telp" name="telp" placeholder="Enter your phone number">
                        </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control shadow" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-dark w-100 mb-3">Sign Up</button>
                </form>
            </div>

            <!-- Link to Sign In -->
            <div class="text-center mt-auto mx-auto">
                <a class="me-3 fw-bold" href="index.php">Home</a>
                <small>Have an account? <a href="login.php" class="fw-bold">Sign In!</a></small>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5.3.3 JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>