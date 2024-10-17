<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../../src/assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

<body class="bg-gray-100 text-gray-900 flex">

    <aside class="w-64 h-screen bg-blue-500 fixed top-0 left-0 p-6 shadow-lg flex flex-col justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-8 text-white">Apoteku</h1>
            <nav>
                <ul>
                    <li class="mb-6 list-none">
                        <a href="/apoteku/src/main.php"
                            class="w-full bg-blue-600 text-white p-3 rounded-lg flex items-center hover:bg-blue-700">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M80-120v-80h800v80H80Zm40-120v-280h120v280H120Zm200 0v-480h120v480H320Zm200 0v-360h120v360H520Zm200 0v-600h120v600H720Z" />
                                </svg>
                                <span class="ml-2">Dashboard</span>
                            </div>
                        </a>
                    </li>

                    <!-- Transaksi Section -->
                    <div class="mt-8">
                        <button onclick="toggleDropdown('transaksi-dropdown')"
                            class="w-full bg-blue-600 text-white p-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M240-80q-50 0-85-35t-35-85v-120h120v-560h600v680q0 50-35 85t-85 35H240Zm480-80q17 0 28.5-11.5T760-200v-600H320v480h360v120q0 17 11.5 28.5T720-160ZM360-600v-80h360v80H360Zm0 120v-80h360v80H360ZM240-160h360v-80H200v40q0 17 11.5 28.5T240-160Zm0 0h-40 400-360Z" />
                                </svg>
                                <span class="ml-2">Transaksi</span>
                            </div>
                        </button>
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="transaksi-dropdown" class="hidden mt-4">
                        <li class="mb-4 list-none">
                            <a href="/apoteku/src/transaksi-penjualan/index.php"
                                class="text-white bg-blue-600 p-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                                <div class="flex items-center">
                                    <span>Penjualan</span>
                                </div>
                            </a>
                        </li>
                        <li class="list-none">
                            <a href="/apoteku/src/transaksi-pembelian/index-pembelian.php"
                                class="text-white p-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                                <div class="flex items-center">
                                    <span>Pembelian</span>
                                </div>
                            </a>
                        </li>
                    </div>

                    <!-- Data Master Section -->
                    <div class="mt-8">
                        <button onclick="toggleDropdown('master-dropdown')"
                            class="w-full bg-blue-600 text-white p-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                    width="24px" fill="#FFFFFF">
                                    <path
                                        d="M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z" />
                                </svg>
                                <span class="ml-2">Data Master</span>
                            </div>
                        </button>
                    </div>

                    <!-- Dropdown Menu -->
                    <div id="master-dropdown" class="hidden mt-4">
                        <li class="mb-4 list-none">
                            <a href="/apoteku/src/datamaster-obat/dataobat.php"
                                class="text-white p-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                                <div class="flex items-center">
                                    <span>Data Obat</span>
                                </div>
                            </a>
                        </li>

                        <li class="list-none">
                            <a href="/apoteku/src/datamaster-supplier/index-supplier.php"
                                class="text-white p-3 rounded-lg flex items-center hover:bg-blue-700 transition duration-300">
                                <div class="flex items-center">
                                    <span>Data Suplier</span>
                            </a>
                        </li>
                    </div>
                </ul>
            </nav>
        </div>

        <!-- Tombol Logout di bagian bawah -->
        <li class="mb-6 list-none">
            <a href="/apoteku/src/login.php"
                class="w-full bg-red-500 text-white p-3 rounded-lg flex items-center justify-center hover:bg-red-700">
                <div class="flex items-center justify-center">
                    <span class="ml-2">Logout</span>
                </div>
            </a>
        </li>
    </aside>