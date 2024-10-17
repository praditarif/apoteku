<?php
include('../database/database.php');

// Initialize variables
$id_transaksi = $nama_pasien = $id_dokter = $nama_karyawan = $tanggal_transaksi = $total_harga = $total_bayar = $kembali = $sumber_pembayaran = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header('Location: /apoteku/src/transaksi-penjualan/index.php');
        exit;
    }

    $id_transaksi = $_GET['id'];

    $sql = "SELECT t.*, p.Nama_Lengkap AS Nama_Pasien, k.Nama AS Nama_Karyawan 
            FROM transaksi t 
            JOIN pasien p ON p.ID_Pasien = t.ID_Pasien
            JOIN karyawan k ON k.ID_Karyawan = t.ID_Karyawan
            WHERE t.ID_Transaksi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_transaksi);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header('Location: /apoteku/src/transaksi-penjualan/index.php');
        exit;
    }

    $row = $result->fetch_assoc();

    $nama_pasien = $row['Nama_Pasien'];
    $id_dokter = $row['ID_Dokter'];
    $nama_karyawan = $row['Nama_Karyawan'];
    $tanggal_transaksi = $row['Tanggal_Transaksi'];
    $total_harga = $row['Total_Harga'];
    $total_bayar = $row['Total_Bayar'];
    $kembali = $row['Kembali'];
    $sumber_pembayaran = $row['Sumber_Pembayaran'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_transaksi = $_POST['ID_Transaksi'];
    $id_dokter = $_POST['ID_Dokter'];
    $total_harga = $_POST['Total_Harga'];
    $total_bayar = $_POST['Total_Bayar'];
    $kembali = $_POST['Kembali'];
    $sumber_pembayaran = $_POST['Sumber_Pembayaran'];

    if (empty($id_dokter) || empty($total_harga) || empty($total_bayar) || empty($kembali) || empty($sumber_pembayaran)) {
        echo "<script>alert('Please fill all the fields')</script>";
    } else {
        $sql = "UPDATE transaksi SET 
            ID_Dokter = ?, Total_Harga = ?, Total_Bayar = ?, Kembali = ?, Sumber_Pembayaran = ?
            WHERE ID_Transaksi = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "iddssi",
            $id_dokter,
            $total_harga,
            $total_bayar,
            $kembali,
            $sumber_pembayaran,
            $id_transaksi
        );

        if ($stmt->execute()) {
            $successMessage = 'Transaksi berhasil diupdate!';
            header('Location: /apoteku/src/transaksi-penjualan/index.php');
            exit;
        } else {
            echo "<script>alert('Failed to update transaksi')</script>";
            die("Error in query: " . mysqli_error($conn));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Edit Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-blue-100">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Transaksi</h1>

        <form action="edit.php" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <input type="hidden" name="ID_Transaksi" value="<?php echo $id_transaksi; ?>">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="Nama_Pasien" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="Nama_Pasien" value="<?php echo $nama_pasien; ?>" readonly
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="ID_Dokter" class="block text-sm font-medium text-gray-700">ID Dokter</label>
                    <input type="text" name="ID_Dokter" value="<?php echo $id_dokter; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="Nama_Karyawan" class="block text-sm font-medium text-gray-700">Nama Karyawan</label>
                    <input type="text" name="Nama_Karyawan" value="<?php echo $nama_karyawan; ?>" readonly
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="Tanggal_Transaksi" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                    <input type="date" name="Tanggal_Transaksi" value="<?php echo $tanggal_transaksi; ?>" readonly
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="Total_Harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                    <input type="number" name="Total_Harga" value="<?php echo $total_harga; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="Total_Bayar" class="block text-sm font-medium text-gray-700">Total Bayar</label>
                    <input type="number" name="Total_Bayar" value="<?php echo $total_bayar; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="Kembali" class="block text-sm font-medium text-gray-700">Kembali</label>
                    <input type="number" name="Kembali" value="<?php echo $kembali; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="Sumber_Pembayaran" class="block text-sm font-medium text-gray-700">Sumber Pembayaran</label>
                    <input type="text" name="Sumber_Pembayaran" value="<?php echo $sumber_pembayaran; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm">
                </div>

                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
