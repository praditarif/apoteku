<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../../src/assets/css/output.css" rel="stylesheet">
    <script defer>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Krona+One&family=League+Spartan:wght@100..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap');

        h1 {
            font-family: Lexend;
            font-weight: 500;
            font-size: 60px;
        }

        h6 {
            font-family: Lexend;
            font-weight: 200;
            font-size: 14px;
        }

        p {
            font-family: Lexend, sans-serif;
            font-weight: 100;
            font-size: 16px;
        }

        table {
            border-spacing: 0;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        table th, table td {
            font-size: 14px;
            font-weight: 500;
            text-align: left;
            padding: 12px 16px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f3f4f6;
            font-weight: 600;
            text-align: center;
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .action-button {
            text-align: center;
        }

        @media (max-width: 768px) {
            table th, table td {
                font-size: 12px;
                padding: 8px 10px;
            }
        }
    </style>
</head>

<body class="bg-green-100 text-gray-900">
<?php include('../template/sidebar.php'); ?>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="ml-64 max-w-6xl mx-auto  p-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold mb-4">Data Obat</h1>

            <!-- Tombol Tambah Data diposisikan di bawah teks Data Obat -->
            <a href="/apoteku/src/transaksi-penjualan/create.php"
                class="bg-green-800 text-white py-1 px-3 rounded-lg hover:bg-green-700 text-sm">
                Tambah Data
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white shadow-md rounded-lg overflow-x-auto w-full mt-4">
            <table class="w-full text-left border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">ID Transaksi</th>
                        <th class="px-4 py-2">ID Karyawan</th>
                        <th class="px-4 py-2">Tanggal Waktu</th>
                        <th class="px-4 py-2">Kode Jenis Layanan</th>
                        <th class="px-4 py-2">Kode Provider CPT</th>
                        <th class="px-4 py-2">Total Harga Obat</th>
                        <th class="px-4 py-2">Metode Pembayaran</th>
                        <th class="px-4 py-2">Sumber Pembayaran</th>
                        <th class="px-4 py-2">ID Resep</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../../src/database/database.php');
                    $sql = "SELECT t.ID_Transaksi, t.ID_Karyawan, t.Tanggal_Waktu, t.Kode_Jenis_Layanan, t.Kode_Provider_CPT, t.Total_Harga_Obat, t.Metode_Pembayaran, t.Sumber_Pembayaran, t.ID_Resep
                            FROM transaksi t 
                            JOIN karyawan k ON t.ID_Karyawan = k.ID_Karyawan
                            JOIN resep r ON t.ID_Resep = r.ID_Resep";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        die("Query failed: " . mysqli_error($conn));
                    }
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="border-b hover:bg-gray-100">
                                <th>' . $row['ID_Transaksi'] . '</th>
                                <td class="px-6 py-4">' . $row['ID_Karyawan'] . '</td>
                                <td class="px-6 py-4">' . $row['Tanggal_Waktu'] . '</td>
                                <td class="px-6 py-4">' . $row['Kode_Jenis_Layanan'] . '</td>
                                <td class="px-6 py-4">' . $row['Kode_Provider_CPT'] . '</td>
                                <td class="px-6 py-4">' . $row['Total_Harga_Obat'] . '</td>
                                <td class="px-6 py-4">' . $row['Metode_Pembayaran'] . '</td>
                                <td class="px-6 py-4">' . $row['Sumber_Pembayaran'] . '</td>
                                <td class="px-6 py-4">' . $row['ID_Resep'] . '</td>
                                <td class="flex gap-x-4 justify-center">
                                    <a href="/grancy/src/transaksi/transaksi_edit.php?id=' . $row['ID_Transaksi'] . '" class="btn bg-yellow-500 hover:shadow-md hover:bg-yellow-600 group text-sm p-2">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a onclick="return confirm(\'Are you sure you want to delete this Data?\');" href="/apoteku/src/transaksi-penjualan-delete.php?id=' . $row['ID_Transaksi'] . '" class="btn bg-red-500 hover:shadow-md hover:bg-red-600 group text-sm p-2">
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
