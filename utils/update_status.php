<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/utils/functions.php");

$sql = "SELECT * FROM pesanan_pulsa WHERE created_at >= NOW() - INTERVAL 1 DAY ORDER BY created_at DESC";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pesanan = $_POST['id_pesanan'];
    $status_pesanan = $_POST['status_pesanan'];
    $pesan_admin = $_POST['pesan_admin'];

    // Update status dan pesan admin pada pesanan
    $sql = "UPDATE pesanan_pulsa SET status_pesanan = ?, pesan_admin = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ssi", $status_pesanan, $pesan_admin, $id_pesanan);

    if ($stmt->execute()) {
        header("Location: /auth/dashboard.php?update=success");
        exit();
    } else {
        echo "Gagal memperbarui status pesanan.";
    }

    $stmt->close();
}
?>
