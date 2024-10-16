<?php
include('../database/database.php');

// Inisialisasi variabel
$id_supplier = $nama_supplier = $kontak = $alamat = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Cek apakah ID supplier ada di URL
    if (!isset($_GET['id'])) {
        header('Location: /apoteku/src/datamaster-supplier/index-supplier.php');
        exit;
    }

    $id_supplier = $_GET['id'];

    // Query untuk mengambil data supplier berdasarkan ID
    $sql = "SELECT * FROM supplier WHERE ID_Supplier = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_supplier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        // Jika data tidak ditemukan, redirect ke halaman data supplier
        header('Location: /apoteku/src/datamaster-supplier/index-supplier.php');
        exit;
    }

    $row = $result->fetch_assoc();

    // Mengisi variabel dari hasil query
    $nama_supplier = $row['Nama_Supplier'];
    $kontak = $row['Kontak'];
    $alamat = $row['Alamat'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan data dari form POST
    $id_supplier = $_POST['ID_Supplier'];
    $nama_supplier = $_POST['Nama_Supplier'];
    $kontak = $_POST['Kontak'];
    $alamat = $_POST['Alamat'];

    // Validasi form
    if (empty($nama_supplier) || empty($kontak) || empty($alamat)) {
        echo "<script>alert('Please fill all the fields')</script>";
    } else {
        // Query untuk mengupdate data supplier
        $sql = "UPDATE supplier SET 
            Nama_Supplier = ?, Kontak = ?, Alamat = ?
            WHERE ID_Supplier = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $nama_supplier, $kontak, $alamat, $id_supplier);

        if ($stmt->execute()) {
            $successMessage = 'Supplier berhasil diupdate!';
            header('Location: /apoteku/src/datamaster-supplier/index-supplier.php');
            exit;
        } else {
            echo "<script>alert('Failed to update supplier')</script>";
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
    <title>Edit Data Supplier</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <!-- Container utama -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Edit Data Supplier</h1>
        
        <!-- Form Edit Supplier -->
        <form action="update-supplier.php" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            <input type="hidden" name="ID_Supplier" value="<?php echo $id_supplier; ?>">

            <div class="mb-4">
                <label for="Nama_Supplier" class="block text-sm font-medium text-gray-700">Nama Supplier</label>
                <input type="text" name="Nama_Supplier" value="<?php echo $nama_supplier; ?>" class="border border-gray-300 rounded-lg w-full p-2">
            </div>

            <div class="mb-4">
                <label for="Kontak" class="block text-sm font-medium text-gray-700">Kontak</label>
                <input type="text" name="Kontak" value="<?php echo $kontak; ?>" class="border border-gray-300 rounded-lg w-full p-2">
            </div>

            <div class="mb-4">
                <label for="Alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <input type="text" name="Alamat" value="<?php echo $alamat; ?>" class="border border-gray-300 rounded-lg w-full p-2">
            </div>

            <div class="sm:col-span-2 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-500">Update</button>
            </div>
        </form>
    </div>
</body>

</html>
