<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script defer>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-gray-100">
    <?php
// Include the database connection and sidebar
include('../template/sidebar.php');
include('../../src/database/database.php');

if (isset($_POST['submit'])) {
    // Collect the form data
    $Nama_Lengkap = $_POST['Nama_Lengkap'];
    $Nama_Dokter = $_POST['Nama_Dokter'];
    $Apoteker = $_POST['Apoteker'];
    $Tanggal_Transaksi = $_POST['Tanggal_Transaksi'];
    $Tambah_Obat = $_POST['Tambah_Obat']; // This is the ID of the selected drug
    $Jumlah = $_POST['Jumlah'];
    $Total_Harga = $_POST['Total_Harga'];
    $Total_Bayar = $_POST['Total_Bayar'];
    $Kembali = $_POST['Kembali'];
    $Sumber = $_POST['Sumber'];

    // Ensure all required fields are filled
    if (empty($Nama_Lengkap) || empty($Nama_Dokter) || empty($Apoteker) || empty($Tanggal_Transaksi) || empty($Tambah_Obat) || empty($Jumlah) || empty($Total_Harga) || empty($Total_Bayar) || empty($Kembali) || empty($Sumber)) {
        echo "<script>alert('Please fill all the fields');</script>";
    } else {
        // Insert the data into the `detail_resep` table
        $sql = "INSERT INTO detail_resep (ID_Resep, ID_Obat, Jumlah)
                VALUES ('$Nama_Lengkap', '$Tambah_Obat', '$Jumlah')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Transaction successfully added!');</script>";
        } else {
            echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Transaksi Penjualan</h1>

        <!-- Form untuk menambah transaksi penjualan -->
        <form method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="Nama_Pasien" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <select name="Nama_Lengkap" id="select-pasien" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                        
                <!-- Nama Dokter -->
                <div>
                    <label for="Nama_Dokter" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                    <select name="Nama_Dokter" id="select-dokter" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                    <select name="Apoteker" id="select-apoteker" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                <div>
                    <label for="Tanggal_Transaksi" class="block text-sm font-medium text-gray-700">Tanggal
                        Transaksi</label>
                    <input type="date" name="Tanggal_Transaksi"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
    <label for="select-obat" class="block text-sm font-medium text-gray-700">Tambah Resep Obat</label>
    <select name="Tambah_Obat" id="select-obat" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        <option value="" disabled selected>Pilih Obat</option>
        <?php
        // Query untuk mendapatkan data obat
        $sql = "SELECT * FROM obat";
        $result = mysqli_query($conn, $sql);

        // Memastikan query berhasil
        if ($result && mysqli_num_rows($result) > 0) {
            // Menampilkan opsi untuk setiap obat
            while ($row = mysqli_fetch_assoc($result)) {
                // Menggunakan htmlspecialchars untuk mencegah XSS
                echo '<option value="' . htmlspecialchars($row['ID_Obat']) . '">' 
                        . htmlspecialchars($row['Nama_Obat']) . " | Rp " . number_format($row['Harga_Jual'], 0, ',', '.') 
                    . '</option>';
            }
        } else {
            echo '<option value="">Data obat tidak ditemukan</option>';
        }
        ?>
    </select>
</div>

                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Jumlah</label>
                    <input type="number" name="Jumlah"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Total Harga</label>
                    <input type="number" name="Total_Harga"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Total Bayar</label>
                    <input type="number" name="Total_Bayar"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Kembali</label>
                    <input type="number" name="Kembali"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Sumber Pembayaran</label>
                    <input type="text" name="Sumber"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <!-- Tombol Submit -->
                <div class="col-span-2">
                    <button name="submit" type="submit"
                        class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
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
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#select-dokter').select2();
});
</script>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#select-apoteker').select2();
});
</script>
<script>
    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#select-obat').select2();
});
</script>