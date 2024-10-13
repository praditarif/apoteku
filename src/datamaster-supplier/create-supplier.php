<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Tambah Data Supplier</title>
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
        $Nama_Supplier = $_POST['Nama_Supplier'];
        $Kontak = $_POST['Kontak'];
        $Alamat = $_POST['Alamat'];
       
        // Validasi input
        do {
            if (empty($Nama_Supplier) || empty($Kontak) || empty($Alamat)) {
                echo "<script>alert('Please fill all the fields')</script>";
                break;
            } else {
                // Query untuk memasukkan data supplier ke dalam tabel supplier
                $sql = "INSERT INTO supplier (Nama_Supplier, Kontak, Alamat) 
                        VALUES ('$Nama_Supplier', '$Kontak', '$Alamat')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Supplier has been created successfully');</script>";
                    echo "<script>window.location.href = 'index-supplier.php';</script>"; // Redirect setelah berhasil
                } else {
                    echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
                }
                mysqli_close($conn);
            }
        } while (false);
    }
    ?>
</head>

<body class="bg-green-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Tambah Data Supplier</h1>
        <form method="POST">
            <div class="grid grid-cols-1 gap-4">

                <!-- Nama Supplier -->
                <div>
                    <label for="Nama_Supplier" class="block mb-2 font-medium">Nama Supplier</label>
                    <input type="text" name="Nama_Supplier" class="input input-bordered input-primary w-full max-w-xs" required>
                </div>

                <!-- Kontak -->
                <div>
                    <label for="Kontak" class="block mb-2 font-medium">Kontak</label>
                    <input type="text" name="Kontak" class="input input-bordered input-primary w-full max-w-xs" required>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="Alamat" class="block mb-2 font-medium">Alamat</label>
                    <input type="text" name="Alamat" class="input input-bordered input-primary w-full max-w-xs" required>
                </div>

                <!-- Tombol Submit -->
                <div>
                    <button name="submit" type="submit" class="bg-green-500 opacity-95 text-white btn hover:bg-green-600 hover:opacity-100">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
