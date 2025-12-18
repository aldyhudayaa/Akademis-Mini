<?php
session_start();

// Jika sudah login, redirect sesuai level
if(isset($_SESSION['login'])){
    if($_SESSION['level'] == 'admin'){
        header("Location: index.php");
    } elseif($_SESSION['level'] == 'mahasiswa'){
        header("Location: /mahasiswa/mahasiswa_dashboard.php");
    } elseif($_SESSION['level'] == 'dosen'){
        header("Location: /dosen/dosen_dashboard.php");
    }
    exit;
}

include 'koneksi.php';

// Proses Login
if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Query untuk cek username dan password
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($query);
    
    if($result->num_rows > 0){
        $user = $result->fetch_assoc();
        
        $_SESSION['login'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['level'] = $user['level'];
        $_SESSION['nim'] = $user['nim'];
        $_SESSION['id_dosen'] = $user['id_dosen'];
        
        // Redirect sesuai level
        if($user['level'] == 'admin'){
            header("Location: index.php");
        } elseif($user['level'] == 'mahasiswa'){
            header("Location: mahasiswa/mahasiswa_dashboard.php");
        } elseif($user['level'] == 'dosen'){
            header("Location: dosen/dosen_dashboard.php");
        }
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
    </style>
</head>
<body>
    
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>SIGANDUM</h2>
            <p>Sistem Informasi Akademik</p>
        </div>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger">
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

            <button type="submit" class="btn btn-success btn-login" name="login">Login</button>
        </form>

        <div class="text-center mt-3">
            <small class="text-muted">© 2025 SIGANDUM</small>
        </div>
    </div>
</div>

</body>
</html>