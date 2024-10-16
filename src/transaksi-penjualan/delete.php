<?php
include('../../src/database/database.php'); // Sesuaikan path ini sesuai dengan struktur folder Anda

if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Pastikan ID valid dan aman dari SQL injection
    $id_transaksi = mysqli_real_escape_string($conn, $id_transaksi);

    // Query untuk menghapus transaksi
    $sql = "DELETE FROM transaksi WHERE ID_Transaksi = '$id_transaksi'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "<script>alert('ID transaksi tidak valid!'); window.location.href='index.php';</script>";
}

mysqli_close($conn);
?>
