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

        <div class="mb-6 flex justify-between items-center">
    <!-- Search Form -->
    <div class="flex items-center space-x-2 w-full max-w-lg relative">
        <input id="searchInput" 
               type="text" 
               name="search" 
               placeholder="Cari Transaksi..." 
               class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white transition duration-300"
               oninput="handleSearch()"
               value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">

        <!-- Clear Button -->
        <button id="clearSearch" 
                class="hidden bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition duration-300 ml-2"
                onclick="clearSearch()">Clear</button>

        <!-- Search Button -->
        <button onclick="performServerSearch()" 
                class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-300 flex items-center gap-2">
            <i class="bi bi-search"></i> Cari
        </button>
    </div>

    <!-- Button Tambah Data -->
    <a href="/apoteku/src/transaksi-penjualan/create.php" 
       class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-green-600 text-sm transition duration-300 ease-in-out transform hover:scale-105">
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
<div id="detailModal" class="fixed inset-0 flex items-center justify-center hidden z-50">
    <!-- Background Blur -->
    <div id="modalBackdrop" class="absolute inset-0 bg-black bg-opacity-50 backdrop-blur-sm transition-opacity duration-500 ease-out"></div>

    <!-- Modal Box -->
    <div id="modalBox" class="relative bg-white bg-opacity-90 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-gray-200 max-w-lg w-10/12 transform scale-90 opacity-0 transition-all duration-700 ease-in-out">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-700 hover:text-red-600 transition duration-300">
            <i class="bi bi-x-circle-fill text-2xl"></i>
        </button>

        <!-- Header Modal -->
        <div class="flex justify-between items-center border-b border-gray-200 pb-4 mb-6">
            <h2 class="text-3xl font-bold text-black">Detail Resep</h2>
        </div>

        <!-- Konten Modal -->
        <div id="modalContent" class="text-black font-bold leading-relaxed max-h-80 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100"></div>

       <!-- Footer Modal -->
<div class="mt-8 flex justify-end gap-4">
    <button onclick="closeModal()" class="bg-gradient-to-r from-blue-600 to-cyan-500 text-white py-2 px-6 rounded-full shadow-lg hover:shadow-xl hover:from-blue-500 hover:to-cyan-400 focus:outline-none focus:ring-4 focus:ring-blue-300 transform transition-all duration-300 ease-in-out hover:scale-105 relative overflow-hidden">
        <span class="absolute inset-0 bg-blue-400 opacity-30 blur-lg rounded-full transition-opacity duration-500 ease-out hover:opacity-60"></span>
        <span class="relative">Tutup</span>
    </button>
</div>

    </div>
</div>

<script>
    // Function untuk menampilkan modal with animation
    function showModal(detailContent) {
        const modal = document.getElementById('detailModal');
        const modalBox = document.getElementById('modalBox');
        const modalBackdrop = document.getElementById('modalBackdrop');
        
        // Update modal content
        document.getElementById('modalContent').innerHTML = detailContent;

        // Tampilkan modal and animation
        modal.classList.remove('hidden');
        setTimeout(() => {
            modalBackdrop.classList.add('opacity-100');
            modalBox.classList.remove('opacity-0', 'scale-90');
            modalBox.classList.add('scale-100', 'opacity-100');
        }, 100); // animation delay
    }

    // Function untuk menutup modal dengan animasi
    function closeModal() {
        const modal = document.getElementById('detailModal');
        const modalBox = document.getElementById('modalBox');
        const modalBackdrop = document.getElementById('modalBackdrop');

        // Animasi keluar
        modalBackdrop.classList.remove('opacity-100');
        modalBox.classList.remove('scale-100', 'opacity-100');
        modalBox.classList.add('scale-90', 'opacity-0');

        // Sembunyikan modal setelah animasi selesai
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 700); // Sesuaikan durasi animasi keluar
    }

    // Menutup modal jika klik di luar area modal
    document.getElementById('modalBackdrop').addEventListener('click', closeModal);

    // Menambahkan event listener untuk tombol Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeModal();
        }
    });



    // JavaScript untuk pencarian langsung tanpa refresh
    const searchInput = document.getElementById('searchInput');
    const clearButton = document.getElementById('clearSearch');
    const tableRows = document.querySelectorAll('table tbody tr');

    // Fungsi untuk melakukan pencarian langsung
    function handleSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();

        // Tampilkan/ Sembunyikan tombol Clear
        if (searchTerm) {
            clearButton.classList.remove('hidden');
        } else {
            clearButton.classList.add('hidden');
        }

        // Filter data tabel
        tableRows.forEach(row => {
            const rowText = row.innerText.toLowerCase();
            if (rowText.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });

        // Jika semua kosong, tampilkan pesan "Tidak ada data"
        const visibleRows = Array.from(tableRows).filter(row => row.style.display !== 'none');
        if (visibleRows.length === 0) {
            const emptyRow = document.createElement('tr');
            emptyRow.innerHTML = `<td colspan="11" class="text-center py-4 text-gray-500">Tidak ada data yang sesuai</td>`;
            document.querySelector('table tbody').appendChild(emptyRow);
        }
    }

    // Fungsi untuk menghapus pencarian dan menampilkan semua data
    function clearSearch() {
        searchInput.value = '';
        handleSearch(); // Reset pencarian
    }

    // Fungsi untuk pencarian server-side
    function performServerSearch() {
        const searchTerm = searchInput.value.trim();
        if (searchTerm) {
            window.location.href = `?search=${encodeURIComponent(searchTerm)}`;
        }
    }

    // Shortcut untuk Enter sebagai pencarian
    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            performServerSearch();
        }
    });
</script>

    
</body>

</html>
