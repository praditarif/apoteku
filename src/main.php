<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../../src/assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
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

<body class="bg-gray-200 text-gray-900 flex">
    <?php include('template/sidebar.php'); ?>
    <!-- Main Content -->
    <div class="flex-1 ml-64 p-6"> <!-- tambahkan margin kiri -->
        <!-- Header -->
        <header>
            <h1 class="text-3xl font-bold text-gray-700">Dashboard Apotek</h1>
        </header>

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

        // Mengambil total harga untuk transaksi pada hari ini
        $total_harga_query = $pdo->query("SELECT SUM(Total_Harga) AS total_harga 
        FROM transaksi 
        WHERE DATE(Tanggal_Transaksi) = CURDATE()");
        $transaksi = $total_harga_query->fetch(PDO::FETCH_ASSOC);


        $total_pasien_query = $pdo->query("SELECT COUNT(*) AS total_pasien FROM pasien");
        $pasien = $total_pasien_query->fetch(PDO::FETCH_ASSOC);


        $total_dokter_query = $pdo->query("SELECT COUNT(*) AS total_dokter FROM dokter");
        $dokter = $total_dokter_query->fetch(PDO::FETCH_ASSOC);

        $total_obat_query = $pdo->query("SELECT COUNT(*) AS total_obat FROM obat");
        $obat = $total_obat_query->fetch(PDO::FETCH_ASSOC);
        ?>

        <!-- Cards Section -->
        <section class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <h2 class="text-xl font-bold text-gray-700">Penjualan Hari Ini</h2>
                <div class="flex items-center text-3xl mt-2">
                    <p>Rp.</p>
                    <p class="ml-1"><?php echo $transaksi['total_harga']; ?></p>
                </div>
            </div>

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
                        backgroundColor: 'rgba(255, 255, 102, 0.2)', // Warna kuning muda dengan transparansi 0.2
                        borderColor: 'rgba(255, 255, 102, 1)', // Warna kuning muda solid
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