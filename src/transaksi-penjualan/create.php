<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../src/assets/css/output.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-3xl p-8 bg-white shadow-lg rounded-lg">
            <h2 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Tambah Transaksi</h2>

            <form method="POST" class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Tanggal & Waktu -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="Tanggal_Waktu" class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
                    <input type="date" name="Tanggal_Waktu"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Kode Jenis Layanan -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="Kode_Jenis_Layanan" class="block text-sm font-medium text-gray-700">Kode Jenis Layanan</label>
                    <input type="text" name="Kode_Jenis_Layanan"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Kode Provider CPT -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="Kode_Provider_CPT" class="block text-sm font-medium text-gray-700">Kode Provider CPT</label>
                    <input type="text" name="Kode_Provider_CPT"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Total Harga Obat -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="Total_Harga_Obat" class="block text-sm font-medium text-gray-700">Total Harga Obat</label>
                    <input type="number" name="Total_Harga_Obat"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Metode Pembayaran -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="Metode_Pembayaran" class="block text-sm font-medium text-gray-700">Metode Pembayaran</label>
                    <input type="text" name="Metode_Pembayaran"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- Sumber Pembayaran -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="Sumber_Pembayaran" class="block text-sm font-medium text-gray-700">Sumber Pembayaran</label>
                    <input type="text" name="Sumber_Pembayaran"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <!-- ID Karyawan -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="ID_Karyawan" class="block text-sm font-medium text-gray-700">ID Karyawan</label>
                    <select name="ID_Karyawan"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        include('../database/database.php');
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

                <!-- ID Resep -->
                <div class="col-span-2 sm:col-span-1">
                    <label for="ID_Resep" class="block text-sm font-medium text-gray-700">ID Resep</label>
                    <select name="ID_Resep"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        include('../database/database.php');
                        $sql = "SELECT * FROM resep";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Resep'] . '">' . $row['Catatan_Resep'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="col-span-2">
                    <button name="submit" type="submit"
                        class="w-full bg-green-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
