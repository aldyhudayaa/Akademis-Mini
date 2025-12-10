<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Data Mahasiswa</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<?php
include '../koneksi.php';

if(isset($_GET['nim'])){
    $nim_dari_url = $_GET['nim'];
    
    $sql_ambil = "SELECT * FROM mahasiswa WHERE nim = '$nim_dari_url'";
    $result = $conn->query($sql_ambil);
    $data_lama = $result->fetch_assoc();
}
?>

<div class="container mt-5">
  <div class="card">
    <div class="card-header bg-important">
        <h4>Edit Data Mahasiswa</h4>
    </div>
    <div class="card-body">
        
        <form action="" method="POST">
            
            <input type="hidden" name="nim_lama" value="<?php echo $data_lama['nim']; ?>">

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" 
                       value="<?php echo $data_lama['nama']; ?>">
            </div>
            
            <div class="mb-3">
                <label for="nim" class="form-label">NIM</label>
                <input type="text" class="form-control" id="nim" name="nim" 
                       value="<?php echo $data_lama['nim']; ?>">
            </div>

            <button type="submit" class="btn btn-info" name="update">Simpan Perubahan</button>
            <a href="../tabel.php" class="btn btn-secondary">Batal</a>
        </form>
    </div>
  </div>
</div>

<?php
// PROSES UPDATE DATA
if(isset($_POST['update'])){
    
    // Tangkap data dari form
    $nim_lama = $_POST['nim_lama']; // Kunci rahasia tadi
    $nim_baru = $_POST['nim'];
    $nama     = $_POST['nama'];
    

    $query = "UPDATE mahasiswa SET nim='$nim_baru', nama='$nama' WHERE nim='$nim_lama'";

    if ($conn->query($query) === TRUE) {
        // Redirect otomatis kembali ke tabel setelah sukses
        echo "<script>
                alert('Data berhasil diubah!');
                window.location.href='../tabel.php';
              </script>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
?>

</body>
</html>