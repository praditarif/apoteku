<?php
include('../../src/database/database.php'); // Sesuaikan path ini sesuai dengan struktur folder Anda

// Cek apakah ID diterima dari URL
if (isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];

    // Sanitasi ID untuk mencegah SQL injection
    $id_transaksi = mysqli_real_escape_string($conn, $id_transaksi);

    // Query untuk mengambil data transaksi berdasarkan ID
    $sql = "SELECT t.ID_Transaksi, t.ID_Karyawan, t.ID_Pasien, t.Tanggal_Transaksi, t.Total_Harga, t.Total_Bayar, t.Kembali, t.Sumber_Pembayaran
            FROM transaksi t
            WHERE t.ID_Transaksi = '$id_transaksi'";

    $result = mysqli_query($conn, $sql);
    $transaksi = mysqli_fetch_assoc($result);

    // Jika transaksi tidak ditemukan
    if (!$transaksi) {
        echo "<script>alert('Data transaksi tidak ditemukan!'); window.location.href='index.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID transaksi tidak valid!'); window.location.href='index.php';</script>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari formulir
    $id_karyawan = $_POST['id_karyawan'];
    $id_pasien = $_POST['id_pasien'];
    $tanggal_transaksi = $_POST['tanggal_transaksi'];
    $total_harga = $_POST['total_harga'];
    $total_bayar = $_POST['total_bayar'];
    $kembali = $_POST['kembali'];
    $sumber_pembayaran = $_POST['sumber_pembayaran'];

    // Sanitasi input untuk mencegah SQL injection
    $id_karyawan = mysqli_real_escape_string($conn, $id_karyawan);
    $id_pasien = mysqli_real_escape_string($conn, $id_pasien);
    $tanggal_transaksi = mysqli_real_escape_string($conn, $tanggal_transaksi);
    $total_harga = mysqli_real_escape_string($conn, $total_harga);
    $total_bayar = mysqli_real_escape_string($conn, $total_bayar);
    $kembali = mysqli_real_escape_string($conn, $kembali);
    $sumber_pembayaran = mysqli_real_escape_string($conn, $sumber_pembayaran);

    // Validasi ID Karyawan
    $check_karyawan_sql = "SELECT * FROM karyawan WHERE ID_Karyawan = '$id_karyawan'";
    $check_karyawan_result = mysqli_query($conn, $check_karyawan_sql);

    // Validasi ID Pasien
    $check_pasien_sql = "SELECT * FROM pasien WHERE ID_Pasien = '$id_pasien'";
    $check_pasien_result = mysqli_query($conn, $check_pasien_sql);

    if (mysqli_num_rows($check_karyawan_result) == 0) {
        echo "<script>alert('ID Karyawan tidak valid!'); window.location.href='index.php';</script>";
        exit();
    }

    if (mysqli_num_rows($check_pasien_result) == 0) {
        echo "<script>alert('ID Pasien tidak valid!'); window.location.href='index.php';</script>";
        exit();
    }

    // Query untuk memperbarui data transaksi
    $sql_update = "UPDATE transaksi SET 
                    ID_Karyawan = '$id_karyawan',
                    ID_Pasien = '$id_pasien',
                    Tanggal_Transaksi = '$tanggal_transaksi',
                    Total_Harga = '$total_harga',
                    Total_Bayar = '$total_bayar',
                    Kembali = '$kembali',
                    Sumber_Pembayaran = '$sumber_pembayaran'
                    WHERE ID_Transaksi = '$id_transaksi'";

    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-200 text-gray-900">
    <div class="flex-grow mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Transaksi</h1>

        <form method="POST" action="">
            <input type="hidden" name="id_transaksi" value="<?php echo $transaksi['ID_Transaksi']; ?>">
            <div class="mb-4">
                <label for="id_karyawan" class="block text-sm font-medium text-gray-700">ID Karyawan</label>
                <input type="text" name="id_karyawan" id="id_karyawan" value="<?php echo $transaksi['ID_Karyawan']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="id_pasien" class="block text-sm font-medium text-gray-700">ID Pasien</label>
                <input type="text" name="id_pasien" id="id_pasien" value="<?php echo $transaksi['ID_Pasien']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="tanggal_transaksi" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" id="tanggal_transaksi" value="<?php echo $transaksi['Tanggal_Transaksi']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                <input type="number" name="total_harga" id="total_harga" value="<?php echo $transaksi['Total_Harga']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="total_bayar" class="block text-sm font-medium text-gray-700">Total Bayar</label>
                <input type="number" name="total_bayar" id="total_bayar" value="<?php echo $transaksi['Total_Bayar']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="kembali" class="block text-sm font-medium text-gray-700">Kembali</label>
                <input type="number" name="kembali" id="kembali" value="<?php echo $transaksi['Kembali']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="sumber_pembayaran" class="block text-sm font-medium text-gray-700">Sumber Pembayaran</label>
                <input type="text" name="sumber_pembayaran" id="sumber_pembayaran" value="<?php echo $transaksi['Sumber_Pembayaran']; ?>" required class="mt-1 block w-full p-2 border border-gray-300 rounded">
            </div>
            <button type="submit" class="bg-blue-700 text-white py-2 px-4 rounded hover:bg-blue-800">Update</button>
            <a href="index.php" class="bg-gray-300 text-gray-800 py-2 px-4 rounded hover:bg-gray-400">Cancel</a>
        </form>
    </div>
</body>

</html>
