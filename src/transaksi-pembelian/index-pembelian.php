<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Transaksi Pembelian - Apoteku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        // Function to calculate total price
        function calculateTotal() {
            const stok = document.getElementById('stok').value;
            const hargaBeli = document.getElementById('harga_beli').value;
            const total = stok * hargaBeli;
            document.getElementById('total_harga').value = total;
        }
    </script>
</head>

<body class="bg-blue-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Transaksi Pembelian</h1>

        <!-- Form Transaksi Pembelian -->
        <form action="" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label for="id_obat" class="block text-gray-700 text-sm font-bold mb-2">Nama Obat:</label>
                <select name="id_obat" id="id_obat" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Obat --</option>
                    <?php
                    include('../database/database.php');
                    // Query untuk menampilkan data obat
                    $sql = "SELECT ID_Obat, Nama_Obat, Formulasi, Tanggal_Kadaluarsa FROM obat";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['ID_Obat']}'>{$row['Nama_Obat']} - {$row['Formulasi']} (Exp: {$row['Tanggal_Kadaluarsa']})</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data obat</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="stok" class="block text-gray-700 text-sm font-bold mb-2">Stok:</label>
                <input type="number" name="stok" id="stok" class="w-full p-2 border border-gray-300 rounded-lg" required oninput="calculateTotal()">
            </div>

            <div class="mb-4">
                <label for="harga_beli" class="block text-gray-700 text-sm font-bold mb-2">Harga Beli:</label>
                <input type="number" name="harga_beli" id="harga_beli" class="w-full p-2 border border-gray-300 rounded-lg" required oninput="calculateTotal()">
            </div>

            <div class="mb-4">
                <label for="supplier" class="block text-gray-700 text-sm font-bold mb-2">Supplier:</label>
                <select name="supplier" id="supplier" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Supplier --</option>
                    <?php
                    // Query untuk menampilkan data supplier
                    $sql = "SELECT ID_Supplier, Nama_Supplier FROM supplier";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['ID_Supplier']}'>{$row['Nama_Supplier']}</option>";
                        }
                    } else {
                        echo "<option value=''>Tidak ada data supplier</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="package" class="block text-gray-700 text-sm font-bold mb-2">Package:</label>
                <input type="text" name="package" id="package" class="w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
                <select name="status" id="status" class="w-full p-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Status --</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Belum Lunas">Belum Lunas</option>
                </select>
            </div>

            <!-- Input untuk Total Harga -->
            <div class="mb-4">
                <label for="total_harga" class="block text-gray-700 text-sm font-bold mb-2">Total Harga:</label>
                <input type="number" id="total_harga" class="w-full p-2 border border-gray-300 rounded-lg" readonly>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Tambah Transaksi</button>
            </div>
        </form>

        <!-- Proses Form -->
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id_obat = $_POST['id_obat'];   // Menggunakan sesuai dengan name di form
    $stok = $_POST['stok'];
    $harga_beli = $_POST['harga_beli'];
    $supplier = $_POST['supplier'];
    $package = $_POST['package'];
    $status = $_POST['status'];  // Status bisa digunakan untuk menandai transaksi pembayaran
    
    // Validasi input
    if (empty($id_obat) || empty($stok) || empty($harga_beli) || empty($supplier) || empty($package)) {
        echo "<p class='mt-4 text-red-500'>Semua kolom wajib diisi.</p>";
    } else {
        // Query untuk menyimpan data transaksi ke dalam tabel pembelian
        $sql = "INSERT INTO pembelian (ID_Obat, Jumlah_Obat, Harga_Beli, ID_Supplier, Package, Status) 
                VALUES ('$id_obat', '$stok', '$harga_beli', '$supplier', '$package', '$status')";

        if (mysqli_query($conn, $sql)) {
            echo "<p class='mt-4 text-green-500'>Transaksi berhasil ditambahkan.</p>";

            // Update stok obat di tabel obat
            $sql_update_stok = "UPDATE obat SET Stok = Stok + $stok WHERE ID_Obat = '$id_obat'";
if (mysqli_query($conn, $sql_update_stok)) {
    echo "<p class='mt-2 text-green-500'>Stok obat berhasil diperbarui.</p>";
} else {
    echo "<p class='mt-2 text-red-500'>Error memperbarui stok: " . mysqli_error($conn) . "</p>";
}

        } else {
            // Tampilkan error jika query insert gagal
            echo "<p class='mt-4 text-red-500'>Error menambahkan transaksi: " . mysqli_error($conn) . "</p>";
        }
    }

    mysqli_close($conn);
}
?>

    </div>
</body>

</html>
