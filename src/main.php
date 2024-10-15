<?php
// Include database connection
include('database/database.php');

// Mengambil data pendapatan bulanan
$sql = $pdo->query("
    SELECT MONTH(Tanggal_Transaksi) AS bulan, SUM(Total_Harga) AS total_pendapatan
    FROM transaksi
    WHERE YEAR(Tanggal_Transaksi) = YEAR(CURDATE())
    GROUP BY MONTH(Tanggal_Transaksi)
");
$pendapatan = $sql->fetchAll(PDO::FETCH_ASSOC);

// Mengambil total pasien, dokter, dan obat
$total_pasien_query = $pdo->query("SELECT COUNT(*) AS total_pasien FROM pasien");
$pasien = $total_pasien_query->fetch(PDO::FETCH_ASSOC);

$total_dokter_query = $pdo->query("SELECT COUNT(*) AS total_dokter FROM dokter");
$dokter = $total_dokter_query->fetch(PDO::FETCH_ASSOC);

$total_obat_query = $pdo->query("SELECT COUNT(*) AS total_obat FROM obat");
$obat = $total_obat_query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../../src/assets/css/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-green-100 text-gray-900 flex">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-green-600 fixed top-0 left-0 p-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-8 text-white">Apoteku</h1>

        <nav>
            <ul>
                <!-- Beranda -->
                <li class="mb-6 list-none">
                    <a href="/apoteku/src/main.php"
                        class="w-full bg-green-700 text-white p-3 rounded-lg flex items-center justify-center hover:bg-green-800">
                        <span>Dashboard</span>
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
                        <a href="/apoteku/src/transaksi-penjualan/index.php"
                            class="text-white bg-green-700 p-3 rounded-lg flex items-center hover:bg-green-800 transition duration-300">
                            <span>Penjualan</span>
                        </a>
                    </li>
                    <!-- Data pembelian -->
                    <li class="list-none">
                        <a href="/apoteku/src/transaksi-penjualan/index.php"
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
                        <a href="/apoteku/src/datamaster-obat/dataobat.php"
                            class="text-white p-3 rounded-lg flex items-center hover:bg-green-700 transition duration-300">
                            <span>Data Obat</span>
                        </a>
                    </li>

                    <!-- Data Suplier -->
                    <li class="list-none">
                        <a href="/apoteku/src/datamaster-supplier/index-supplier.php"
                            class="text-white p-3 rounded-lg flex items-center hover:bg-green-700 transition duration-300">
                            <span>Data Suplier</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 ml-64 p-6"> <!-- tambahkan margin kiri -->
        <!-- Header -->
            <header class="bg-green-600 p-4 text-white text-center w-full rounded-lg">
                <h1 class="text-3xl font-bold">Dashboard Apotek</h1>
            </header>


            <!-- Cards Section -->
            <section class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold text-gray-700">Total Pasien</h2>
                    <p class="text-3xl mt-2"><?php echo $pasien['total_pasien']; ?></p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold text-gray-700">Total Dokter</h2>
                    <p class="text-3xl mt-2"><?php echo $dokter['total_dokter']; ?></p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold text-gray-700">Total Obat Tersedia</h2>
                    <p class="text-3xl mt-2"><?php echo $obat['total_obat']; ?></p>
                </div>
            </section>

            <!-- Chart Section -->
            <section class="container mx-auto p-6 bg-white rounded-lg shadow-lg mt-6">
                <h2 class="text-xl font-bold text-gray-700">Pendapatan Bulanan</h2>
                <canvas id="pendapatanChart" class="mt-4"></canvas>
            </section>

            <!-- Script for Chart.js -->
            <script>
                var ctx = document.getElementById('pendapatanChart').getContext('2d');
                var pendapatanChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [<?php foreach ($pendapatan as $p) {
                            echo "'Bulan " . $p['bulan'] . "', ";
                        } ?>],
                        datasets: [{
                            label: 'Pendapatan Bulanan',
                            data: [<?php foreach ($pendapatan as $p) {
                                echo $p['total_pendapatan'] . ", ";
                            } ?>],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
    </div>
</body>

</html>