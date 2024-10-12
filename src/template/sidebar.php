<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../../src/assets/css/output.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
<body class="bg-green-100 text-gray-900">

    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-green-600 fixed top-0 left-0 p-6 shadow-lg">
        <h1 class="text-3xl font-bold mb-8 text-white">Apoteku</h1>

        <nav>
            <ul>
                <!-- Beranda -->
                <li class="mb-6 list-none">
                    <a href="/apoteku/src/main.php"
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
                        <a href="datasuplier.html"
                            class="text-white p-3 rounded-lg flex items-center hover:bg-green-700 transition duration-300">
                            <span>Data Suplier</span>
                        </a>
                    </li>
                </div>
            </ul>
        </nav>
    </aside>

   
<body>