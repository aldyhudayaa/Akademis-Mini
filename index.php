<?php 
include 'check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>SIGANDUM</title>
</head>

<body> 
<?php  
include 'koneksi.php';
?>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-success text-white" style="width: 250px; min-height: 100vh;">
        <h4 class="mb-3">SIGANDUM</h4>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="index.php" class="nav-link text-white active" aria-current="page">
                    Home
                </a>
            </li>
            <li>
                <a href="jadwal.php" class="nav-link text-white">
                    Jadwal
                </a>
            </li>
            <li>
                <a href="tabel.php" class="nav-link text-white">
                    Data Mahasiswa
                </a>
            </li>
            <li>
                <a href="dosen.php" class="nav-link text-white">
                    Data Dosen
                </a>
            </li>
            <li>
                <a href="mk.php" class="nav-link text-white">
                    Mata Kuliah
                </a>
            </li>
        </ul>
        <hr>
        <div>
            <button type="button" class="btn btn-danger" id="logout">Logout</button>

            <script>
                const button = document.getElementById('logout');
                button.addEventListener('click', function() {
                    if (confirm('Yakin ingin keluar?')) {
                        window.location.href = 'logout.php'; 
                    }
                });
            </script>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <header class="bg-dark text-white p-3">
            <h3 class="m-0">Sistem Akademis</h3>
        </header>
        
        <main>
            <section>
                <h1 class="text-center" style="font">DASHBOARD SIGANDUM</h1>
                <br><br>
                <h3 class="text-center" style="text-white">EDIT KRS</h2>
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah
            </button>
                <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data KRS</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                <label for="nim" class="form-label">Pilih NIM:</label>
                                
                                <select class="form-select" id="nim" name="nim" required>
                                    <option value="">-- Pilih Mahasiswa --</option>
                                    
                                    <?php
                                    // 1. Query Data
                                    $sql_nim = "SELECT nim, nama FROM mahasiswa ORDER BY nama ASC";
                                    $result_nim = $conn->query($sql_nim);

                                    // 2. Cek apakah ada data
                                    if ($result_nim->num_rows > 0) {
                                        // 3. Looping data menjadi option
                                        while($row = $result_nim->fetch_assoc()) {
                                            echo "<option value='" . $row['nim'] . "'>" . $row['nama'] . " (" . $row['nim'] . ")</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Data Mata Kuliah Kosong</option>";
                                    }
                                    ?>
                                </select>
                                </div>

                                <div class="mb-3">
                                <label for="id_jadwal" class="form-label">Pilih jadwal:</label>
                                
                                <select class="form-select" id="id_jadwal" name="id_jadwal" required>
                                    <option value="">-- Pilih Jadwal --</option>
                                    
                                    <?php
                                    $sql_jadwal = "SELECT id_jadwal FROM jadwal";
                                    $result_jadwal = $conn->query($sql_jadwal);

                                    if ($result_jadwal->num_rows > 0) {

                                        while($row = $result_jadwal->fetch_assoc()) {
                                            echo "<option value='" . $row['id_jadwal'] . "'>" . $row['id_jadwal'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Data Mata Kuliah Kosong</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                                <div>
                                    <label for="nilai" class="form-label">Input nilai:</label>
                                    <input type="text" class="form-control" id="nilai" name="nilai" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_POST['simpan'])){
                $nim = $_POST['nim'];
                $id_jadwal = $_POST['id_jadwal'];
                $nilai = $_POST['nilai'];

                $query = "INSERT INTO krs (nim, id_jadwal, nilai) VALUES ('$nim', '$id_jadwal', '$nilai')";
                
                if ($conn->query($query) === TRUE) {
                    echo "<script>alert('Data berhasil ditambah!');</script>";
                }
            }
            ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>ID KRS</th>
                        <th>NIM</th>
                        <th>ID Jadwal</th>
                        <th>Nilai</th>
                        <th>Edit/Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM krs";
                    $result = $conn->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>$nomor</td>    
                                <td>$row[id_krs]</td>
                                <td>$row[nim]</td>
                                <td>$row[id_jadwal]</td>
                                <td>$row[nilai]</td>
                                <td>
                                    <a href='db/hapus.php?id_krs=$row[id_krs]' class='btn btn-danger btn-sm'>Hapus</a>
                                    <a href='db/edit.php?id_krs=$row[id_krs]' class='btn btn-warning btn-sm'>Edit</a>
                                </td>
                            </tr>";
                            $nomor++;
                        }
                    }
                    ?>
                </tbody>
            </table>
            <br><br>
            
            
            <h3 class="text-center" style="text-white">CETAK KRS</h2>

            <form action="" method="GET" class="row g-3 align-items-end mb-4">            
            <div class="col-auto">
                <label for="nim" class="form-label fw-bold">Pilih Mahasiswa:</label>
                <select class="form-select" id="nim" name="nim" required>
                    <option value="">-- Pilih Mahasiswa --</option>
                    <?php
                    $sql_nim = "SELECT nim, nama FROM mahasiswa ORDER BY nama ASC";
                    $result_nim = $conn->query($sql_nim);
                    // Menangkap NIM yang sedang dipilih agar dropdown tidak reset
                    $selected_nim = isset($_GET['nim']) ? $_GET['nim'] : '';

                    if ($result_nim->num_rows > 0) {
                        while($row = $result_nim->fetch_assoc()) {
                            // Logika agar opsi tetap terpilih setelah submit
                            $selected = ($row['nim'] == $selected_nim) ? 'selected' : '';
                            echo "<option value='" . $row['nim'] . "' $selected>" . $row['nama'] . " (" . $row['nim'] . ")</option>";
                        }
                    }
                    ?>
                     </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Lihat KRS</button>
        <a href="index.php" class="btn btn-secondary">Reset</a>
    </div>
</form>  

<table class="table table-bordered table-striped">
    <thead>
        <tr class="text-center">
            <th>No</th>
            <th>Mata Kuliah</th> 
            <th>Dosen</th>
            <th>Waktu & Ruangan</th>
            <th>Nilai</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Perbaikan: Cek dulu apakah user sudah memilih NIM?
        if (isset($_GET['nim']) && $_GET['nim'] != '') {
            
            $nim = $_GET['nim']; // Ambil data dari URL

            $sql_cetak = "SELECT 
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

            $result_cetak = $conn->query($sql_cetak);
            $nomor = 1;

            if ($result_cetak && $result_cetak->num_rows > 0) {
                while($row = $result_cetak->fetch_assoc()) {
                    $waktu = $row['hari'] . ", " . substr($row['jam_mulai'], 0, 5) . "-" . substr($row['jam_selesai'], 0, 5);
                    
                    // Mencegah error jika kolom SKS belum ada
                    $sks = isset($row['sks']) ? $row['sks'] : '-';

                    echo "<tr>
                            <td class='text-center'>$nomor</td>    
                            <td>
                                <strong>{$row['nama_mk']}</strong><br>
                                <small class='text-muted'>{$sks} SKS</small>
                            </td>
                            <td>{$row['nama_dosen']}</td>
                            <td>
                                {$waktu} <br> 
                                <span class='badge bg-info text-dark'>{$row['ruangan']}</span>
                            </td>
                            <td class='text-center fw-bold'>{$row['nilai']}</td>
                        </tr>";
                    $nomor++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center text-danger'>Mahasiswa ini belum mengambil KRS (Data Kosong).</td></tr>";
            }
        } else {
            // Pesan jika belum memilih
            echo "<tr><td colspan='5' class='text-center'>Silakan pilih mahasiswa dan klik tombol 'Lihat KRS'.</td></tr>";
        }
        ?>
    </tbody>
</table>
                </section>
            </main>
        </div>

</div>


</body>
</html>