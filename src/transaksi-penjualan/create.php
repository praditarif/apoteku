<?php
// URL endpoint API pasien
$apiUrl = "https://rawat-jalan.pockethost.io/api/collections/pasien/records";

// Mengambil data dari API pasien
$response = file_get_contents($apiUrl);

// Mengonversi JSON response menjadi array PHP
$data = json_decode($response, true);
$items = $data['items'];
?>
<?php
// URL endpoint API untuk data dokter
$apiUrlDokter = "https://0sr024r8-3000.asse.devtunnels.ms/api/dokter/";

// Mengambil data dari API dokter dengan penanganan error
$responseDokter = @file_get_contents($apiUrlDokter);

// Memeriksa apakah respons berhasil diambil
if ($responseDokter === false) {
    echo '<div>Error: Tidak dapat mengakses API dokter. Pastikan URL API benar atau server aktif.</div>';
    $itemsDokter = []; // Kosongkan array untuk menghindari error di bagian berikutnya
} else {
    // Mengonversi JSON response dokter menjadi array PHP
    $dataDokter = json_decode($responseDokter, true);

    // Memastikan data dokter valid dan payload tersedia
    if (isset($dataDokter['payload']) && is_array($dataDokter['payload'])) {
        $itemsDokter = $dataDokter['payload'];
    } else {
        echo '<div>Error: Format data API dokter tidak sesuai.</div>';
        $itemsDokter = []; // Kosongkan array untuk menghindari error di bagian berikutnya
    }
}
?>

<!DOCTYPE html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.7.7/axios.min.js"
        integrity="sha512-DdX/YwF5e41Ok+AI81HI8f5/5UsoxCVT9GKYZRIzpLxb8Twz4ZwPPX+jQMwMhNQ9b5+zDEefc+dcvQoPWGNZ3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle('hidden');
}

$(document).ready(function() {
    let totalHarga = 0; // Total harga transaksi
    let detailResep = [];

    // Add an item to the list of drugs (cards)
    $('#add-obat').click(function() {
        const obatID = $('#select-obat').val();
        const jumlah = $('#Jumlah').val();
        const hargaObat = parseInt($('#select-obat option:selected').data('harga')) || 0;
        const obatName = $('#select-obat option:selected').text().split(' ')[0];

        if (!obatID || !jumlah || jumlah <= 0) {
            alert('Please select a valid drug and quantity.');
            return;
        }

        // Calculate the price for this drug
        const totalObatHarga = hargaObat * jumlah;

        // Add the drug to the card list
        $('#obat-list').append(`
            <div class="card mb-2 flex flex-row items-center justify-between p-2 bg-gray-200 rounded">
                <span>${obatName} - ${jumlah} x Rp ${hargaObat.toLocaleString()} = Rp ${totalObatHarga.toLocaleString()}</span>
                <button class="remove-obat bg-red-500 text-white rounded px-2 py-1 hover:bg-red-600">Hapus</button>
                <input type="hidden" name="obat_ids[]" value="${obatID}">
                <input type="hidden" name="obat_jumlah[]" value="${jumlah}">
                <input type="hidden" name="obat_harga[]" value="${totalObatHarga}">
            </div>
        `);

        // Update the total transaction price
        totalHarga += totalObatHarga;
        $('#total-harga').text(`Rp ${totalHarga.toLocaleString()}`);
        $('#total-harga-input').val(totalHarga);

        // Update detail resep
        if (!detailResep.includes(obatName)) {
            detailResep.push(obatName);
            $('#detail-resep').val(
                detailResep.map((drugName) => `${drugName}:`).join('\n')
            );
        }
    });

    // Function to remove a drug from the list
    $('#obat-list').on('click', '.remove-obat', function() {
        const obatHarga = parseInt($(this).closest('.card').find('input[name="obat_harga[]"]').val()) || 0;
        $(this).closest('.card').remove();
        totalHarga -= obatHarga;
        $('#total-harga').text(`Rp ${totalHarga.toLocaleString()}`);
        $('#total-harga-input').val(totalHarga);
    });

    // Event listener untuk input Total Bayar
    document.getElementById('total-bayar').addEventListener('input', function() {
                        const totalBayar = parseInt(this.value) || 0; // Ambil nilai Total Bayar
                        const kembali = totalBayar - totalHarga; // Hitung Kembalian
                        document.getElementById('kembali').value = kembali >= 0 ? kembali : 0; // Tampilkan Kembalian

    });
});
</script>

</head>

<body class="bg-blue-100">
<?php
// Include the database connection and sidebar
include('../template/sidebar.php');
include('../database/database.php');

if (isset($_POST['submit'])) {
    // Collect the form data
    $ID_Pasien = $_POST['ID_Pasien'];
    $ID_Dokter = $_POST['ID_Dokter'];
    $ID_Karyawan = $_POST['ID_Karyawan'];
    $Tanggal_Transaksi = $_POST['Tanggal_Transaksi'];
    $Total_Harga = $_POST['Total_Harga'];
    $Total_Bayar = $_POST['Total_Bayar'];
    $Kembali = $_POST['Kembali'];
    $Sumber_Pembayaran = $_POST['Sumber_Pembayaran'];
    $Detail_Resep = $_POST['Detail_Resep'];

    // Ensure all required fields are filled
    if (empty($ID_Karyawan) || empty($ID_Pasien) || empty($Tanggal_Transaksi) || empty($Total_Bayar) || empty($Kembali) || empty($Sumber_Pembayaran) || empty($ID_Dokter) || empty($Detail_Resep)) {
        echo "<script>alert('Please fill all the fields');</script>";
    } else {
        // Check if the ID_Karyawan exists in the karyawan table
        $check_karyawan = "SELECT * FROM karyawan WHERE ID_Karyawan = '$ID_Karyawan'";
        $result_karyawan = mysqli_query($conn, $check_karyawan);

        if (mysqli_num_rows($result_karyawan) == 0) {
            echo "<script>alert('ID Karyawan tidak valid!');</script>";
        } else {
            // Insert the data into the `transaksi` table
            $sql = "INSERT INTO transaksi (ID_Karyawan, ID_Pasien, ID_Dokter, Tanggal_Transaksi, Total_Harga, Total_Bayar, Kembali, Sumber_Pembayaran, Detail_Resep)
                            VALUES ('$ID_Karyawan', '$ID_Pasien', '$ID_Dokter', '$Tanggal_Transaksi', '$Total_Harga', '$Total_Bayar', '$Kembali', '$Sumber_Pembayaran', '$Detail_Resep')";

            if (mysqli_query($conn, $sql)) {
                // Reduce stock for each drug in the transaction
                for ($i = 0; $i < count($_POST['obat_ids']); $i++) {
                    $obatID = $_POST['obat_ids'][$i];
                    $jumlah = $_POST['obat_jumlah'][$i];

                    // Reduce stock in the obat table
                    $update_stock = "UPDATE obat SET Stok = Stok - $jumlah WHERE ID_Obat = '$obatID'";
                    mysqli_query($conn, $update_stock);
                }

                // If transaction and stock update succeed, redirect to index.php
                echo "<script>
                        alert('Transaction successfully added and stock updated!');
                        window.location.href = 'index.php';
                      </script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 p-4 rounded-lg shadow">Tambah Transaksi Penjualan</h1>

        <!-- Form untuk menambah transaksi penjualan -->
        <form method="POST" class="bg-white p-6 rounded-lg shadow-lg space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Nama Pasien -->
                <div>
                    <label for="Nama_Pasien" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <select name="ID_Pasien" id="select-pasien"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        // Memeriksa apakah data berhasil diambil
                        if ($data) {
                            foreach ($items as $item) {
                                echo '<option value="' . $item['nama_lengkap'] . '">' . $item['nama_lengkap'] . ' | ' . $item['id_eksternal'] . '</option>';
                            }
                        } else {
                            echo '<option>Error mengambil data dari API</option>';
                        }
                        ?>
                    </select>
                </div>

                <!-- Nama Dokter -->
                <div>
                    <label for="Nama_Dokter" class="block text-sm font-medium text-gray-700">Nama Dokter</label>
                    <select name="ID_Dokter" id="select-dokter"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        // Memeriksa apakah data dokter berhasil diambil dan items ada
                        if (!empty($itemsDokter)) {
                            foreach ($itemsDokter as $dokter) {
                                // Memastikan 'id' dan 'Nama' ada di setiap item
                                if (isset($dokter['ID_Dokter']) && isset($dokter['Nama'])) {
                                    echo '<option value="' . htmlspecialchars($dokter['Nama']) . '">' . htmlspecialchars($dokter['Nama']) . '</option>';
                                } else {
                                    echo '<option>Error: Data dokter tidak lengkap.</option>';
                                }
                            }
                        } else {
                            echo '<option>Error: Data dokter tidak tersedia.</option>';
                        }
                        ?>
                    </select>
                </div>
                <!-- Nama Apoteker -->
                <div>
                    <label for="Apoteker" class="block text-sm font-medium text-gray-700">Apoteker</label>
                    <select name="ID_Karyawan" id="select-apoteker"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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

                <!-- Tanggal Transaksi -->
                <div>
                    <label for="Tanggal_Transaksi" class="block text-sm font-medium text-gray-700">Tanggal
                        Transaksi</label>
                    <input type="date" name="Tanggal_Transaksi"
                        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="mt-6">
                <label for="select-obat" class="block text-sm font-medium text-gray-700">Obat</label>
                <select id="select-obat"
                    class="select2 p-3 text-lg w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <?php
                    // Query hanya untuk obat dengan status 'tersedia'
                    $sql = "SELECT * FROM obat WHERE Status = 'tersedia'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['ID_Obat'] . '" data-harga="' . $row['Harga_Jual'] . '">' . $row['Nama_Obat'] . " | " . $row['Status'] . '</option>';
                        }
                    } else {
                        echo '<option value="">Tidak ada obat tersedia</option>';
                    }
                    ?>
                </select>
            </div>

            <div class="mt-4">
                <label for="Jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" id="Jumlah" name="Jumlah"
                    class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Masukkan jumlah obat">
            </div>

            <div class="mt-6">
                <button type="button" id="add-obat"
                    class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Obat</button>
            </div>

            <div id="obat-list" class="mt-6 space-y-4">
                <!-- Obat yang sudah ditambahkan akan muncul di sini -->
            </div>

            <!-- Total Harga -->
            <div class="mt-4 flex justify-between">
                <label for="Total_Harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
                <span id="total-harga" class="text-lg font-bold">Rp 0</span>
                <input type="hidden" name="Total_Harga" id="total-harga-input" value="0">
            </div>
            <!-- Detail Resep -->
<div class="mt-4">
    <label for="Detail_Resep" class="block text-sm font-medium text-gray-700">Detail Resep</label>
    <textarea id="detail-resep" name="Detail_Resep" rows="5" 
        class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
        placeholder="Obat yang diresepkan akan muncul di sini..."></textarea>
</div>


            <div class="mt-4">
                <label for="Total_Bayar" class="block text-sm font-medium text-gray-700">Total Bayar</label>
                <input type="number" name="Total_Bayar" id="total-bayar"
                    class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
            </div>

            <div>
                <label for="Kembali" class="block text-sm font-medium text-gray-700">Kembalian</label>
                <input type="number" name="Kembali" id="kembali" readonly
                    class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>



            <div>
                <label for="Sumber_Pembayaran" class="block text-sm font-medium text-gray-700">Sumber Pembayaran</label>
                <select name="Sumber_Pembayaran" id="select-pembayaran"
                    class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="Cash">Cash</option>
                    <option value="Transfer">Transfer</option>
                    <option value="BPJS">BPJS</option>
                </select>
            </div>

            <div class="mt-6 flex justify-between">
                <button type="submit" name="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Submit</button>
                <button type="reset" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded">Reset</button>
                 
            </div>
            
        </form>
    </div>
</body>


<!-- Skrip untuk menambahkan fungsi Select2 -->
<script>
    $(document).ready(function() {
        $('#select-pasien').select2();
        $('#select-dokter').select2();
        $('#select-apoteker').select2();
        $('#select-obat').select2();
        $('#select-pembayaran').select2();
    });

    const url = "https://rawat-jalan.pockethost.io/api/collections/pasien/records";

    const pasienSelect = document.getElementById('select-pasien');
</script>

</body>

</html>