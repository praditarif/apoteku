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
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-blue-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Transaksi</h1>

        <!-- Tombol Tambah Data diposisikan di bawah teks Transaksi -->
        <div class="mb-6">
            <a href="/apoteku/src/transaksi-penjualan/create.php"
                class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 text-sm transition duration-300 ease-in-out transform hover:scale-105">
                Tambah Data
            </a>
        </div>

        <!-- Tabel dengan overflow-x-auto -->
        <div class="bg-white shadow-md rounded-lg w-full mt-4 overflow-x-auto">
            <table class="w-full text-left border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 min-w-[100px]">ID Transaksi</th>
                        <th class="px-4 py-2 min-w-[120px]">Nama Pasien</th>
                        <th class="px-4 py-2">Nama Dokter</th>
                        <th class="px-4 py-2">Nama Karyawan</th>
                        <th class="px-4 py-2 min-w-[130px]">Tanggal Transaksi</th>
                        <th class="px-4 py-2 min-w-[150px]">Total harga</th>
                        <th class="px-4 py-2">Total Bayar</th>
                        <th class="px-4 py-2 min-w-[150px] text-center">Kembali</th>
                        <th class="px-4 py-2 min-w-[150px] text-center">Sumber pembayaran</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../src/database/database.php');
                    $sql = "SELECT t.ID_Transaksi, t.ID_Pasien, t.ID_Dokter, k.Nama, t.Tanggal_Transaksi, t.Total_Harga, t.Total_Bayar, t.Kembali, t.Sumber_Pembayaran
                            FROM transaksi t
                            JOIN karyawan k ON t.ID_Karyawan = k.ID_Karyawan;";
                    
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="border-b hover:bg-gray-100">
                                <th class="px-6 py-4">' . $row['ID_Transaksi'] . '</th>
                                <td class="px-6 py-4">' . $row['ID_Pasien'] . '</td>
                                <td class="px-6 py-4">' . $row['ID_Dokter'] . '</td>
                                <td class="px-6 py-4">' . $row['Nama'] . '</td>
                                <td class="px-6 py-4">' . $row['Tanggal_Transaksi'] . '</td>
                                <td class="px-6 py-4">' . $row['Total_Harga'] . '</td>
                                <td class="px-6 py-4">' . $row['Total_Bayar'] . '</td>
                                <td class="px-6 py-4">' . $row['Kembali'] . '</td>
                                <td class="px-6 py-4">' . $row['Sumber_Pembayaran'] . '</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-x-4">
                                        <!-- Tombol Edit -->
                                        <a href="/apoteku/src/transaksi-penjualan/edit.php?id=' . $row['ID_Transaksi'] . '" 
                                           class="bg-yellow-500 text-white p-2 rounded-md hover:bg-yellow-600 transition duration-300 ease-in-out transform hover:scale-105">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        
                                        <!-- Tombol Delete -->
                                        <a onclick="return confirm(\'Are you sure you want to delete this Data?\');" href="/apoteku/src/transaksi-penjualan/delete.php?id=' . $row['ID_Transaksi'] . '" 
                                           class="bg-red-500 text-white p-2 rounded-md hover:bg-red-600 transition duration-300 ease-in-out transform hover:scale-105">
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
