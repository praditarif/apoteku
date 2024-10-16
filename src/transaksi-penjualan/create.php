<!DOCTYPE html>

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

        $(document).ready(function () {
    let totalHarga = 0; // Total harga transaksi

    // Add an item to the list of drugs (cards)
    $('#add-obat').click(function () {
        const obatID = $('#select-obat').val();
        const obatName = $('#select-obat option:selected').text();
        const jumlah = $('#Jumlah').val();
        const hargaObat = parseInt($('#select-obat option:selected').data('harga')); // Get the price of the selected drug

        if (!obatID || !jumlah || jumlah <= 0) {
            alert('Please select a valid drug and quantity.');
            return;
        }

        // Calculate the price for this drug
        const totalObatHarga = hargaObat * jumlah;

        // Add the drug to the card list
        $('#obat-list').append(`
            <div class="card mb-2 flex items-center justify-between p-2 bg-gray-200 rounded">
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

        // Update hidden input to store total price
        $('#total-harga-input').val(totalHarga);
    });

    // Function to remove a drug from the list
    $('#obat-list').on('click', '.remove-obat', function () {
        const obatHarga = parseInt($(this).closest('.card').find('input[name="obat_harga[]"]').val());
        $(this).closest('.card').remove();
        totalHarga -= obatHarga;
        $('#total-harga').text(`Rp ${totalHarga.toLocaleString()}`);

        // Update hidden input to store total price
        $('#total-harga-input').val(totalHarga);
    });
});

    </script>
</head>

<body class="bg-gray-100">
    <?php
    // Include the database connection and sidebar
    include('../template/sidebar.php');
<<<<<<< HEAD
    include('../database/database.php');

=======
    include('../../src/database/database.php');
>>>>>>> a03124c4f6f82ca0a19e98e542e37936e3e085bf
    if (isset($_POST['submit'])) {
        // Collect the form data
        $ID_karyawan = $_POST['ID_Karyawan'];
        $ID_Pasien = $_POST['ID_Pasien'];
        $Tanggal_Transaksi = $_POST['Tanggal_Transaksi'];
        $Total_Harga = $_POST['Total_Harga'];
        $Total_Bayar = $_POST['Total_Bayar'];
        $Kembali = $_POST['Kembali'];
        $Sumber_Pembayaran = $_POST['Sumber_Pembayaran'];

        // Ensure all required fields are filled
        if (empty($ID_karyawan) || empty($ID_Pasien) || empty($Tanggal_Transaksi) || empty($Total_Bayar) || empty($Kembali) || empty($Sumber_Pembayaran)) {
            echo "<script>alert('Please fill all the fields');</script>";
        } else {
            // Check if the ID_Karyawan exists in the karyawan table
            $check_karyawan = "SELECT * FROM karyawan WHERE ID_Karyawan = '$ID_karyawan'";
            $result_karyawan = mysqli_query($conn, $check_karyawan);
            
            if (mysqli_num_rows($result_karyawan) == 0) {
                echo "<script>alert('ID Karyawan tidak valid!');</script>";
            } else {
                // Insert the data into the `transaksi` table
                $sql = "INSERT INTO transaksi (ID_Karyawan, ID_Pasien, Tanggal_Transaksi, Total_Harga, Total_Bayar, Kembali, Sumber_Pembayaran)
                        VALUES ('$ID_karyawan', '$ID_Pasien', '$Tanggal_Transaksi', $Total_Harga, $Total_Bayar, $Kembali, '$Sumber_Pembayaran')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Transaction successfully added!');</script>";
                } else {
                    echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
                }
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
                <!-- Nama Pasien -->
                <div>
                    <label for="Nama_Pasien" class="block text-sm font-medium text-gray-700">Nama Pasien</label>
                    <select name="ID_Pasien" id="select-pasien" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <?php
                        // Query untuk mendapatkan data pasien
                        $sql = "SELECT * FROM pasien";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Pasien'] . '">' . $row['Nama_Lengkap'] . " | " . $row['ID_Eksternal'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

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
                    <select name="ID_Karyawan" id="select-apoteker" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
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
                    <label for="Tanggal_Transaksi" class="block text-sm font-medium text-gray-700">Tanggal Transaksi</label>
                    <input type="date" name="Tanggal_Transaksi" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="mt-6">
                <label for="select-obat" class="block text-sm font-medium text-gray-700">Obat</label>
                <select id="select-obat" class="select2 p-3 text-lg w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <?php
                    $sql = "SELECT * FROM obat";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['ID_Obat'] . '" data-harga="' . $row['Harga_Jual'] . '">' . $row['Nama_Obat'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mt-4">
                <label for="Jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" id="Jumlah" name="Jumlah" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Masukkan jumlah obat">
            </div>

            <div class="mt-6">
                <button type="button" id="add-obat" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah Obat</button>
            </div>

            <div id="obat-list" class="mt-6 space-y-4">
                <!-- Obat yang sudah ditambahkan akan muncul di sini -->
            </div>

           <!-- Total Harga -->
<div class="mt-4 flex justify-between">
    <label for="Total_Harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
    <span id="total-harga" class="text-lg font-bold">Rp 0</span>
    <!-- Input hidden untuk menyimpan total harga yang dikirim ke server -->
    <input type="hidden" name="Total_Harga" id="total-harga-input">
</div>



            <div class="mt-4">
                <label for="Total_Bayar" class="block text-sm font-medium text-gray-700">Total Bayar</label>
                <input type="number" name="Total_Bayar" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>

             <div>
                    <label for="Kembali" class="block text-sm font-medium text-gray-700">Kembalian</label>
                    <input type="number" name="Kembali" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="Sumber_Pembayaran" class="block text-sm font-medium text-gray-700">Sumber Pembayaran</label>
                    <select name="Sumber_Pembayaran" id="select-pembayaran" class="mt-1 block w-full p-3 text-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                        <option value="BPJS">BPJS</option>
                    </select>
                </div>

            <div class="mt-6 flex justify-between">
                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">Submit</button>
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
    </script>

</body>

</html>

