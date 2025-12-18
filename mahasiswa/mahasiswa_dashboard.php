<?php 
include '../check/check_mahasiswa.php';
include '../koneksi.php';

$nim = $_SESSION['nim'];


$query_mhs = "SELECT * FROM mahasiswa WHERE nim='$nim'";
$result_mhs = $conn->query($query_mhs);
$data_mhs = $result_mhs->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard Mahasiswa - SIGANDUM</title>
</head>
<body> 

<div class="d-flex">

    <div class="d-flex flex-column flex-shrink-0 p-3 bg-primary text-white" style="width: 250px; min-height: 100vh;">
        <h4 class="mb-3">SIGANDUM</h4>
        <p class="text-white-50 small">Portal Mahasiswa</p>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="mahasiswa_dashboard.php" class="nav-link text-white active bg-dark">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="mahasiswa_krs.php" class="nav-link text-white">
                    Kelola KRS
                </a>
            </li>
            <li>
                <a href="mahasiswa_jadwal.php" class="nav-link text-white">
                    Jadwal Kuliah
                </a>
            </li>
            <li>
                <a href="mahasiswa_nilai.php" class="nav-link text-white">
                    Lihat Nilai
                </a>
            </li>
        </ul>
        <hr>
        <div class="mb-2">
            <small class="text-white-50">Login sebagai:</small>
            <p class="mb-0 fw-bold"><?php echo $_SESSION['nama_lengkap']; ?></p>
            <small class="text-white-50">NIM: <?php echo $nim; ?></small>
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

    <div class="flex-grow-1">
        <header class="bg-dark text-white p-3">
            <h3 class="m-0">Dashboard Mahasiswa</h3>
        </header>
        
        <main class="p-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Informasi Mahasiswa</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Nama</th>
                                    <td>: <?php echo $data_mhs['nama']; ?></td>
                                </tr>
                                <tr>
                                    <th>NIM</th>
                                    <td>: <?php echo $data_mhs['nim']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-primary">
                                <?php
                                $query_krs = "SELECT COUNT(*) as total FROM krs WHERE nim='$nim'";
                                $result_krs = $conn->query($query_krs);
                                $data_krs = $result_krs->fetch_assoc();
                                echo $data_krs['total'];
                                ?>
                            </h1>
                            <p class="mb-0">Mata Kuliah Diambil</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body text-center">
                            <h1 class="text-success">
                                <?php
                                $query_sks = "SELECT SUM(mk.sks) as total_sks 
                                             FROM krs k
                                             JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                             JOIN mk ON j.id_mk = mk.id_mk
                                             WHERE k.nim='$nim'";
                                $result_sks = $conn->query($query_sks);
                                $data_sks = $result_sks->fetch_assoc();
                                echo $data_sks['total_sks'] ?? 0;
                                ?>
                            </h1>
                            <p class="mb-0">Total SKS</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">KRS Saya</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Mata Kuliah</th>
                                        <th>SKS</th>
                                        <th>Dosen</th>
                                        <th>Jadwal</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT 
                                            mk.nama_mk,
                                            mk.sks,
                                            d.nama_dosen, 
                                            j.hari,
                                            j.jam_mulai,
                                            j.jam_selesai,
                                            j.ruangan,
                                            k.nilai
                                        FROM krs k
                                        JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                        JOIN mk ON j.id_mk = mk.id_mk
                                        JOIN dosen d ON j.id_dosen = d.id_dosen 
                                        WHERE k.nim = '$nim'";
                                    $result = $conn->query($sql);
                                    $nomor = 1;

                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            $waktu = $row['hari'] . ", " . substr($row['jam_mulai'], 0, 5) . "-" . substr($row['jam_selesai'], 0, 5);
                                            echo "<tr>
                                                <td class='text-center'>$nomor</td>    
                                                <td>{$row['nama_mk']}</td>
                                                <td class='text-center'>{$row['sks']}</td>
                                                <td>{$row['nama_dosen']}</td>
                                                <td>{$waktu}<br><small>Ruang: {$row['ruangan']}</small></td>
                                                <td class='text-center fw-bold'>{$row['nilai']}</td>
                                            </tr>";
                                            $nomor++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center'>Belum ada KRS</td></tr>";
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