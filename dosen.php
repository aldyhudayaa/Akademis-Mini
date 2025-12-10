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
                <a href="tabel.php"class="nav-link text-white">
                    Data Mahasiswa
                </a>
            </li>
            <li>
                <a href="dosen.php" class="nav-link text-white active" aria-current="page">
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
            <h3 class="m-0">Data Dosen</h3>
        </header>
        
        <main class="p-4">
            
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#myModal">
                Tambah
            </button>
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
                                    <label for="id_dosen" class="form-label">ID dosen</label>
                                    <input type="text" class="form-control" id="id_dosen" name="id_dosen" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nama_dosen" class="form-label">Nama dosen</label>
                                    <input type="text" class="form-control" id="nama-dosen" name="nama_dosen" required>
                                </div>
                                <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_POST['simpan'])){
                $id = $_POST['id_dosen'];
                $nama = $_POST['nama_dosen'];
                
                $query = "INSERT INTO dosen (id_dosen, nama_dosen) VALUES ('$id', '$nama')";
                
                if ($conn->query($query) === TRUE) {
                    echo "<script>alert('Data berhasil ditambah!');</script>";
                }
            }
            ?>
        <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>ID</th>
                        <th>Nama dosen</th>
                        <th>Edit/Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM dosen";
                    $result = $conn->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>$nomor</td>    
                                <td>$row[id_dosen]</td>
                                <td>$row[nama_dosen]</td>
                                <td>
                                    <a href='db/hapus.php?id_dosen=$row[id_dosen]' class='btn btn-danger btn-sm'>Hapus</a>
                                    <a href='db/edit.php?nim=$row[id_dosen]' class='btn btn-warning btn-sm'>Edit</a>
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