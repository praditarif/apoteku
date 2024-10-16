<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
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

<body class="bg-green-100 text-gray-900">
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
        <section class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-700">Penjualan Hari Ini</h2>
                    <div class="flex items-center text-3xl mt-2">
                        <p>Rp.</p>
                        <p class="ml-1"><?php echo $transaksi['total_harga']; ?></p>
                    </div>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                    fill="#5f6368">
                    <path
                        d="M444-200h70v-50q50-9 86-39t36-89q0-42-24-77t-96-61q-60-20-83-35t-23-41q0-26 18.5-41t53.5-15q32 0 50 15.5t26 38.5l64-26q-11-35-40.5-61T516-710v-50h-70v50q-50 11-78 44t-28 74q0 47 27.5 76t86.5 50q63 23 87.5 41t24.5 47q0 33-23.5 48.5T486-314q-33 0-58.5-20.5T390-396l-66 26q14 48 43.5 77.5T444-252v52Zm36 120q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z" />
                </svg>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-700">Total Pasien</h2>
                    <p class="text-3xl mt-2"><?php echo $pasien['total_pasien']; ?></p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                    fill="#5f6368">
                    <path
                        d="M680-360q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-160v-56q0-24 12.5-44.5T528-290q36-15 74.5-22.5T680-320q39 0 77.5 7.5T832-290q23 9 35.5 29.5T880-216v56H480Zm-80-320q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-160ZM80-160v-112q0-34 17-62.5t47-43.5q60-30 124.5-46T400-440q35 0 70 6t70 14l-34 34-34 34q-18-5-36-6.5t-36-1.5q-58 0-113.5 14T180-306q-10 5-15 14t-5 20v32h240v80H80Zm320-80Zm0-320q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Z" />
                </svg>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-700">Total Dokter</h2>
                    <p class="text-3xl mt-2"><?php echo $dokter['total_dokter']; ?></p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                    fill="#5f6368">
                    <path
                        d="M480-480Zm0 360q-18 0-34.5-6.5T416-146L148-415q-35-35-51.5-80T80-589q0-103 67-177t167-74q48 0 90.5 19t75.5 53q32-34 74.5-53t90.5-19q100 0 167.5 74T880-590q0 49-17 94t-51 80L543-146q-13 13-29 19.5t-34 6.5Zm40-520q10 0 19 5t14 13l68 102h166q7-17 10.5-34.5T801-590q-2-69-46-118.5T645-758q-31 0-59.5 12T536-711l-27 29q-5 6-13 9.5t-16 3.5q-8 0-16-3.5t-14-9.5l-27-29q-21-23-49-36t-60-13q-66 0-110 50.5T160-590q0 18 3 35.5t10 34.5h187q10 0 19 5t14 13l35 52 54-162q4-12 14.5-20t23.5-8Zm12 130-54 162q-4 12-15 20t-24 8q-10 0-19-5t-14-13l-68-102H236l237 237q2 2 3.5 2.5t3.5.5q2 0 3.5-.5t3.5-2.5l236-237H600q-10 0-19-5t-15-13l-34-52Z" />
                </svg>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-gray-700">Total Obat Tersedia</h2>
                    <p class="text-3xl mt-2"><?php echo $obat['total_obat']; ?></p>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px"
                    fill="#5f6368">
                    <path
                        d="m320-60-80-60v-160h-40q-33 0-56.5-23.5T120-360v-300q-17 0-28.5-11.5T80-700q0-17 11.5-28.5T120-740h120v-60h-20q-17 0-28.5-11.5T180-840q0-17 11.5-28.5T220-880h120q17 0 28.5 11.5T380-840q0 17-11.5 28.5T340-800h-20v60h120q17 0 28.5 11.5T480-700q0 17-11.5 28.5T440-660v300q0 33-23.5 56.5T360-280h-40v220ZM200-360h160v-60h-70q-12 0-21-9t-9-21q0-12 9-21t21-9h70v-60h-70q-12 0-21-9t-9-21q0-12 9-21t21-9h70v-60H200v300ZM600-80q-33 0-56.5-23.5T520-160v-260q0-29 10-48t21-33q11-14 20-22.5t9-16.5v-20q-17 0-28.5-11.5T540-600q0-17 11.5-28.5T580-640h200q17 0 28.5 11.5T820-600q0 17-11.5 28.5T780-560v20q0 8 10 18t22 24q11 14 19.5 33t8.5 45v260q0 33-23.5 56.5T760-80H600Zm0-320h160v-20q0-15-9-26t-20-24q-11-13-21-29t-10-41v-20h-40v20q0 24-9.5 40T630-471q-11 13-20.5 24.5T600-420v20Zm0 120h160v-60H600v60Zm0 120h160v-60H600v60Zm0-120h160-160Z" />
                </svg>
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