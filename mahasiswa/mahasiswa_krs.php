<?php 
include '../check/check_mahasiswa.php';
include '../koneksi.php';

$nim = $_SESSION['nim'];

// Proses tambah KRS
if(isset($_POST['tambah_krs'])){
    $id_jadwal = $_POST['id_jadwal'];
    
    // Cek apakah sudah terdaftar
    $cek = "SELECT * FROM krs WHERE nim='$nim' AND id_jadwal='$id_jadwal'";
    $result_cek = $conn->query($cek);
    
    if($result_cek->num_rows > 0){
        echo "<script>alert('Anda sudah mengambil mata kuliah ini!');</script>";
    } else {
        $query = "INSERT INTO krs (nim, id_jadwal) VALUES ('$nim', '$id_jadwal')";
        if($conn->query($query)){
            echo "<script>alert('Berhasil menambah mata kuliah!'); window.location.href='mahasiswa_krs.php';</script>";
        }
    }
}

// Proses hapus KRS
if(isset($_GET['hapus'])){
    $id_krs = $_GET['hapus'];
    $query = "DELETE FROM krs WHERE id_krs='$id_krs' AND nim='$nim'";
    if($conn->query($query)){
        echo "<script>alert('Berhasil menghapus mata kuliah!'); window.location.href='mahasiswa_krs.php';</script>";
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
    <title>Kelola KRS - SIGANDUM</title>
</head>
<body> 

<div class="d-flex">
    <!-- Sidebar -->
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
                <a href="mahasiswa_krs.php" class="nav-link text-white active bg-dark">
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
            <h3 class="m-0">Kelola KRS (Kartu Rencana Studi)</h3>
        </header>
        
        <main class="p-4">
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="bi bi-plus-circle"></i> Tambah Mata Kuliah
            </button>

            <div class="modal fade" id="modalTambah">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Mata Kuliah</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr class="text-center">
                                                <th width="50">Pilih</th>
                                                <th>Mata Kuliah</th>
                                                <th>SKS</th>
                                                <th>Dosen</th>
                                                <th>Jadwal</th>
                                                <th>Ruangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT j.id_jadwal, mk.nama_mk, mk.sks, d.nama_dosen, 
                                                    j.hari, j.jam_mulai, j.jam_selesai, j.ruangan
                                                    FROM jadwal j
                                                    JOIN mk ON j.id_mk = mk.id_mk
                                                    JOIN dosen d ON j.id_dosen = d.id_dosen
                                                    WHERE j.id_jadwal NOT IN 
                                                        (SELECT id_jadwal FROM krs WHERE nim='$nim')
                                                    ORDER BY mk.nama_mk";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) {
                                                    $waktu = $row['hari'] . ", " . substr($row['jam_mulai'], 0, 5) . " - " . substr($row['jam_selesai'], 0, 5);
                                                    echo "<tr>
                                                        <td class='text-center'>
                                                            <input type='radio' name='id_jadwal' value='{$row['id_jadwal']}' required>
                                                        </td>
                                                        <td><strong>{$row['nama_mk']}</strong></td>
                                                        <td class='text-center'>{$row['sks']}</td>
                                                        <td>{$row['nama_dosen']}</td>
                                                        <td>{$waktu}</td>
                                                        <td class='text-center'>{$row['ruangan']}</td>
                                                    </tr>";
                                                }
                                            } else {
                                                echo "<tr><td colspan='6' class='text-center'>Semua mata kuliah sudah diambil atau tidak ada jadwal tersedia</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" name="tambah_krs" class="btn btn-primary">Tambah ke KRS</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">KRS Saya</h5>
                </div>
                <div class="card-body">
                    <?php
                    $query_sks = "SELECT SUM(mk.sks) as total_sks 
                                 FROM krs k
                                 JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                 JOIN mk ON j.id_mk = mk.id_mk
                                 WHERE k.nim='$nim'";
                    $result_sks = $conn->query($query_sks);
                    $data_sks = $result_sks->fetch_assoc();
                    $total_sks = $data_sks['total_sks'] ?? 0;
                    ?>
                    <div class="alert alert-info">
                        <strong>Total SKS yang diambil: <?php echo $total_sks; ?> SKS</strong>
                    </div>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>SKS</th>
                                <th>Dosen</th>
                                <th>Jadwal</th>
                                <th>Ruangan</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT k.id_krs, mk.nama_mk, mk.sks, d.nama_dosen, 
                                    j.hari, j.jam_mulai, j.jam_selesai, j.ruangan, k.nilai
                                    FROM krs k
                                    JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                    JOIN mk ON j.id_mk = mk.id_mk
                                    JOIN dosen d ON j.id_dosen = d.id_dosen 
                                    WHERE k.nim = '$nim'
                                    ORDER BY mk.nama_mk";
                            $result = $conn->query($sql);
                            $nomor = 1;

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $waktu = $row['hari'] . ", " . substr($row['jam_mulai'], 0, 5) . " - " . substr($row['jam_selesai'], 0, 5);
                                    $nilai = $row['nilai'] ? $row['nilai'] : '<span class="text-muted">Belum ada</span>';
                                    
                                    echo "<tr>
                                        <td class='text-center'>$nomor</td>    
                                        <td><strong>{$row['nama_mk']}</strong></td>
                                        <td class='text-center'>{$row['sks']}</td>
                                        <td>{$row['nama_dosen']}</td>
                                        <td>{$waktu}</td>
                                        <td class='text-center'>{$row['ruangan']}</td>
                                        <td class='text-center fw-bold'>{$nilai}</td>
                                        <td class='text-center'>
                                            <a href='?hapus={$row['id_krs']}' 
                                               class='btn btn-danger btn-sm' 
                                               onclick='return confirm(\"Yakin ingin menghapus mata kuliah ini dari KRS?\")'>
                                                Hapus
                                            </a>
                                        </td>
                                    </tr>";
                                    $nomor++;
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>Belum ada KRS. Silakan tambah mata kuliah.</td></tr>";
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