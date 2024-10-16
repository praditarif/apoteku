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

<body class="bg-gray-100">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Data Supplier</h1>

        <form method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid-cols-1 gap-6">

                <div class="mb-6">
                    <label for="Nama_Supplier" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                    <input type="text" name="Nama_Supplier" class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="Kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
                    <input type="text" name="Kontak" class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="mb-6">
                    <label for="Alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                    <input type="text" name="Alamat" class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                </div>

                <div class="sm:col-span-2 p-6 flex justify-end">
                    <button name="submit" type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500">
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
