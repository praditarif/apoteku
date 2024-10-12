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

<body class="bg-green-100 text-gray-900">
<?php include('../template/sidebar.php'); ?>
  
    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="ml-64 max-w-6xl mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Data Obat</h1>

        <!-- Tombol Tambah Data -->
        <a href="dataobat-create.php"class="bg-green-800 text-white p-3 rounded-lg flex items-center justify-center hover:bg-green-800 mb-6">Tambah Data</a>

        <!-- Tabel -->
        <div class=" bg-white shadow-md rounded-lg overflow-x-auto w-full">
            <table class="w-full text-left border border-gray-300">
                <thead class="bg-gray-100">
        <tr>
            <th class=" px-6 py-4">ID Obat</th>
            <th class=" px-6 py-4">Nama Obat</th>
            <th class=" px-6 py-4">Code</th>
            <th class=" px-6 py-4">Formulasi</th>
            <th class=" px-6 py-4">Tanggal Kadaluarsa</th>
            <th class=" px-6 py-4">Stok</th>
            <th class=" px-6 py-4">ID Supplier</th>
            <th class=" px-6 py-4">Status</th>
            <th class=" px-6 py-4">Package</th>
            <th class=" px-6 py-4">Harga Obat</th>
            <th class=" px-6 py-4 text-center">Aksi</th>
        </tr>

                </thead>
                <tbody>
                    <?php
                        include('../database/database.php');
                        $sql = "SELECT t.ID_Obat, t.Nama_Obat, t.Code, t.Formulasi, t.Tanggal_Kadaluarsa, t.Stok, t.ID_Supplier, t.Status, t.Package, t.Harga_Obat
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
                            <td class="px-6 py-4">' . $row['ID_Obat'] . '</td>
                            <td class="px-6 py-4">' . $row['Nama_Obat'] . '</td>
                            <td class="px-6 py-4">' . $row['Code'] . '</td>
                            <td class="px-6 py-4">' . $row['Formulasi'] . '</td>
                            <td class="px-6 py-4">' . $row['Tanggal_Kadaluarsa'] . '</td>
                            <td class="px-6 py-4">' . $row['Stok'] . '</td>
                            <td class="px-6 py-4">' . $row['ID_Supplier'] . '</td>
                            <td class="px-6 py-4">' . $row['Status'] . '</td>
                            <td class="px-6 py-4">' . $row['Package'] . '</td>
                            <td class="px-6 py-4">' . $row['Harga_Obat'] . '</td>
                            <td class="flex gap-x-4 justify-center">
                                <a href="/grancy/src/obat/obat_edit.php?id=' . $row['ID_Obat'] . '" class="btn bg-yellow hover:shadow-md hover:bg-yellow group">
                                    <i class="bi bi-pencil-square transition-all"></i>
                                </a>
                                <a onclick="return confirm(\'Are you sure you want to delete this Data?\');" href="/apoteku/src/obat-delete.php?id=' . $row['ID_Obat'] . '" class="btn bg-red hover:shadow-md hover:bg-red group">
                                    <i class="bi bi-trash-fill transition-all"></i>
                                </a>
                            </td>
                        </tr>';
                    }
                }
                        ?>
    </div>
</body>

</html>
