<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");
$sql = "SELECT * FROM pesanan_pulsa WHERE created_at >= NOW() - INTERVAL 1 DAY ORDER BY created_at DESC";


if (!isset($_SESSION["login"])) {
    header("Location: /auth/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pembeli = $_SESSION['username'];
    $no_hp = $_POST['no_hp'];
    $provider = $_POST['provider'];
    $pesan = $_POST['pesan'];
    $metode = $_POST['metode'];
    $tanggal_bayar = null;

    if ($metode === 'warung') {
        $tanggal_bayar = $_POST['waktu_bayar'];
    }

    $stmt = $connection->prepare("INSERT INTO pesanan_pulsa (nama_pembeli, no_hp, provider, pesan, metode_pembayaran, tanggal_bayar, status_pesanan) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssssss", $nama_pembeli, $no_hp, $provider, $pesan, $metode, $tanggal_bayar);
    

    if ($stmt->execute()) {
        header("Location: /public/transaksi.php");
        exit();
    } else {
        echo "Gagal menyimpan pesanan: " . $stmt->error;
    }

    $stmt->close();
}
?>
