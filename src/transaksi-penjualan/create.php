<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

    <?php
    // Koneksi ke database
    include('../database/database.php');

    // Inisialisasi variabel search dan hasil
    $search = "";
    $resultFound = false;
    $results = [];

    // Proses jika tombol search ditekan
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);

        // Query SQL untuk mencari Nama_Lengkap berdasarkan ID_Eksternal
        $sql = "SELECT Nama_Lengkap FROM pasien WHERE ID_Eksternal LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $resultFound = true;
            while ($row = $result->fetch_assoc()) {
                $results[] = $row["Nama_Lengkap"];
            }
        }
    }
    ?>

</head>

<body class="bg-gray-100">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Transaksi Penjualan</h1>

        <!-- Form untuk menambah transaksi penjualan -->
        <form method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div>
                    <label for="Nama_Dokter" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <select name="Nama_Dokter" id="select-pasien" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        // Query untuk mendapatkan data dokter
                        $sql = "SELECT * FROM pasien";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Pasien'] . '">' . $row['Nama_Lengkap']. " | ". $row['ID_Eksternal'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                    <!-- Tampilkan hasil pencarian jika ditemukan -->
                    <?php if ($resultFound): ?>
                        <ul class="mt-4 bg-white p-4 rounded-lg shadow-md">
                            <?php foreach ($results as $name): ?>
                                <li><?php echo htmlspecialchars($name); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php elseif (isset($_GET['search'])): ?>
                        <!-- Tampilkan pesan jika tidak ditemukan hasil -->
                        <p class="mt-4 text-red-500">No results found for "<?php echo htmlspecialchars($search); ?>"</p>
                    <?php endif; ?>

                </div>

                <!-- Field lainnya -->
                <div>
                    <label for="Alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="Alamat" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Formulir lainnya bisa dilanjutkan -->
                <!-- Contoh: Nomor Telepon -->
                <div>
                    <label for="Stok" class="block text-sm font-medium text-gray-700">No. Telepon</label>
                    <input type="number" name="Stok" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Nama Dokter -->
                <div>
                    <label for="Nama_Dokter" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                    <select name="Nama_Dokter" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        // Query untuk mendapatkan data dokter
                        $sql = "SELECT * FROM dokter";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Dokter'] . '">' . $row['Nama_Dokter'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Nama Apoteker -->
                <div>
                    <label for="Apoteker" class="block text-sm font-medium text-gray-700">Apoteker</label>
                    <select name="Jabatan" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        // Query untuk mendapatkan data apoteker (karyawan)
                        $sql = "SELECT * FROM karyawan";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Karyawan'] . '">' . $row['Nama'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="col-span-2">
                    <button name="submit" type="submit" class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#select-pasien').select2();
});
</script>
