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
            <p class="mb-0">Admin: Aldy & Dafi</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">
        <header class="bg-dark text-white p-3">
            <h3 class="m-0">Sistem Akademis</h3>
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
                                <label for="id_mk" class="form-label">ID MK:</label>
                                
                                <select class="form-select" id="id_mk" name="id_mk" required>
                                    <option value="">-- Pilih Mata Kuliah --</option>
                                    
                                    <?php
                                    // 1. Query Data
                                    $sql_mk = "SELECT id_mk, nama_mk FROM mk ORDER BY nama_mk ASC";
                                    $result_mk = $conn->query($sql_mk);

                                    // 2. Cek apakah ada data
                                    if ($result_mk->num_rows > 0) {
                                        // 3. Looping data menjadi option
                                        while($row = $result_mk->fetch_assoc()) {
                                            // value="..." adalah data yang masuk ke database (ID)
                                            // Text di antara >...< adalah yang dilihat user (Nama MK)
                                            echo "<option value='" . $row['id_mk'] . "'>" . $row['nama_mk'] . " (" . $row['id_mk'] . ")</option>";
                                        }
                                    } else {
                                        echo "<option value=''>Data Mata Kuliah Kosong</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                                <div class="mb-3">
                                <label for="id_dosen" class="form-label">ID dosen:</label>
                                
                                <select class="form-select" id="id_dosen" name="id_dosen" required>
                                    <option value="">-- Pilih Dosen --</option>
                                    
                                    <?php
                                    // 1. Query Data
                                    $sql_dosen = "SELECT id_dosen, nama_dosen FROM dosen ORDER BY nama_dosen ASC";
                                    $result_dosen = $conn->query($sql_dosen);

                                    // 2. Cek apakah ada data
                                    if ($result_dosen->num_rows > 0) {
                                        // 3. Looping data menjadi option
                                        while($row = $result_dosen->fetch_assoc()) {
                                            // value="..." adalah data yang masuk ke database (ID)
                                            // Text di antara >...< adalah yang dilihat user (Nama MK)
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
                                    <option>Senin</option>
                                    <option>Selasa</option>
                                    <option>Rabu</option>
                                    <option>Kamis</option>
                                    <option>Jumat</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_mulai" class="form-label">Jam Mulai (24H):</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_selesai" class="form-label">Jam Selesai (24H):</label>
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
    // 1. Tangkap semua input dari Form dengan benar
    $id_mk       = $_POST['id_mk'];
    $id_dosen    = $_POST['id_dosen'];
    $hari        = $_POST['hari'];
    $jam_mulai   = $_POST['jam_mulai'];
    $jam_selesai = $_POST['jam_selesai'];
    $semester    = $_POST['semester'];
    $ruangan     = $_POST['ruangan'];

    // 2. Validasi Logika Sederhana (Sparring Partner)
    // Mencegah jam selesai lebih awal dari jam mulai
    if ($jam_mulai >= $jam_selesai) {
        echo "<script>alert('Gagal: Jam Selesai harus lebih akhir dari Jam Mulai!');</script>";
    } else {
        // 3. Query Insert menggunakan Prepared Statement (Aman)
        // Catatan: Kolom 'kuota' saya hapus dari sini agar otomatis mengikuti Default Database (40)
        $query = "INSERT INTO jadwal (id_mk, id_dosen, hari, jam_mulai, jam_selesai, semester, ruangan) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($query);
        
        // "sssssss" artinya semua 7 variabel dianggap string (aman untuk varchar & time)
        $stmt->bind_param("sssssss", $id_mk, $id_dosen, $hari, $jam_mulai, $jam_selesai, $semester, $ruangan);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Data Jadwal berhasil ditambah!');
                    window.location.href='jadwal.php'; // Ganti dengan nama file halaman ini (refresh)
                  </script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        
        $stmt->close();
    }
}
?>
        <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>ID jadwal</th>
                        <th>ID MK</th>
                        <th>ID dosen</th>
                        <th>Hari</th>
                        <th>Jam mulai</th>
                        <th>Jam selesai</th>
                        <th>Semester</th>
                        <th>Ruangan</th>
                        <th>Edit/Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM jadwal";
                    $result = $conn->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>$nomor</td>    
                                <td>$row[id_jadwal]</td>
                                <td>$row[id_mk]</td>
                                <td>$row[id_dosen]</td>
                                <td>$row[hari]</td>
                                <td>$row[jam_mulai]</td>
                                <td>$row[jam_selesai]</td>
                                <td>$row[semester]</td>
                                <td>$row[ruangan]</td>
                                <td>
                                    <a href='db/hapus.php?id_jadwal=$row[id_jadwal]' class='btn btn-danger btn-sm'>Hapus</a>
                                    <a href='db/edit.php?id_jadwal=$row[id_jadwal]' class='btn btn-warning btn-sm'>Edit</a>
                                </td>
                            </tr>";
                            $nomor++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </main>
    </div>

</div>


</body>
</html>