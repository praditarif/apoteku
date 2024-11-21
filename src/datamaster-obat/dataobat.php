<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .button-click {
            transform: scale(0.95);
            transition: transform 0.15s ease;
        }
    </style>
</head>

<body class="bg-blue-100 text-gray-900">
    <?php include('../template/sidebar.php'); ?>

    <div class="flex-grow ml-64 mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Data Obat</h1>

        <!-- Bar pencarian -->
        <div class="flex justify-between items-center mb-6">
            <input id="searchInput" type="text" placeholder="Cari Obat..."
                class="px-4 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <a href="/apoteku/src/datamaster-obat/dataobat-create.php"
                class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 text-sm transition duration-300 ease-in-out transform hover:scale-105">
                Tambah Data
            </a>
        </div>

        <!-- Tabel dengan overflow-x-auto -->
        <div class="bg-white shadow-md rounded-lg w-full mt-6 overflow-x-auto">
            <table class="table-auto w-full text-left border border-gray-200">
                <thead class="bg-blue-200 text-gray-900">
                    <tr>
                        <th class="px-4 py-3 border-b">ID Obat</th>
                        <th class="px-4 py-3 border-b">Nama Obat</th>
                        <th class="px-4 py-3 border-b">Code</th>
                        <th class="px-4 py-3 border-b">Formulasi</th>
                        <th class="px-4 py-3 border-b">Tanggal Kadaluarsa</th>
                        <th class="px-4 py-3 border-b">Stok</th>
                        <th class="px-4 py-3 border-b">Supplier</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Package</th>
                        <th class="px-4 py-3 border-b">Harga Beli</th>
                        <th class="px-4 py-3 border-b">Harga Jual</th>
                        <th class="px-4 py-3 border-b text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="employeeTable" class="text-gray-600">
                    <?php
                    include('../database/database.php');

                    $updateStatusSQL = "UPDATE obat 
                                        SET Status = 'Kadaluarsa' 
                                        WHERE Tanggal_Kadaluarsa <= CURDATE() AND Status != 'Kadaluarsa'";
                    mysqli_query($conn, $updateStatusSQL);

                    $sql = "SELECT t.ID_Obat, t.Nama_Obat, t.Code, t.Formulasi, t.Tanggal_Kadaluarsa, t.Stok, k.Nama_Supplier, t.Status, t.Package, t.Harga_Beli, t.Harga_Jual
                            FROM obat t 
                            JOIN supplier k ON t.ID_Supplier = k.ID_Supplier";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<tr class="hover:bg-gray-50 border-b transition duration-300">
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['ID_Obat'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Nama_Obat'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Code'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Formulasi'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Tanggal_Kadaluarsa'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Stok'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Nama_Supplier'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Status'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap">' . $row['Package'] . '</td>
                                <td class="px-4 py-3 whitespace-nowrap text-green-600 font-semibold">Rp ' . number_format($row['Harga_Beli'], 0, ',', '.') . '</td>
                                <td class="px-4 py-3 whitespace-nowrap text-blue-600 font-semibold">Rp ' . number_format($row['Harga_Jual'], 0, ',', '.') . '</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="/apoteku/src/datamaster-obat/dataobat-edit.php?id=' . $row['ID_Obat'] . '" 
                                           class="bg-yellow-500 text-white p-2 rounded-lg hover:bg-yellow-600 transform hover:scale-105 transition duration-200">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a onclick="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');" 
                                           href="/apoteku/src/datamaster-obat/dataobat-delete.php?id=' . $row['ID_Obat'] . '" 
                                           class="bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 transform hover:scale-105 transition duration-200">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="12" class="text-center py-4 text-gray-500">Tidak ada data obat</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Search filter for table
        document.getElementById('searchInput').addEventListener('keyup', function () {
            const input = this.value.toLowerCase();
            const rows = document.querySelectorAll('#employeeTable tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
                row.style.display = rowText.includes(input) ? '' : 'none';
            });
        });

        // Add click animation to buttons
        document.querySelectorAll('button, a').forEach(button => {
            button.addEventListener('click', function () {
                this.classList.add('button-click');
                setTimeout(() => this.classList.remove('button-click'), 150);
            });
        });
    </script>
</body>

</html>
