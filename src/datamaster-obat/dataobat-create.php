<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Tambah Data Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-blue-100">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Data Obat</h1>

        <form method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- Nama Obat -->
                <div>
                    <label for="Nama_Obat" class="block text-sm font-medium text-gray-700">Nama Obat</label>
                    <input type="text" name="Nama_Obat"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Code -->
                <div>
                    <label for="Code" class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="Code"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Formulasi -->
                <div>
                    <label for="Formulasi" class="block text-sm font-medium text-gray-700">Formulasi</label>
                    <input type="text" name="Formulasi"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Tanggal Kadaluarsa -->
                <div>
                    <label for="Tanggal_Kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
                    <input type="date" name="Tanggal_Kadaluarsa"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Stok -->
                <div>
                    <label for="Stok" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="Stok"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Supplier -->
                <div>
                    <label for="ID_Supplier" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <select name="ID_Supplier"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
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
                    <label for="Status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="Status"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Package -->
                <div>
                    <label for="Package" class="block text-sm font-medium text-gray-700">Package</label>
                    <input type="text" name="Package"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Harga Beli -->
                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                    <input type="number" name="Harga_Beli"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Harga Jual -->
                <div>
                    <label for="Harga_Jual" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                    <input type="number" name="Harga_Jual"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Tombol Submit -->
                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Create</button>
                </div>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        include('../database/database.php');

        $Nama_Obat = $_POST['Nama_Obat'];
        $Code = $_POST['Code'];
        $Formulasi = $_POST['Formulasi'];
        $Tanggal_Kadaluarsa = $_POST['Tanggal_Kadaluarsa'];
        $Stok = $_POST['Stok'];
        $ID_Supplier = $_POST['ID_Supplier'];
        $Status = $_POST['Status'];
        $Package = $_POST['Package'];
        $Harga_Beli = $_POST['Harga_Beli'];
        $Harga_Jual = $_POST['Harga_Jual'];

        if (empty($Nama_Obat) || empty($Code) || empty($Formulasi) || empty($Tanggal_Kadaluarsa) || empty($Stok) || empty($ID_Supplier) || empty($Status) || empty($Package) || empty($Harga_Beli) || empty($Harga_Jual)) {
            echo "<script>alert('Please fill all the fields')</script>";
        } else {
            $sql = "INSERT INTO obat(Nama_Obat, Code, Formulasi, Tanggal_Kadaluarsa, Stok, ID_Supplier, Status, Package, Harga_Beli, Harga_Jual) 
                    VALUES ('$Nama_Obat', '$Code', '$Formulasi', '$Tanggal_Kadaluarsa', '$Stok', '$ID_Supplier', '$Status', '$Package', '$Harga_Beli', '$Harga_Jual')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Obat has been created successfully'); window.location.href = '/apoteku/src/datamaster-obat/dataobat.php';</script>";
            } else {
                echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    ?>

</body>

</html>
