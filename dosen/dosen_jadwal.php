<?php 
include '../check/check_dosen.php';
include '../koneksi.php';

$id_dosen = $_SESSION['id_dosen'];

// Proses update nilai
if(isset($_POST['update_nilai'])){
    $id_krs = $_POST['id_krs'];
    $nilai = $_POST['nilai'];
    
    $query = "UPDATE krs SET nilai='$nilai' WHERE id_krs='$id_krs'";
    if($conn->query($query)){
        echo "<script>alert('Nilai berhasil diupdate!'); window.location.href='dosen_nilai.php';</script>";
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
    <title>Input Nilai - SIGANDUM</title>
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
                <a href="dosen_dashboard.php" class="nav-link text-white">
                    Dashboard
                </a>
            </li>
            <li>
                <a href="dosen_jadwal.php" class="nav-link text-white active bg-dark">
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
            <h3 class="m-0">Tampilan Isi Jadwal</h3>
        </header>
        
        <main class="p-4">
            <!-- Filter Mata Kuliah -->

            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Daftar Jadwal:<p class="mb-0"><?php echo $_SESSION['nama_lengkap']; ?></p></h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                    <th>No</th>
                                    <th>Mata Kuliah</th>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Semester</th>
                                    <th>Ruangan</th>
                                </tr>
                        </thead>
                        <tbody>
                            <?php
                            $where = "";
                            if(isset($_GET['id_jadwal']) && $_GET['id_jadwal'] != ''){
                                $id_jadwal_filter = $_GET['id_jadwal'];
                                $where = "AND k.id_jadwal = '$id_jadwal_filter'";
                            }
                            
                            $sql = "SELECT j.*, mk.nama_mk 
                                    FROM jadwal j 
                                    JOIN mk ON j.id_mk = mk.id_mk 
                                    WHERE j.id_dosen = '$id_dosen'
                                    ORDER BY FIELD(j.hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'), j.jam_mulai";
                            $result = $conn->query($sql);
                            $nomor = 1;

                            if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Format jam agar lebih rapi (HH:mm)
                                $jam = substr($row['jam_mulai'], 0, 5) . " - " . substr($row['jam_selesai'], 0, 5);
                                echo "<tr>
                                        <td class='text-center'>$nomor</td>
                                        <td>{$row['nama_mk']}</td>
                                        <td class='text-center'>{$row['hari']}</td>
                                        <td class='text-center'>$jam</td>
                                        <td class='text-center'>{$row['semester']}</td>
                                        <td class='text-center'>
                                            <span class='badge bg-info text-white'>{$row['ruangan']}</span>
                                        </td>
                                    </tr>";
                                $nomor++;
                            }
                        } else {
                            // Pesan jika jadwal kosong
                            echo "<tr><td colspan='6' class='text-center'>Anda tidak memiliki jadwal mengajar.</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

</body>
</html>