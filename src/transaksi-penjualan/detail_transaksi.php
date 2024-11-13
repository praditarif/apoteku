<?php
// Include file koneksi database
include('../database/database.php');

// Cek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi ke database gagal!");
}

// Mendapatkan data transaksi berdasarkan ID (contoh menggunakan GET)
$id_transaksi = isset($_GET['id']) ? $_GET['id'] : 0;

// Query untuk mengambil data transaksi berdasarkan ID
$sql_transaksi = "SELECT t.*, p.nama_lengkap AS nama_pasien, d.Nama AS nama_dokter, k.Nama AS nama_apoteker
FROM transaksi t
JOIN pasien p ON t.ID_Pasien = p.ID_Pasien
JOIN dokter d ON t.ID_Dokter = d.ID_Dokter
JOIN karyawan k ON t.ID_Karyawan = k.ID_Karyawan
WHERE t.ID_Transaksi = '$id_transaksi'";
$result_transaksi = mysqli_query($conn, $sql_transaksi);
$data_transaksi = mysqli_fetch_assoc($result_transaksi);

// Query untuk mengambil detail obat dari transaksi
$sql_detail_obat = "SELECT o.Nama_Obat, d.Jumlah, d.Harga_Jual, (d.Jumlah * d.Harga_Jual) AS SubTotal
FROM detail_transaksi d
JOIN obat o ON d.ID_Obat = o.ID_Obat
WHERE d.ID_Transaksi = '$id_transaksi'";
$result_detail_obat = mysqli_query($conn, $sql_detail_obat);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi - Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6 text-blue-600">Detail Transaksi</h1>

        <!-- Informasi Pasien dan Dokter -->
        <?php if ($data_transaksi) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600"><span class="font-semibold">Nama Pasien:</span> <?= $data_transaksi['nama_pasien'] ?></p>
                <p class="text-gray-600"><span class="font-semibold">Nama Dokter:</span> <?= $data_transaksi['nama_dokter'] ?></p>
                <p class="text-gray-600"><span class="font-semibold">Nama Apoteker:</span> <?= $data_transaksi['nama_apoteker'] ?></p>
            </div>
        </div>
        <?php else: ?>
            <p>Data transaksi tidak ditemukan.</p>
        <?php endif; ?>

        <a href="transaksi_list.php" class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Kembali</a>
    </div>
</body>

</html>
