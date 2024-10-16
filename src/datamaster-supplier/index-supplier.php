<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        // Script untuk mengatur dropdown visibility
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>

</head>

<body class="bg-green-100 text-gray-900 ">
    <?php include('../template/sidebar.php'); ?>
    <!-- Container utama dengan margin kiri untuk menghindari tumpang tindih dengan sidebar -->
    <div class="flex-grow ml-64 mx-auto p-6">
        <!-- Header -->
        <h1 class="text-2xl font-bold mb-4">Data Supplier</h1>

        <!-- Tombol Tambah Data diposisikan di bawah teks Data Obat -->
        /* From Uiverse.io by EcheverriaJesus */ 
<button
a href="/apoteku/src/datamaster-supplier/create-supplier.php"
class="flex justify-center items-center gap-2 w-28 h-12 cursor-pointer rounded-md shadow-2xl text-white font-semibold bg-gradient-to-r from-[#14b8a6] via-[#059669] to-[#047857] hover:shadow-xl hover:shadow-green-500 hover:scale-105 duration-300 hover:from-[#047857] hover:to-[#14b8a6]">
                Tambah Data
            </a>
  
  <svg class="w-5 fill-white" viewBox="0 0 15 15">

      class="w-6 h-6"
      stroke="currentColor"
      stroke-width="1.5"
      viewBox="0 0 24 24"
      fill="none"
      xmlns="http://www.w3.org/2000/svg"
    
      <path>
        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
        stroke-linejoin="round"
        stroke-linecap="round"
      </path>
    
  </svg>
</button>

        <div class="mb-6">
            <a href="/apoteku/src/datamaster-supplier/create-supplier.php"
                class="bg-green-800 text-white py-3 px-3 rounded-lg hover:bg-green-700 text-sm">
                Tambah Data
            </a>
        </div>

        <!-- Tabel -->
        <div class=" bg-white shadow-md rounded-lg overflow-x-auto w-full">
            <table class="w-full text-left border border-gray-300">
                <thead class="bg-gray-400">
                    <tr>
                        <th class=" px-6 py-4">ID Supplier</th>
                        <th class=" px-6 py-4">Nama Supplier</th>
                        <th class=" px-6 py-4">Kontak</th>
                        <th class=" px-6 py-4">Alamat</th>
                        <th class=" px-6 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('../database/database.php');
                    // Query untuk menampilkan data dengan kolom Harga_Beli dan Harga_Jual
                    $sql = "SELECT s.ID_Supplier, s.Nama_Supplier, s.Kontak, s.Alamat
            FROM supplier s";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        // Tampilkan error jika query gagal
                        die("Query failed: " . mysqli_error($conn));
                    }
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="border-b hover:bg-gray-100">
                <td class="px-6 py-auto">' . $row['ID_Supplier'] . '</td>
                <td class="px-6 py-auto">' . $row['Nama_Supplier'] . '</td>
                <td class="px-6 py-auto">' . $row['Kontak'] . '</td>
                <td class="px-6 py-auto">' . $row['Alamat'] . '</td>
                <td class="flex gap-x-4 justify-center">
                    <a href="/apoteku/src/datamaster-supplier/update_supplier.php?id=' . $row['ID_Supplier'] . '" class="btn bg-yellow-500 hover:shadow-md hover:bg-yellow-600 group text-sm">
                        <i class="bi bi-pencil-square transition-all"></i>
                    </a>
                    <a onclick="return confirm(\'Are you sure you want to delete this Data?\');" href="delete-supplier.php?id=' . $row['ID_Supplier'] . '" class="btn bg-red-500 hover:shadow-md hover:bg-red-600 group text-sm">
                        <i class="bi bi-trash-fill transition-all"></i>
                    </a>
                </td>
            </tr>';
                        }
                    }
                    ?>

</body>