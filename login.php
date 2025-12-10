<?php
session_start();

// Jika sudah login, redirect ke index.php
if(isset($_SESSION['login'])){
    header("Location: index.php");
    exit;
}

include 'koneksi.php';

// Proses Login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Query untuk cek username dan password
    // CATATAN: Ini contoh sederhana. Di production, gunakan password_hash() dan prepared statement
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if($result->num_rows > 0){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login - SIGANDUM</title>
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #198754;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }
        .btn-login {
            background-color: #198754;
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
        }
        .btn-login:hover {
            background-color: #157347;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 13px;
        }
    </style>
</head>
<body>
    
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>SIGANDUM</h2>
            <p>Sistem Informasi Akademik Universitas</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert-error">
                <strong>Error!</strong> <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password" required>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="remember">
                <label class="form-check-label" for="remember">
                    Ingat Saya
                </label>
            </div>

            <button type="submit" class="btn btn-success btn-login" name="login">Login</button>
        </form>

        <div class="footer-text">
            <p class="mb-0">© 2025 SIGANDUM - Admin: Aldy & Dafi</p>
        </div>
    </div>
</div>

</body>
</html>