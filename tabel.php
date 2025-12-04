<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Web Aldy</title>
    <link rel="stylesheet" href="style.css">
    
    
</head>
<body>
    <header>
        <nav >
            <a :hover href="index.php">home</a>
            <a :hover href="tabel.php" >Tabel</a>
        </nav>   
    </header>

    <main>
        <?php
        include 'koneksi.php';
        ?>
<section>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
        Tambah
        </button>
        
        <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Heading</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
            <form action="" method="POST">
            <div class="mb-3 mt-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">NIM:</label>
                <input type="text" class="form-control" id="NIM" placeholder="Masukkan NIM" name="nim">
            </div>

            <div class="mb -3 mt-3">
                <label for="pwd" class="form-label">Jenis Kelamin:</label>
                <input class="form-control" id="jk" placeholder="Masukkan jenis kelamin" name="jk">
            </div>

            <button type="submit" class="btn btn-primary" name="simpan">Submit</button>
            </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

            </div>
        </div>
        </div>
</section>
        <section>
            <?php
        if(isset($_POST['simpan'])){
            
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $jk = $_POST['jk'];

        
        $query = "INSERT INTO mahasiswa (nama, nim, jk)
        VALUES ('$nama', '$nim', '$jk')";

        if ($conn->query($query) === TRUE) {
            echo "<script>
                alert('Data berhasil dihapus!');
              </script>";
        }
            
        }
            
        ?>
        </section>
        
        <div class="container mt-3">          
            <table class="table table-bordered">
                <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Jenis Kelamin</th>
                    <th>Edit/Hapus</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT *from mahasiswa";
                    $result = $conn->query($sql);
                    $nomor = 1;

                    if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo"
                <tr>
                <td>$nomor</td>    
                <td>$row[nama]</td>
                <td>$row[nim]</td>
                <td>$row[jk]</td>
                <td>
                <a href='db/hapus.php?nim=$row[nim]'   class='btn btn-danger'>hapus</a>
                <a href='db/edit.php?nim=$row[nim]'   class='btn btn-warning'>edit</a>
                </td>
                </tr>"; $nomor++;
                
  }}
                ?>
                </tbody>
            </table>
         </div>

    </main>
    <footer style="position:fixed;  ">
    <p >Made by Muhammad Aldy Hudaya 2025</p>
</footer>
</body>
</html>