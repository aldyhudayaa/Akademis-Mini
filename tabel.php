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
<?php include 'koneksi.php'; ?>

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
                <a href="jadwal.php" class="nav-link text-white">
                    Jadwal
                </a>
            </li>
            <li>
                <a href="tabel.php" class="nav-link text-white active" aria-current="page">
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
            <h3 class="m-0">Data Mahasiswa</h3>
        </header>
        
        <main class="p-5">
            <!-- Button Tambah -->
            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah
            </button>
            
            <!-- Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Data Mahasiswa</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nim" class="form-label">NIM</label>
                                    <input type="text" class="form-control" id="nim" name="nim" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_POST['simpan'])){
                $nama = $_POST['nama'];
                $nim = $_POST['nim'];
                
                $query = "INSERT INTO mahasiswa (nama, nim) VALUES ('$nama', '$nim')";
                
                if ($conn->query($query) === TRUE) {
                    echo "<script>alert('Data berhasil ditambah!');</script>";
                }
            }
            ?>

            <!-- Tabel -->
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM mahasiswa";
                    $result = $conn->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>$nomor</td>    
                                <td>$row[nama]</td>
                                <td>$row[nim]</td>
                                <td>
                                    <a href='db/hapus.php?nim=$row[nim]' class='btn btn-danger btn-sm'>Hapus</a>
                                    <a href='db/edit.php?nim=$row[nim]' class='btn btn-warning btn-sm'>Edit</a>
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