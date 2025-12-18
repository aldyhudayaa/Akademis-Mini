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
                <a href="dosen_jadwal.php" class="nav-link text-white">
                    Jadwal Mengajar
                </a>
            </li>
            <li>
                <a href="dosen_nilai.php" class="nav-link text-white active bg-dark">
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

    <div class="flex-grow-1">
        <header class="bg-dark text-white p-3">
            <h3 class="m-0">Input Nilai Mahasiswa</h3>
        </header>
        
        <main class="p-4">
            <form method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Filter Mata Kuliah:</label>
                        <select name="id_jadwal" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Semua Mata Kuliah --</option>
                            <?php
                            $sql_jadwal = "SELECT j.id_jadwal, mk.nama_mk, j.hari, j.jam_mulai
                                          FROM jadwal j
                                          JOIN mk ON j.id_mk = mk.id_mk
                                          WHERE j.id_dosen='$id_dosen'
                                          ORDER BY mk.nama_mk";
                            $result_jadwal = $conn->query($sql_jadwal);
                            
                            while($row = $result_jadwal->fetch_assoc()){
                                $selected = (isset($_GET['id_jadwal']) && $_GET['id_jadwal'] == $row['id_jadwal']) ? 'selected' : '';
                                $waktu = $row['hari'] . " " . substr($row['jam_mulai'], 0, 5);
                                echo "<option value='{$row['id_jadwal']}' $selected>{$row['nama_mk']} ({$waktu})</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>

            <div class="card">
                <div class="card-header bg-warning">
                    <h5 class="mb-0">Daftar Mahasiswa</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Mata Kuliah</th>
                                <th>Nilai</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $where = "";
                            if(isset($_GET['id_jadwal']) && $_GET['id_jadwal'] != ''){
                                $id_jadwal_filter = $_GET['id_jadwal'];
                                $where = "AND k.id_jadwal = '$id_jadwal_filter'";
                            }
                            
                            $sql = "SELECT k.id_krs, k.nim, k.nilai, m.nama, mk.nama_mk, j.hari, j.jam_mulai
                                    FROM krs k
                                    JOIN mahasiswa m ON k.nim = m.nim
                                    JOIN jadwal j ON k.id_jadwal = j.id_jadwal
                                    JOIN mk ON j.id_mk = mk.id_mk
                                    WHERE j.id_dosen = '$id_dosen'
                                    $where
                                    ORDER BY mk.nama_mk, m.nama";
                            $result = $conn->query($sql);
                            $nomor = 1;

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $waktu = $row['hari'] . " " . substr($row['jam_mulai'], 0, 5);
                                    echo "<tr>
                                        <td class='text-center'>$nomor</td>
                                        <td class='text-center'>{$row['nim']}</td>
                                        <td>{$row['nama']}</td>
                                        <td>{$row['nama_mk']}<br><small class='text-muted'>$waktu</small></td>
                                        <td class ='text-center'>{$row['nilai']}</td>";
                                                    
                                    $grades = ['A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'D', 'E'];
                                    foreach($grades as $grade){
                                        $selected = ($row['nilai'] == $grade) ? 'selected' : '';
                                        ;
                                    }
                                    
                                    echo "</select>
                                                <button type='submit' name='update_nilai' class='btn btn-sm btn-warning d-none'>Update</button>
                                            </form>
                                        </td>
                                        <td class='text-center'>
                                            <button type='button' class='btn btn-sm btn-info' 
                                                    data-bs-toggle='modal' 
                                                    data-bs-target='#modalEdit{$row['id_krs']}'>
                                                Edit
                                            </button>
                                        </td>
                                    </tr>";
                                    
                                    // Modal Edit
                                    echo "<div class='modal fade' id='modalEdit{$row['id_krs']}'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content'>
                                                    <div class='modal-header'>
                                                        <h5 class='modal-title'>Edit Nilai</h5>
                                                        <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                                    </div>
                                                    <form method='POST'>
                                                        <div class='modal-body'>
                                                            <input type='hidden' name='id_krs' value='{$row['id_krs']}'>
                                                            <div class='mb-3'>
                                                                <label class='form-label'>Mahasiswa:</label>
                                                                <p class='fw-bold'>{$row['nama']} ({$row['nim']})</p>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label class='form-label'>Mata Kuliah:</label>
                                                                <p class='fw-bold'>{$row['nama_mk']}</p>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label for='nilai' class='form-label'>Nilai:</label>
                                                                <select name='nilai' class='form-select' required>
                                                                    <option value=''>-- Pilih Nilai --</option>";
                                    
                                    foreach($grades as $grade){
                                        $selected = ($row['nilai'] == $grade) ? 'selected' : '';
                                        echo "<option value='$grade' $selected>$grade</option>";
                                    }
                                    
                                    echo "</select>
                                                            </div>
                                                        </div>
                                                        <div class='modal-footer'>
                                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Batal</button>
                                                            <button type='submit' name='update_nilai' class='btn btn-primary'>Simpan Nilai</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>";
                                    
                                    $nomor++;
                                }
                            } else {
                                echo "<tr><td colspan='6' class='text-center'>Tidak ada data mahasiswa</td></tr>";
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