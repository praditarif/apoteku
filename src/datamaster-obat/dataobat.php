<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-blue-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Data Obat</h1>

        <!-- Tombol Tambah Data diposisikan di bawah teks Data Obat -->
        <div class="mb-6">
            <a href="/apoteku/src/datamaster-obat/dataobat-create.php"
                class="bg-blue-500 text-white py-3 px-3 rounded-lg hover:bg-blue-600 text-sm">
                Tambah Data
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white shadow-md rounded-lg w-full mt-4 overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-6 py-4 text-left">ID Obat</th>
                        <th class="px-6 py-4 text-left">Nama Obat</th>
                        <th class="px-6 py-4 text-left">Code</th>
                        <th class="px-6 py-4 text-left">Formulasi</th>
                        <th class="px-6 py-4 text-left">Tanggal Kadaluarsa</th>
                        <th class="px-6 py-4 text-left">Stok</th>
                        <th class="px-6 py-4 text-left">Supplier</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Package</th>
                        <th class="px-6 py-4 text-left">Harga Beli</th>
                        <th class="px-6 py-4 text-left">Harga Jual</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    include('../database/database.php');

                    // Mengupdate status jika tanggal kadaluarsa lebih kecil atau sama dengan tanggal sekarang
                    $updateStatusSQL = "UPDATE obat 
                                        SET Status = 'Kadaluarsa' 
                                        WHERE Tanggal_Kadaluarsa <= CURDATE() AND Status != 'Kadaluarsa'";
                    mysqli_query($conn, $updateStatusSQL);

                    // Query untuk menampilkan data obat
                    $sql = "SELECT t.ID_Obat, t.Nama_Obat, t.Code, t.Formulasi, t.Tanggal_Kadaluarsa, t.Stok, k.Nama_Supplier, t.Status, t.Package, t.Harga_Beli, t.Harga_Jual
                            FROM obat t 
                            JOIN supplier k ON t.ID_Supplier = k.ID_Supplier";  

                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    
                    // Menampilkan data obat
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['ID_Obat'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Nama_Obat'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Code'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Formulasi'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Tanggal_Kadaluarsa'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Stok'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Nama_Supplier'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Status'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Package'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Harga_Beli'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">' . $row['Harga_Jual'] . '</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex space-x-2 justify-center">
                                        <a href="/apoteku/src/datamaster-obat/dataobat-edit.php?id=' . $row['ID_Obat'] . '" 
                                           class="bg-yellow-500 text-white p-2 rounded-md hover:bg-yellow-600 transition duration-300 transform hover:scale-105">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="/apoteku/src/datamaster-obat/dataobat-delete.php?id=' . $row['ID_Obat'] . '" 
                                           class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 transition duration-300 transform hover:scale-105" onclick="return confirm(\'Are you sure you want to delete this Data?\');">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
