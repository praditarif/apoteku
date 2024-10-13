<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

</head>

<body class="bg-green-100 text-gray-900 ">
<?php include('../template/sidebar.php'); ?>
  
    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Data Obat</h1>

        <!-- Tombol Tambah Data -->
        <a href="dataobat-create.php"  class="bg-green-800 text-white py-4 px-8 rounded-lg hover:bg-green-700 text-sm">Tambah Data</a>

        <!-- Tabel -->
        <div class=" bg-white shadow-md rounded-lg overflow-x-auto w-full">
            <table class="w-full text-left border border-gray-300">
                <thead class="bg-gray-400">
        <tr>
            <th class=" px-6 py-4">ID Obat</th>
            <th class=" px-6 py-4">Nama Obat</th>
            <th class=" px-6 py-4">Code</th>
            <th class=" px-6 py-4">Formulasi</th>
            <th class=" px-6 py-4">Tanggal Kadaluarsa</th>
            <th class=" px-6 py-4">Stok</th>
            <th class=" px-6 py-4">Supplier</th>
            <th class=" px-6 py-4">Status</th>
            <th class=" px-6 py-4">Package</th>
            <th class=" px-6 py-4">Harga Beli</th>
            <th class=" px-6 py-4 text-center">Harga Jual</th>
        </tr>

                </thead>
                <tbody>
                <?php
    include('../database/database.php');
    // Query untuk menampilkan data dengan kolom Harga_Beli dan Harga_Jual
    $sql = "SELECT t.ID_Obat, t.Nama_Obat, t.Code, t.Formulasi, t.Tanggal_Kadaluarsa, t.Stok, k.Nama_Supplier, t.Status, t.Package, t.Harga_Beli, t.Harga_Jual
            FROM obat t 
            JOIN supplier k ON t.ID_Supplier = k.ID_Supplier";  // Sesuaikan dengan kolom relasi yang benar
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        // Tampilkan error jika query gagal
        die("Query failed: " . mysqli_error($conn));
    }
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr class="border-b hover:bg-gray-100">
                <td class="px-6 py-auto">' . $row['ID_Obat'] . '</td>
                <td class="px-6 py-auto">' . $row['Nama_Obat'] . '</td>
                <td class="px-6 py-auto">' . $row['Code'] . '</td>
                <td class="px-6 py-auto">' . $row['Formulasi'] . '</td>
                <td class="px-6 py-auto">' . $row['Tanggal_Kadaluarsa'] . '</td>
                <td class="px-6 py-auto">' . $row['Stok'] . '</td>
                <td class="px-6 py-auto">' . $row['Nama_Supplier'] . '</td>
                <td class="px-6 py-auto">' . $row['Status'] . '</td>
                <td class="px-6 py-auto">' . $row['Package'] . '</td>
                <td class="px-6 py-auto">' . $row['Harga_Beli'] . '</td>
                <td class="px-6 py-auto">' . $row['Harga_Jual'] . '</td>
                <td class="flex gap-x-4 justify-center">
                    <a href="/grancy/src/obat/obat_edit.php?id=' . $row['ID_Obat'] . '" class="btn bg-yellow hover:shadow-md hover:bg-yellow group">
                        <i class="bi bi-pencil-square transition-all"></i>
                    </a>
                    <a onclick="return confirm(\'Are you sure you want to delete this Data?\');" href="dataobat-delete.php?id=' . $row['ID_Obat'] . '" class="btn bg-red hover:shadow-md hover:bg-red group">
                        <i class="bi bi-trash-fill transition-all"></i>
                    </a>
                </td>
            </tr>';
        }
    }
?>

</body>

</html>
