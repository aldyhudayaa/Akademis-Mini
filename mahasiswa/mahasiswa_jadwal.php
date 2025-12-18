<?php 
include '../check/check_mahasiswa.php';
include '../koneksi.php';

$nim = $_SESSION['nim'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../style.css">
    <title>Jadwal Kuliah - SIGANDUM</title>
</head>
<body> 

<div class="d-flex">
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-primary text-white" style="width: 250px; min-height: 100vh;">
        <h4 class="mb-3">SIGANDUM</h4>
        <p class="text-white-50 small">Portal Mahasiswa</p>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="mahasiswa_dashboard.php" class="nav-link text-white">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="mahasiswa_krs.php" class="nav-link text-white">
                    Kelola KRS
                </a>
            </li>
            <li>
                <a href="mahasiswa_jadwal.php" class="nav-link text-white active bg-dark">
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
            <h3 class="m-0">Jadwal Perkuliahan Saya</h3>
        </header>
        
        <main class="p-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Daftar Mata Kuliah yang Diikuti</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Dosen</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Ruangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT mk.nama_mk, mk.sks, d.nama_dosen, 
                                               j.hari, j.jam_mulai, j.jam_selesai, j.ruangan
                                        FROM krs k
                                        JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                        JOIN mk ON j.id_mk = mk.id_mk
                                        JOIN dosen d ON j.id_dosen = d.id_dosen
                                        WHERE k.nim = '$nim'
                                        ORDER BY FIELD(j.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'), j.jam_mulai";
                                
                                $result = $conn->query($sql);
                                $nomor = 1;

                                if ($result && $result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        $waktu = substr($row['jam_mulai'], 0, 5) . " - " . substr($row['jam_selesai'], 0, 5);
                                        echo "<tr>
                                            <td class='text-center'>$nomor</td>    
                                            <td><strong>{$row['nama_mk']}</strong></td>
                                            <td class='text-center'>{$row['sks']}</td>
                                            <td>{$row['nama_dosen']}</td>
                                            <td class='text-center'>{$row['hari']}</td>
                                            <td class='text-center'>$waktu</td>
                                            <td class='text-center'>
                                                <span class='badge bg-info text-dark'>{$row['ruangan']}</span>
                                            </td>
                                        </tr>";
                                        $nomor++;
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Anda belum mengambil mata kuliah apa pun.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>