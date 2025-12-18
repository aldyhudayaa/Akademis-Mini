<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Akses Ditolak - SIGANDUM</title>
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-card {
            background: white;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
        }
        .error-icon {
            font-size: 100px;
            color: #dc3545;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">🚫</div>
        <h1 class="text-danger">Akses Ditolak</h1>
        <p class="lead">Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <hr>
        <p class="text-muted mb-4">Silakan login dengan akun yang sesuai atau hubungi administrator.</p>
        <a href="login.php" class="btn btn-primary btn-lg">Kembali ke Login</a>
        <a href="javascript:history.back()" class="btn btn-secondary btn-lg">Kembali</a>
    </div>
</body>
</html>