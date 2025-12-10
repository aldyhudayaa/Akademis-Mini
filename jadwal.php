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
                <a href="index.php" class="nav-link text-white">
                    Home
                </a>
            </li>
            <li>
                <a href="jadwal.php" class="nav-link text-white active" aria-current="page">
                    Jadwal
                </a>
            </li>
            <li>
                <a href="tabel.php"class="nav-link text-white">
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
            <h3 class="m-0">Tabel Jadwal Perkuliahan</h3>
        </header>
        
        <main class="p-4">
             <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah
            </button>
        <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Jadwal</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                            <div class="mb-3">
                                <label for="id_mk" class="form-label">Mata Kuliah:</label>
                                
                                <select class="form-select" id="id_mk" name="id_mk" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    
                                    <?php
                                    $sql_mk = "SELECT id_mk, nama_mk FROM mk ORDER BY nama_mk ASC";
                                    $result_mk = $conn->query($sql_mk);

                                    if ($result_mk->num_rows > 0) {
                                        while($row = $result_mk->fetch_assoc()) {
                                            echo "<option value='" . $row['id_mk'] . "'>" . $row['nama_mk'] . " (" . $row['id_mk'] . ")</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Data Mata Kuliah Kosong</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                                <div class="mb-3">
                                <label for="id_dosen" class="form-label">Dosen:</label>
                                
                                <select class="form-select" id="id_dosen" name="id_dosen" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    
                                    <?php
                                    $sql_dosen = "SELECT id_dosen, nama_dosen FROM dosen ORDER BY nama_dosen ASC";
                                    $result_dosen = $conn->query($sql_dosen);

                                    if ($result_dosen->num_rows > 0) {
                                        while($row = $result_dosen->fetch_assoc()) {
                                            echo "<option value='" . $row['id_dosen'] . "'>" . $row['nama_dosen'] . " (" . $row['id_dosen'] . ")</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Data Dosen Kosong</option>";
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="mb-3">
                                    <label for="hari" class="form-label">Hari:</label>
                                
                                <select class="form-select" id="hari" name="hari" required>
                                    <option value="">-- Pilih Hari --</option>
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai:</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai:</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                                </div>
                                <div class="mb-3">
                                    <label for="semester" class="form-label">Semester:</label>
                                    <input type="text" class="form-control" id="semester" name="semester" required>
                                </div>
                                <div class="mb-3">
                                    <label for="ruangan" class="form-label">Ruangan:</label>
                                    <input type="text" class="form-control" id="ruangan" name="ruangan" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

           <?php
if (isset($_POST['simpan'])) {
    $id_mk       = $_POST['id_mk'];
    $id_dosen    = $_POST['id_dosen'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $semester    = $_POST['semester'];
    $ruangan     = $_POST['ruangan'];

    if ($jam_mulai >= $jam_selesai) {
        echo "<script>alert('Gagal: Jam Selesai harus lebih akhir dari Jam Mulai!');</script>";
    } else {
        $query = "INSERT INTO jadwal (id_mk, id_dosen, hari, jam_mulai, jam_selesai, semester, ruangan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssss", $id_mk, $id_dosen, $hari, $jam_mulai, $jam_selesai, $semester, $ruangan);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Data Jadwal berhasil ditambah!');
                    window.location.href='jadwal.php';
                  </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        
        $stmt->close();
    }
}
?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr class="text-center align-middle">
                        <th style="width: 50px;">No</th>
                        <th style="width: 80px;">ID Jadwal</th>
                        <th style="width: 200px;">Mata Kuliah</th>
                        <th style="width: 150px;">Dosen</th>
                        <th style="width: 100px;">Hari</th>
                        <th style="width: 100px;">Jam Mulai</th>
                        <th style="width: 100px;">Jam Selesai</th>
                        <th style="width: 80px;">Semester</th>
                        <th style="width: 100px;">Ruangan</th>
                        <th style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query dengan JOIN untuk menampilkan nama mata kuliah dan nama dosen
                    $sql = "SELECT j.*, mk.nama_mk, d.nama_dosen 
                            FROM jadwal j
                            LEFT JOIN mk ON j.id_mk = mk.id_mk
                            LEFT JOIN dosen d ON j.id_dosen = d.id_dosen
                            ORDER BY j.id_jadwal ASC";
                    $result = $conn->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            // Format jam tanpa detik
                            $jam_mulai = substr($row['jam_mulai'], 0, 5);
                            $jam_selesai = substr($row['jam_selesai'], 0, 5);
                            
                            echo "<tr>
                                <td class='text-center'>{$nomor}</td>    
                                <td class='text-center'>{$row['id_jadwal']}</td>
                                <td>
                                    <strong>{$row['nama_mk']}</strong><br>
                                    <small class='text-muted'>ID: {$row['id_mk']}</small>
                                </td>
                                <td>
                                    {$row['nama_dosen']}<br>
                                    <small class='text-muted'>ID: {$row['id_dosen']}</small>
                                </td>
                                <td class='text-center'>{$row['hari']}</td>
                                <td class='text-center'>{$jam_mulai}</td>
                                <td class='text-center'>{$jam_selesai}</td>
                                <td class='text-center'>{$row['semester']}</td>
                                <td class='text-center'>
                                    <span class='badge bg-info text-dark'>{$row['ruangan']}</span>
                                </td>
                                <td class='text-center'>
                                    <a href='db/edit.php?id_jadwal={$row['id_jadwal']}' class='btn btn-warning btn-sm mb-1'>
                                        <small>Edit</small>
                                    </a>
                                    <a href='db/hapus.php?id_jadwal={$row['id_jadwal']}' class='btn btn-danger btn-sm mb-1' onclick='return confirm(\"Yakin ingin menghapus jadwal ini?\")'>
                                        <small>Hapus</small>
                                    </a>
                                </td>
                            </tr>";
                            $nomor++;
                        }
                    } else {
                        echo "<tr><td colspan='10' class='text-center text-muted'>Belum ada data jadwal</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        </main>
    </div>

</div>


</body>
</html>