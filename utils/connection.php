<?php

$hostname = "127.0.0.1";
$username = "root";
$password = "";
$database = "pulsa";

$connection = mysqli_connect($hostname, $username, $password, $database);

// if (!$connection) {
//     die("Koneksi gagal: ");
// } else {
//     echo "Koneksi berhasil!";
// }

// Cek koneksi
// if ($connection->connect_error) {
//     die("Connection failed: " . $connection->connect_error);
// }

// Query untuk mengambil data yang lebih lama dari 1 menit
// $query = "SELECT * 
//           FROM pesanan_pulsa 
//           WHERE waktu_dibuat < NOW() - INTERVAL 1 MINUTE
//           ORDER BY waktu_dibuat DESC";

// $result = $connection->query($query);

// Cek apakah ada hasil
// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//         // Tampilkan data
//         echo "ID: " . $row["id"]. " - Waktu Dibuat: " . $row["waktu_dibuat"]. "<br>";
//     }
// } else {
//     echo "Tidak ada data yang lebih lama dari 1 menit.";
// }

// $connection->close();