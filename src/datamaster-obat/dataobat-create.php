<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Tambah Data Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

    <?php
    if (isset($_POST['submit'])) {
        include('../database/database.php');
        
        // Ambil data dari form
        $Nama_Obat = $_POST['Nama_Obat'];
        $Code = $_POST['Code'];
        $Formulasi = $_POST['Formulasi'];
        $Tanggal_Kadaluarsa = $_POST['Tanggal_Kadaluarsa'];
        $Stok = $_POST['Stok'];
        $ID_Supplier = $_POST['ID_Supplier'];
        $Status = $_POST['Status'];
        $Package = $_POST['Package'];
        $Harga_Beli = $_POST['Harga_Beli']; // Perbaiki dengan menggunakan Harga_Beli
        $Harga_Jual = $_POST['Harga_Jual']; // Perbaiki dengan menggunakan Harga_Jual

        // Validasi input
        do {
            if (empty($Nama_Obat) || empty($Code) || empty($Formulasi) || empty($Tanggal_Kadaluarsa) || empty($Stok) || empty($ID_Supplier) || empty($Status) || empty($Package) || empty($Harga_Beli) || empty($Harga_Jual)) {
                echo "<script>alert('Please fill all the fields')</script>";
                break;
            } else {
                // Query untuk memasukkan data obat ke dalam tabel
                $sql = "INSERT INTO obat(Nama_Obat, Code, Formulasi, Tanggal_Kadaluarsa, Stok, ID_Supplier, Status, Package, Harga_Beli, Harga_Jual) 
                        VALUES ('$Nama_Obat', '$Code', '$Formulasi', '$Tanggal_Kadaluarsa', '$Stok', '$ID_Supplier', '$Status', '$Package', '$Harga_Beli', '$Harga_Jual')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Obat has been created successfully');</script>";
                } else {
                    echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        } while (false);
    }
    ?>
</head>

<body>
    <?php include('../template/sidebar.php'); ?>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Data Obat</h1>
        <form method="POST">
            <div class="grid grid-cols-1 gap-4">

                <!-- Nama Obat -->
                <div>
                    <label for="Nama_Obat">Nama Obat</label>
                    <input type="text" name="Nama_Obat" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Code -->
                <div>
                    <label for="Code">Code</label>
                    <input type="text" name="Code" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Formulasi -->
                <div>
                    <label for="Formulasi">Formulasi</label>
                    <input type="text" name="Formulasi" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Tanggal Kadaluarsa -->
                <div>
                    <label for="Tanggal_Kadaluarsa">Tanggal Kadaluarsa</label>
                    <input type="date" name="Tanggal_Kadaluarsa" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Stok -->
                <div>
                    <label for="Stok">Stok</label>
                    <input type="number" name="Stok" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Supplier -->
                <div>
                    <label for="ID_Supplier">Supplier</label>
                    <select name="ID_Supplier" class="input input-bordered input-primary w-full max-w-xs">
                        <?php
                        include('../database/database.php');
                        $sql = "SELECT * FROM supplier";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<option value="' . $row['ID_Supplier'] . '">' . $row['Nama_Supplier'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label for="Status">Status</label>
                    <input type="text" name="Status" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Package -->
                <div>
                    <label for="Package">Package</label>
                    <input type="text" name="Package" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Harga Beli -->
                <div>
                    <label for="Harga_Beli">Harga Beli</label>
                    <input type="number" name="Harga_Beli" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Harga Jual -->
                <div>
                    <label for="Harga_Jual">Harga Jual</label>
                    <input type="number" name="Harga_Jual" class="input input-bordered input-primary w-full max-w-xs">
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button name="submit" type="submit" class="bg-green-500 opacity-95 text-white btn hover:bg-blues hover:opacity-100">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
