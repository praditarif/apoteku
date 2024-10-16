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

<body class="bg-gray-200 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Transaksi</h1>

        <!-- Tombol Tambah Data diposisikan di bawah teks Data Obat -->
        <div class="mb-6">
            <a href="/apoteku/src/transaksi-penjualan/create.php"
                class="bg-blue-700 text-white py-3 px-3 rounded-lg hover:bg-blue-800 text-sm">
                Tambah Data
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto w-full mt-4">
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
                    $sql = "SELECT t.ID_Transaksi, p.Nama_Lengkap, t.ID_Dokter, k.Nama, t.Tanggal_Transaksi, t.Total_Harga, t.Total_Bayar, t.Kembali, t.Sumber_Pembayaran
                            FROM transaksi t
                            JOIN karyawan k ON t.ID_Karyawan = k.ID_Karyawan
                            JOIN dokter d ON d.ID_Dokter = t.ID_Dokter
                            JOIN pasien p ON p.ID_Pasien = t.ID_Pasien;";
                            
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="border-b hover:bg-gray-100">
                                <th>' . $row['ID_Transaksi'] . '</th>
                                <td class="px-6 py-4">' . $row['Nama_Lengkap'] . '</td>
                                <td class="px-6 py-4">' . $row['ID_Dokter'] . '</td>
                                <td class="px-6 py-4">' . $row['Nama'] . '</td>
                                <td class="px-6 py-4">' . $row['Tanggal_Transaksi'] . '</td>
                                <td class="px-6 py-4">' . $row['Total_Harga'] . '</td>
                                <td class="px-6 py-4">' . $row['Total_Bayar'] . '</td>
                                <td class="px-6 py-4">' . $row['Kembali'] . '</td>
                                <td class="px-6 py-4">' . $row['Sumber_Pembayaran'] . '</td>
                                <td class="flex gap-x-4 justify-center">
                                    <a href="/apoteku/src/transaksi-penjualan/edit.php?id=' . $row['ID_Transaksi'] . '" class="btn bg-yellow-500 hover:shadow-md hover:bg-yellow-600 group text-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a onclick="return confirm(\'Are you sure you want to delete this Data?\');" href="/apoteku/src/transaksi-penjualan/delete.php?id=' . $row['ID_Transaksi'] . '" class="btn bg-red-500 hover:shadow-md hover:bg-red-600 group text-sm">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
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