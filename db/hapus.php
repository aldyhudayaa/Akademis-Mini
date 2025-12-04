<?php
include '../koneksi.php';
    $nim = $_GET['nim'];
    $sql = "DELETE FROM mahasiswa WHERE nim = '$nim'";
if (isset($_GET['nim'])){
    
    if ($conn->query($sql) === TRUE) {
   echo "<script>
                alert('Data berhasil diubah!');
                window.location.href='../tabel.php';
              </script>";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
} 
?>