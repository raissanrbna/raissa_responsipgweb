<?php
$nama_wisata = $_POST['nama_wisata'];
$harga_tiket= $_POST['harga_tiket'];
$jam_buka= $_POST['jam_buka'];
$jam_tutup= $_POST['jam_tutup'];
$longitude = $_POST['longitude'];
$latitude = $_POST['latitude'];

//Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "latihan";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO wisata (nama_wisata, harga_tiket, jam_buka, jam_tutup, longitude, latitude)
VALUES ('$nama_wisata', '$harga_tiket', '$jam_buka', '$jam_tutup','$longitude', '$latitude')";
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
 echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
//header("Location: index.html");
//exit;
?>