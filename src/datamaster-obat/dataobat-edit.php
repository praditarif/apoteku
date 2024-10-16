<?php
include('../database/database.php');

// Inisialisasi variabel
$id_obat = $nama_obat = $code = $formulasi = $tanggal_kadaluarsa = $stok = $supplier = $status = $package = $harga_beli = $harga_jual = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header('Location: /apoteku/src/datamaster-obat/dataobat.php');
        exit;
    }

    $id_obat = $_GET['id'];

    $sql = "SELECT * FROM obat WHERE ID_Obat = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_obat);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        header('Location: /apoteku/src/datamaster-obat/dataobat.php');
        exit;
    }

    $row = $result->fetch_assoc();

    $nama_obat = $row['Nama_Obat'];
    $code = $row['Code'];
    $formulasi = $row['Formulasi'];
    $tanggal_kadaluarsa = $row['Tanggal_Kadaluarsa'];
    $stok = $row['Stok'];
    $supplier = $row['ID_Supplier'];
    $status = $row['Status'];
    $package = $row['Package'];
    $harga_beli = $row['Harga_Beli'];
    $harga_jual = $row['Harga_Jual'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_obat = $_POST['ID_Obat'];
    $nama_obat = $_POST['Nama_Obat'];
    $code = $_POST['Code'];
    $formulasi = $_POST['Formulasi'];
    $tanggal_kadaluarsa = $_POST['Tanggal_Kadaluarsa'];
    $stok = $_POST['Stok'];
    $supplier = $_POST['Supplier'];
    $status = $_POST['Status'];
    $package = $_POST['Package'];
    $harga_beli = $_POST['Harga_Beli'];
    $harga_jual = $_POST['Harga_Jual'];

    if (empty($nama_obat) || empty($code) || empty($formulasi) || empty($tanggal_kadaluarsa) || empty($stok) || empty($supplier) || empty($status) || empty($package) || empty($harga_beli) || empty($harga_jual)) {
        echo "<script>alert('Please fill all the fields')</script>";
    } else {
        $sql = "UPDATE obat SET 
            Nama_Obat = ?, Code = ?, Formulasi = ?, Tanggal_Kadaluarsa = ?, Stok = ?, ID_Supplier = ?, Status = ?, Package = ?, Harga_Beli = ?, Harga_Jual = ?
            WHERE ID_Obat = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "ssssisssddi",
            $nama_obat,
            $code,
            $formulasi,
            $tanggal_kadaluarsa,
            $stok,
            $supplier,
            $status,
            $package,
            $harga_beli,
            $harga_jual,
            $id_obat
        );

        if ($stmt->execute()) {
            $successMessage = 'Obat berhasil diupdate!';
            header('Location: /apoteku/src/datamaster-obat/dataobat.php');
            exit;
        } else {
            echo "<script>alert('Failed to update obat')</script>";
            die("Error in query: " . mysqli_error($conn));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku - Edit Data Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-blue-100">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Data Obat</h1>

        <form action="dataobat-edit.php" method="POST" class="bg-white p-6 rounded-lg shadow-lg">
            <input type="hidden" name="ID_Obat" value="<?php echo $id_obat; ?>">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <div>
                    <label for="Nama_Obat" class="block text-sm font-medium text-gray-700">Nama Obat</label>
                    <input type="text" name="Nama_Obat" value="<?php echo $nama_obat; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Code" class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="Code" value="<?php echo $code; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Formulasi" class="block text-sm font-medium text-gray-700">Formulasi</label>
                    <input type="text" name="Formulasi" value="<?php echo $formulasi; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Tanggal_Kadaluarsa" class="block text-sm font-medium text-gray-700">Tanggal Kadaluarsa</label>
                    <input type="date" name="Tanggal_Kadaluarsa" value="<?php echo $tanggal_kadaluarsa; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Stok" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="Stok" value="<?php echo $stok; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Supplier" class="block text-sm font-medium text-gray-700">Supplier</label>
                    <input type="text" name="Supplier" value="<?php echo $supplier; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input type="text" name="Status" value="<?php echo $status; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Package" class="block text-sm font-medium text-gray-700">Package</label>
                    <input type="text" name="Package" value="<?php echo $package; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Harga_Beli" class="block text-sm font-medium text-gray-700">Harga Beli</label>
                    <input type="number" name="Harga_Beli" value="<?php echo $harga_beli; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div>
                    <label for="Harga_Jual" class="block text-sm font-medium text-gray-700">Harga Jual</label>
                    <input type="number" name="Harga_Jual" value="<?php echo $harga_jual; ?>"
                        class="mt-1 block w-full p-3 text-lg rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <div class="sm:col-span-2 flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Update</button>
                </div>
            </div>
        </form>
    </div>

</body>

</html>
