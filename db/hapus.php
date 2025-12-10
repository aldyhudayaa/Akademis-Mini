<?php
include '../koneksi.php';
include '../dosen.php';

if (isset($_GET['nim'])){
    $nim = $_GET['nim'];

    $sql = "DELETE FROM mahasiswa WHERE nim = '$nim'";
    if ($conn->query($sql) === TRUE) {
   echo "<script>
                alert('Data berhasil diubah!');
                window.location.href='../tabel.php';
              </script>";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
} 

if (isset($_GET['id_dosen'])){
    $id_dosen = $_GET['id_dosen'];
    $sql = "DELETE FROM dosen WHERE id_dosen = '$id_dosen'";
    if ($conn->query($sql) === TRUE) {
   echo "<script>
                alert('Data berhasil diubah!');
                window.location.href='../dosen.php';
              </script>";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_GET['id_mk'])){
    $id_mk = $_GET['id_mk'];
    $sql = "DELETE FROM mk WHERE id_mk = '$id_mk'";
    if ($conn->query($sql) === TRUE) {
   echo "<script>
                alert('Data berhasil diubah!');
                window.location.href='../mk.php';
              </script>";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}

if (isset($_GET['id_jadwal'])){
    $id_jadwal = $_GET['id_jadwal'];
    $sql = "DELETE FROM jadwal WHERE id_jadwal = '$id_jadwal'";
    if ($conn->query($sql) === TRUE) {
   echo "<script>
                alert('Data berhasil diubah!');
                window.location.href='../jadwal.php';
              </script>";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}
?>