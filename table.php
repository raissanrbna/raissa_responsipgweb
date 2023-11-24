<?php
// Sesuaikan dengan setting MySQL
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
$sql = "SELECT * FROM wisata";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
echo "<table border='1px'><tr><th>nama_wisata</th><th>harga_tiket</th><th>jam_buka</th><th>jam_tutup</th><th>longitude</th><th>latitude</th>";

// output data of each row
while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["nama_wisata"]."</td>
    <td>".$row["harga_tiket"]."</td>
    <td>".$row["jam_buka"]."</td>
    <td>".$row["jam_tutup"]."</td>
    <td>".$row["longitude"]."</td>
    <td align='right'>".$row["latitude"]."</td></tr>";
}
echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>
