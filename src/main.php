<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="../src/assets/css/output.css">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-green-100 text-gray-900">
    <!-- Sidebar -->
    <?php include('./template/sidebar.php'); ?>

    <!-- Konten Utama -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-4">Dashboard</h1>

        <!-- Grid Layout untuk Card -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
            <!-- Card 1 -->
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-red-500">
                <h2 class="text-blue-500 font-semibold">Penjualan Anda Hari Ini</h2>
                <p class="text-2xl font-bold text-gray-700">Rp. 56,000</p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-blue-500">
                <h2 class="text-blue-500 font-semibold">Penjualan Anda Bulan Ini</h2>
                <p class="text-2xl font-bold text-gray-700">Rp. 77,000</p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-green-500">
                <h2 class="text-blue-500 font-semibold">Kadaluwarsa Bulan Ini</h2>
                <p class="text-2xl font-bold text-gray-700">1 Data</p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-yellow-500">
                <h2 class="text-yellow-500 font-semibold">Total Supplier</h2>
                <p class="text-2xl font-bold text-gray-700">32 Supplier</p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- <?php
    include('../database/database.php');
    $query = "SELECT penjualan_hari_ini, penjualan_bulan_ini, kadaluwarsa_bulan_ini, total_supplier FROM transaksi t";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();

    $conn->close();
    ?>

    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-semibold mb-4">Dashboard</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1 
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-red-500">
                <h2 class="text-blue-500 font-semibold">Penjualan Anda Hari Ini</h2>
                <p class="text-2xl font-bold text-gray-700">Rp.
                    <?php echo number_format($data['penjualan_hari_ini'], 0, ',', '.'); ?></p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <!-- Card 2 
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-blue-500">
                <h2 class="text-blue-500 font-semibold">Penjualan Anda Bulan Ini</h2>
                <p class="text-2xl font-bold text-gray-700">Rp.
                    <?php echo number_format($data['penjualan_bulan_ini'], 0, ',', '.'); ?></p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <!-- Card 3 
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-green-500">
                <h2 class="text-blue-500 font-semibold">Kadaluwarsa Bulan Ini</h2>
                <p class="text-2xl font-bold text-gray-700"><?php echo $data['kadaluwarsa_bulan_ini']; ?> Data</p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <!-- Card 4 
            <div class="bg-white shadow-md rounded-lg p-4 border-t-4 border-yellow-500">
                <h2 class="text-yellow-500 font-semibold">Total Supplier</h2>
                <p class="text-2xl font-bold text-gray-700"><?php echo $data['total_supplier']; ?> Supplier</p>
                <div class="text-gray-400 mt-2 text-right">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </div> -->
</body>

</html>