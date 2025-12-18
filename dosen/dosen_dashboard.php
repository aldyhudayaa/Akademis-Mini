<?php 
include '../check/check_dosen.php';
include '../koneksi.php';

$id_dosen = $_SESSION['id_dosen'];

// Ambil data dosen
$query_dosen = "SELECT * FROM dosen WHERE id_dosen='$id_dosen'";
$result_dosen = $conn->query($query_dosen);
$data_dosen = $result_dosen->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard Dosen - SIGANDUM</title>
</head>
<body> 

<div class="d-flex">
    <!-- Sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-primary text-white" style="width: 250px; min-height: 100vh;">
        <h4 class="mb-3">SIGANDUM</h4>
        <p class="small">Portal Dosen</p>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="dosen_dashboard.php" class="nav-link text-white active bg-dark">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="dosen_jadwal.php" class="nav-link text-white">
                    Jadwal Mengajar
                </a>
            </li>
            <li>
                <a href="dosen_nilai.php" class="nav-link text-white">
                    Input Nilai
                </a>
            </li>
        </ul>
        <hr>
        <div class="mb-2">
            <small>Login sebagai:</small>
            <p class="mb-0 fw-bold"><?php echo $_SESSION['nama_lengkap']; ?></p>
            <small>ID: <?php echo $id_dosen; ?></small>
        </div>
        <button type="button" class="btn btn-danger" id="logout">Logout</button>
        <script>
            document.getElementById('logout').addEventListener('click', function() {
                if (confirm('Yakin ingin keluar?')) {
                    window.location.href = '../logout.php'; 
                }
            });
        </script>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <header class="bg-dark text-white p-3">
            <h3 class="m-0">Dashboard Dosen</h3>
        </header>
        
        <main class="p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-warning">
                            <h5 class="mb-0">Informasi Dosen</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Nama Dosen</th>
                                    <td>: <?php echo $data_dosen['nama_dosen']; ?></td>
                                </tr>
                                <tr>
                                    <th>ID Dosen</th>
                                    <td>: <?php echo $data_dosen['id_dosen']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-warning">
                                <?php
                                $query_jadwal = "SELECT COUNT(*) as total FROM jadwal WHERE id_dosen='$id_dosen'";
                                $result_jadwal = $conn->query($query_jadwal);
                                $data_jadwal = $result_jadwal->fetch_assoc();
                                echo $data_jadwal['total'];
                                ?>
                            </h1>
                            <p class="mb-0">Jadwal Mengajar</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-info">
                                <?php
                                $query_mhs = "SELECT COUNT(DISTINCT k.nim) as total 
                                             FROM krs k
                                             JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                             WHERE j.id_dosen='$id_dosen'";
                                $result_mhs = $conn->query($query_mhs);
                                $data_mhs_count = $result_mhs->fetch_assoc();
                                echo $data_mhs_count['total'];
                                ?>
                            </h1>
                            <p class="mb-0">Total Mahasiswa</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-success">
                                <?php
                                $query_mk = "SELECT COUNT(DISTINCT id_mk) as total FROM jadwal WHERE id_dosen='$id_dosen'";
                                $result_mk = $conn->query($query_mk);
                                $data_mk = $result_mk->fetch_assoc();
                                echo $data_mk['total'];
                                ?>
                            </h1>
                            <p class="mb-0">Mata Kuliah</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Jadwal Mengajar Saya</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Hari</th>
                                        <th>Jam</th>
                                        <th>Ruangan</th>
                                        <th>Semester</th>
                                        <th>Jumlah Mahasiswa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT j.*, mk.nama_mk, mk.sks,
                                            (SELECT COUNT(*) FROM krs WHERE id_jadwal = j.id_jadwal) as jml_mhs
                                            FROM jadwal j
                                            JOIN mk ON j.id_mk = mk.id_mk
                                            WHERE j.id_dosen = '$id_dosen'
                                            ORDER BY j.hari, j.jam_mulai";
                                    $result = $conn->query($sql);
                                    $nomor = 1;

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $jam = substr($row['jam_mulai'], 0, 5) . " - " . substr($row['jam_selesai'], 0, 5);
                                            echo "<tr>
                                                <td class='text-center'>$nomor</td>    
                                                <td>
                                                    <strong>{$row['nama_mk']}</strong><br>
                                                    <small class='text-muted'>{$row['sks']} SKS</small>
                                                </td>
                                                <td class='text-center'>{$row['hari']}</td>
                                                <td class='text-center'>{$jam}</td>
                                                <td class='text-center'>{$row['ruangan']}</td>
                                                <td class='text-center'>{$row['semester']}</td>
                                                <td class='text-center'>
                                                    <span class='badge bg-primary'>{$row['jml_mhs']} Mahasiswa</span>
                                                </td>
                                            </tr>";
                                            $nomor++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='7' class='text-center'>Belum ada jadwal mengajar</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>