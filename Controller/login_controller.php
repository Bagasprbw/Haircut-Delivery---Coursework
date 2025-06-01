    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    session_start();
    require_once '../koneksi.php';

    // Hanya izinkan metode POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $_SESSION['error_message'] = 'Invalid request method';
        header('Location: ../login.php');
        exit();
    }

    // Validasi input
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error_message'] = 'Username dan password wajib diisi';
        header('Location: ../login.php');
        exit();
    }

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    try {
        $stmt = $koneksi->prepare("SELECT id_user, username, password, nama, role FROM user WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        // Cek apakah user ditemukan
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            // Bandingkan password secara langsung (jika belum pakai password_hash)
            if ($password === $user['password']) {
                session_regenerate_id(true);
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['logged_in'] = true;

                // Redirect berdasarkan role
                if ($user['role'] === 'Admin') {
                    header('Location: ../Dashboard/dashboard.php');
                } else {
                    header('Location: ../index.php');
                }
                exit();
            } else {
                $_SESSION['error_message'] = 'Password salah';
            }
        } else {
            $_SESSION['error_message'] = 'Username tidak ditemukan';
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = 'Terjadi kesalahan: ' . $e->getMessage();
    }

    // Jika gagal login, kembali ke halaman login
    header('Location: ../login.php');
    exit();
    ?>
