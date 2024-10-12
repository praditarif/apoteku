<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="./output.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
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

        /* Custom Tabel Styling */
        table {
            border-spacing: 0;
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Tambahkan properti ini agar kolom presisi */
        }

        table th, table td {
            font-size: 14px;
            font-weight: 500;
            text-align: left;
            padding: 12px 16px; /* Konsisten padding untuk presisi */
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f3f4f6;
            font-weight: 600;
            text-align: center; /* Presisi header tengah */
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        .action-button {
            text-align: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            table th, table td {
                font-size: 12px;
                padding: 8px 10px;
            }
        }
    </style>

</head>

<body class="bg-green-100 text-gray-900">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-green-600 fixed top-0 left-0 p-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-8 text-white">Apoteku</h1>

        <nav>
            <ul>
                <!-- Beranda -->
                <li class="mb-6 list-none">
                    <a href="index.php"
                        class="w-full bg-green-700 text-white p-3 rounded-lg flex items-center justify-center hover:bg-green-800">
                        <span>Beranda</span>
                    </a>
                </li>

                <!-- Transaksi Section -->
                <div class="mt-8">
                    <button onclick="toggleDropdown('transaksi-dropdown')"
                        class="w-full bg-green-800 text-white p-3 rounded-lg flex items-center justify-center hover:bg-green-800 transition duration-300">
                        <span>Transaksi</span>
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div id="transaksi-dropdown" class="hidden mt-4">
                    <!-- Data penjualan -->
                    <li class="mb-4 list-none">
                        <a href="transaksi-penjualan.php"
                            class="text-white bg-green-700 p-3 rounded-lg flex items-center hover:bg-green-800 transition duration-300">
                            <span>Penjualan</span>
                        </a>
                    </li>

                    <!-- Data pembelian -->
                    <li class="list-none">
                        <a href="datasuplier.php"
                            class="text-white p-3 rounded-lg flex items-center hover:bg-green-700 transition duration-300">
                            <span>Pembelian</span>
                        </a>
                    </li>
                </div>

                <!-- Data Master Section -->
                <div class="mt-8">
                    <button onclick="toggleDropdown('master-dropdown')"
                        class="w-full bg-green-700 text-white p-3 rounded-lg flex items-center justify-center hover:bg-green-800 transition duration-300">
                        <span>Data Master</span>
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div id="master-dropdown" class="hidden mt-4">
                    <!-- Data Obat -->
                    <li class="mb-4 list-none">
                        <a href="dataobat.php"
                            class="text-white p-3 rounded-lg flex items-center hover:bg-green-700 transition duration-300">
                            <span>Data Obat</span>
                        </a>
                    </li>

                    <!-- Data Suplier -->
                    <li class="list-none">
                        <a href="datasuplier.php"
                            class="text-white p-3 rounded-lg flex items-center hover:bg-green-700 transition duration-300">
                            <span>Data Suplier</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </aside>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="ml-64 max-w-6xl mx-auto mt-10 p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Data Obat</h1>

        <!-- Tombol Tambah Data -->
        <a href="/apoteku/apoteku/src/dataobat-create.php"class="bg-green-800 text-white p-3 rounded-lg flex items-center justify-center hover:bg-green-800 mb-6">Tambah Data</a>

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
                        include('./database/database.php');
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
