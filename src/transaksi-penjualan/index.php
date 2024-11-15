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
        // Function untuk menampilkan modal
        function showModal(detailContent) {
            document.getElementById('modalContent').innerHTML = detailContent;
            document.getElementById('detailModal').classList.remove('hidden');
        }

        // Function untuk menutup modal
        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
</head>

<body class="bg-blue-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Transaksi</h1>

        <!-- Form Pencarian di kiri dan Tombol Tambah Data di kanan -->
        <div class="mb-6 flex justify-between items-center">
            <form action="" method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" placeholder="Cari Transaksi..." class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
            <a href="/apoteku/src/transaksi-penjualan/create.php" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 text-sm transition duration-300 ease-in-out transform hover:scale-105">
                Tambah Data
            </a>
        </div>

        <!-- Tabel dengan overflow-x-auto -->
        <div class="bg-white shadow-md rounded-lg w-full mt-6 overflow-x-auto">
            <table class="table-auto w-full text-left border border-gray-200">
                <thead class="bg-grey-100 text-black">
                    <tr>
                        <th class="px-4 py-3 border-b">ID Transaksi</th>
                        <th class="px-4 py-3 border-b">Nama Pasien</th>
                        <th class="px-4 py-3 border-b">Nama Dokter</th>
                        <th class="px-4 py-3 border-b">Nama Karyawan</th>
                        <th class="px-4 py-3 border-b">Tanggal Transaksi</th>
                        <th class="px-4 py-3 border-b">Total Harga</th>
                        <th class="px-4 py-3 border-b">Total Bayar</th>
                        <th class="px-4 py-3 border-b">Kembali</th>
                        <th class="px-4 py-3 border-b">Sumber Pembayaran</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                        <th class="px-4 py-3 border-b text-center">Detail Resep</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    <?php
                    include('../../src/database/database.php');

                    // Mendapatkan kata kunci pencarian
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Query untuk menampilkan data transaksi
                    $sql = "SELECT t.ID_Transaksi, t.ID_Pasien, t.ID_Dokter, k.Nama, t.Tanggal_Transaksi, 
                                   t.Total_Harga, t.Total_Bayar, t.Kembali, t.Sumber_Pembayaran, t.Detail_Resep
                            FROM transaksi t
                            JOIN karyawan k ON t.ID_Karyawan = k.ID_Karyawan
                            WHERE t.ID_Transaksi LIKE '%$search%' 
                            OR t.ID_Pasien LIKE '%$search%' 
                            OR t.ID_Dokter LIKE '%$search%' 
                            OR k.Nama LIKE '%$search%' 
                            OR t.Tanggal_Transaksi LIKE '%$search%' 
                            OR t.Total_Harga LIKE '%$search%' 
                            OR t.Total_Bayar LIKE '%$search%' 
                            OR t.Kembali LIKE '%$search%' 
                            OR t.Sumber_Pembayaran LIKE '%$search%'";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="hover:bg-gray-50 border-b transition duration-300">
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['ID_Transaksi'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['ID_Pasien'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['ID_Dokter'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Nama'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . date('d M Y', strtotime($row['Tanggal_Transaksi'])) . '</td>
                                <td class="px-4 py-3 whitespace-nowrap text-green-600 font-semibold">Rp ' . number_format($row['Total_Harga'], 0, ',', '.') . '</td>
                                <td class="px-4 py-3 whitespace-nowrap text-blue-600 font-semibold">Rp ' . number_format($row['Total_Bayar'], 0, ',', '.') . '</td>
                                <td class="px-4 py-3 whitespace-nowrap text-red-600 font-semibold">Rp ' . number_format($row['Kembali'], 0, ',', '.') . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Sumber_Pembayaran'] . '</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="/apoteku/src/transaksi-penjualan/edit.php?id=' . $row['ID_Transaksi'] . '" class="bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600"><i class="bi bi-pencil-square"></i></a>
                                        <a onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');" href="/apoteku/src/transaksi-penjualan/delete.php?id=' . $row['ID_Transaksi'] . '" class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600"><i class="bi bi-trash-fill"></i></a>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button onclick="showModal(`<p>' . nl2br($row['Detail_Resep']) . '</p>`)" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Detail</button>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="11" class="text-center py-4 text-gray-500">Tidak ada data transaksi</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Popup untuk Detail Resep -->
    <div id="detailModal" class="fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Detail Resep</h2>
            <div id="modalContent"></div>
            <button onclick="closeModal()" class="mt-4 bg-red-500 text-white py-2 px-4 rounded-lg">Tutup</button>
        </div>
    </div>
</body>

</html>
