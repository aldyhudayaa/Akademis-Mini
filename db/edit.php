<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Data - SIGANDUM</title>
</head>
<body>
<?php
include '../koneksi.php';

// EDIT MAHASISWA
if(isset($_GET['nim'])){
    $nim = $_GET['nim'];
    $sql = "SELECT * FROM mahasiswa WHERE nim='$nim'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>Edit Data Mahasiswa</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="nim_lama" value="<?php echo $data['nim']; ?>">
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" name="nim" value="<?php echo $data['nim']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo $data['nama']; ?>" required>
                    </div>
                    
                    <button type="submit" name="update_mhs" class="btn btn-success">Update</button>
                    <a href="../tabel.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['update_mhs'])){
        $nim_lama = $_POST['nim_lama'];
        $nim_baru = $_POST['nim'];
        $nama = $_POST['nama'];
        
        $query = "UPDATE mahasiswa SET nim='$nim_baru', nama='$nama' WHERE nim='$nim_lama'";
        
        if($conn->query($query) === TRUE){
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='../tabel.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// EDIT DOSEN
elseif(isset($_GET['id_dosen'])){
    $id_dosen = $_GET['id_dosen'];
    $sql = "SELECT * FROM dosen WHERE id_dosen='$id_dosen'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Edit Data Dosen</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_dosen_lama" value="<?php echo $data['id_dosen']; ?>">
                    
                    <div class="mb-3">
                        <label for="id_dosen" class="form-label">ID Dosen</label>
                        <input type="text" class="form-control" name="id_dosen" value="<?php echo $data['id_dosen']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama_dosen" value="<?php echo $data['nama_dosen']; ?>" required>
                    </div>
                    
                    <button type="submit" name="update_dosen" class="btn btn-success">Update</button>
                    <a href="../dosen.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['update_dosen'])){
        $id_dosen_lama = $_POST['id_dosen_lama'];
        $id_dosen_baru = $_POST['id_dosen'];
        $nama_dosen = $_POST['nama_dosen'];
        
        $query = "UPDATE dosen SET id_dosen='$id_dosen_baru', nama_dosen='$nama_dosen' WHERE id_dosen='$id_dosen_lama'";
        
        if($conn->query($query) === TRUE){
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='../dosen.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// EDIT MATA KULIAH
elseif(isset($_GET['id_mk'])){
    $id_mk = $_GET['id_mk'];
    $sql = "SELECT * FROM mk WHERE id_mk='$id_mk'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4>Edit Data Mata Kuliah</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_mk_lama" value="<?php echo $data['id_mk']; ?>">
                    
                    <div class="mb-3">
                        <label for="id_mk" class="form-label">ID Mata Kuliah</label>
                        <input type="text" class="form-control" name="id_mk" value="<?php echo $data['id_mk']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama_mk" class="form-label">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" name="nama_mk" value="<?php echo $data['nama_mk']; ?>" required>
                    </div>
                    
                    <button type="submit" name="update_mk" class="btn btn-success">Update</button>
                    <a href="../mk.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['update_mk'])){
        $id_mk_lama = $_POST['id_mk_lama'];
        $id_mk_baru = $_POST['id_mk'];
        $nama_mk = $_POST['nama_mk'];
        
        $query = "UPDATE mk SET id_mk='$id_mk_baru', nama_mk='$nama_mk' WHERE id_mk='$id_mk_lama'";
        
        if($conn->query($query) === TRUE){
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='../mk.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// EDIT JADWAL
elseif(isset($_GET['id_jadwal'])){
    $id_jadwal = $_GET['id_jadwal'];
    $sql = "SELECT * FROM jadwal WHERE id_jadwal='$id_jadwal'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h4>Edit Data Jadwal</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_jadwal" value="<?php echo $data['id_jadwal']; ?>">
                    
                    <div class="mb-3">
                        <label for="id_mk" class="form-label">Mata Kuliah</label>
                        <select class="form-select" name="id_mk" required>
                            <?php
                            $sql_mk = "SELECT * FROM mk";
                            $result_mk = $conn->query($sql_mk);
                            while($mk = $result_mk->fetch_assoc()){
                                $selected = ($mk['id_mk'] == $data['id_mk']) ? 'selected' : '';
                                echo "<option value='{$mk['id_mk']}' $selected>{$mk['nama_mk']} ({$mk['id_mk']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="id_dosen" class="form-label">Dosen</label>
                        <select class="form-select" name="id_dosen" required>
                            <?php
                            $sql_dosen = "SELECT * FROM dosen";
                            $result_dosen = $conn->query($sql_dosen);
                            while($dosen = $result_dosen->fetch_assoc()){
                                $selected = ($dosen['id_dosen'] == $data['id_dosen']) ? 'selected' : '';
                                echo "<option value='{$dosen['id_dosen']}' $selected>{$dosen['nama_dosen']} ({$dosen['id_dosen']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select class="form-select" name="hari" required>
                            <?php
                            $hari_list = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                            foreach($hari_list as $h){
                                $selected = ($h == $data['hari']) ? 'selected' : '';
                                echo "<option value='$h' $selected>$h</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jam_mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" name="jam_mulai" value="<?php echo $data['jam_mulai']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jam_selesai" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" name="jam_selesai" value="<?php echo $data['jam_selesai']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="semester" class="form-label">Semester</label>
                        <input type="text" class="form-control" name="semester" value="<?php echo $data['semester']; ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="ruangan" class="form-label">Ruangan</label>
                        <input type="text" class="form-control" name="ruangan" value="<?php echo $data['ruangan']; ?>" required>
                    </div>
                    
                    <button type="submit" name="update_jadwal" class="btn btn-success">Update</button>
                    <a href="../jadwal.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['update_jadwal'])){
        $id_jadwal = $_POST['id_jadwal'];
        $id_mk = $_POST['id_mk'];
        $id_dosen = $_POST['id_dosen'];
        $hari = $_POST['hari'];
        $jam_mulai = $_POST['jam_mulai'];
        $jam_selesai = $_POST['jam_selesai'];
        $semester = $_POST['semester'];
        $ruangan = $_POST['ruangan'];
        
        $query = "UPDATE jadwal SET id_mk='$id_mk', id_dosen='$id_dosen', hari='$hari', 
                  jam_mulai='$jam_mulai', jam_selesai='$jam_selesai', semester='$semester', 
                  ruangan='$ruangan' WHERE id_jadwal='$id_jadwal'";
        
        if($conn->query($query) === TRUE){
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='../jadwal.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

// EDIT KRS
elseif(isset($_GET['id_krs'])){
    $id_krs = $_GET['id_krs'];
    $sql = "SELECT * FROM krs WHERE id_krs='$id_krs'";
    $result = $conn->query($sql);
    $data = $result->fetch_assoc();
    ?>
    
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h4>Edit Data KRS</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <input type="hidden" name="id_krs" value="<?php echo $data['id_krs']; ?>">
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">Mahasiswa</label>
                        <select class="form-select" name="nim" required>
                            <?php
                            $sql_mhs = "SELECT * FROM mahasiswa";
                            $result_mhs = $conn->query($sql_mhs);
                            while($mhs = $result_mhs->fetch_assoc()){
                                $selected = ($mhs['nim'] == $data['nim']) ? 'selected' : '';
                                echo "<option value='{$mhs['nim']}' $selected>{$mhs['nama']} ({$mhs['nim']})</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="id_jadwal" class="form-label">Jadwal</label>
                        <select class="form-select" name="id_jadwal" required>
                            <?php
                            $sql_jadwal = "SELECT * FROM jadwal";
                            $result_jadwal = $conn->query($sql_jadwal);
                            while($jadwal = $result_jadwal->fetch_assoc()){
                                $selected = ($jadwal['id_jadwal'] == $data['id_jadwal']) ? 'selected' : '';
                                echo "<option value='{$jadwal['id_jadwal']}' $selected>ID: {$jadwal['id_jadwal']} - {$jadwal['hari']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nilai" class="form-label">Nilai</label>
                        <input type="text" class="form-control" name="nilai" value="<?php echo $data['nilai']; ?>" required>
                    </div>
                    
                    <button type="submit" name="update_krs" class="btn btn-success">Update</button>
                    <a href="../index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_POST['update_krs'])){
        $id_krs = $_POST['id_krs'];
        $nim = $_POST['nim'];
        $id_jadwal = $_POST['id_jadwal'];
        $nilai = $_POST['nilai'];
        
        $query = "UPDATE krs SET nim='$nim', id_jadwal='$id_jadwal', nilai='$nilai' WHERE id_krs='$id_krs'";
        
        if($conn->query($query) === TRUE){
            echo "<script>alert('Data berhasil diupdate!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }
}

else {
    echo "<div class='container mt-5'>
            <div class='alert alert-warning'>
                <h4>Error!</h4>
                <p>Parameter tidak valid. Silakan kembali ke halaman sebelumnya.</p>
            </div>
          </div>";
}
?>

</body>
</html>