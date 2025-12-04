<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mahasiswa_web";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "";
<<<<<<< HEAD
?>
=======
?>
>>>>>>> f434f1665c52974f529e6f558de0974bc5f1ec8d
