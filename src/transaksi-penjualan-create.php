<?php
if (isset($_POST['submit'])) {
    include('./database/database.php');
    $Tanggal_Waktu = $_POST['Tanggal_Waktu'];
    $Kode_Jenis_Layanan = $_POST['Kode_Jenis_Layanan'];
    $Kode_Provider_CPT = $_POST['Kode_Provider_CPT'];
    $Total_Harga_Obat = $_POST['Total_Harga_Obat'];
    $Metode_Pembayaran = $_POST['Metode_Pembayaran'];
    $Sumber_Pembayaran = $_POST['Sumber_Pembayaran'];
    $ID_Karyawan = $_POST['ID_Karyawan'];
    $ID_Resep = $_POST['ID_Resep'];


    do {
        if (empty($Tanggal_Waktu) || empty($Kode_Jenis_Layanan) || empty($Kode_Provider_CPT) || empty($Total_Harga_Obat) || empty($Metode_Pembayaran) || empty($Sumber_Pembayaran) || empty($ID_Karyawan)|| empty($ID_Resep)) {
            echo "<script>alert('Please fill all the fields')</script>";
            break;
        } else {
            $sql = "INSERT INTO transaksi (Tanggal_Waktu, Kode_Jenis_Layanan, Kode_Provider_CPT , Total_Harga_Obat, Metode_Pembayaran, Sumber_Pembayaran, ID_Karyawan, ID_Resep) VALUES ('$Tanggal_Waktu', '$Kode_Jenis_Layanan', '$Kode_Provider_CPT', '$Total_Harga_Obat', '$Metode_Pembayaran', '$Sumber_Pembayaran', '$ID_Karyawan','$ID_Resep')";
            if (mysqli_query($conn, $sql)) {
                $successMessage = 'Dokter has been created successfully';
            } else {
                echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    } while (false);
}
?>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="./output.css" rel="stylesheet">
</head>
<body>
    <!-- testttttt -->
<form method="POST">
    <div class="grid grid-cols-1 grid-rows-1">
    
    <label for="Tanggal_Waktu">Tanggal & Waktu</label>
    <input type="date"name="Tanggal_Waktu" class="input input-bordered input-primary w-full max-w-xs" >

    <label for="Kode_Jenis_Layanan">Kode_Jenis_Layanan </label>
    <input type="text"name="Kode_Jenis_Layanan"class="input input-bordered input-primary w-full max-w-xs" >

    <label for="Kode_Provider_CPT">Kode_Provider_CPT</label>
    <input type="text"name="Kode_Provider_CPT"class="input input-bordered input-primary w-full max-w-xs" >

    <label for="Total_Harga_Obat">Total_Harga_Obat</label>
    <input type="text"name="Total_Harga_Obat"class="input input-bordered input-primary w-full max-w-xs" >

    <label for="Metode_Pembayaran">Metode_Pembayaran</label>
    <input type="text"name="Metode_Pembayaran"class="input input-bordered input-primary w-full max-w-xs" >

    <label for="Sumber_Pembayaran">Sumber_Pembayaran</label>
    <input type="text"name="Sumber_Pembayaran"class="input input-bordered input-primary w-full max-w-xs" >

    <label for="ID_Karyawan">ID_Karyawan</label>
    <select name="ID_Karyawan"class="input input-bordered input-primary w-full max-w-xs">
                                <?php
                                include('./database/database.php');
                                $sql = "SELECT * FROM karyawan";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['ID_Karyawan'] . '">' . $row['Nama'] . '</option>';
                                    }
                                }
                                ?>
    </select>

                     <label for="ID_Resep">ID_Resep</label>
     <select name="ID_Resep" class="input input-bordered input-primary w-full max-w-xs">
                                <?php
                                include('./database/database.php');
                                $sql = "SELECT * FROM resep";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['ID_Resep'] . '">' . $row['Catatan_Resep'] . '</option>';
                                    }
                                }
                                ?>
    </select>
                     <button name="submit" type="submit" class="bg-green-500 opacity-95 text-white btn hover:bg-blues hover:opacity-100">Create</button>
                    
    </div>
    </form>
       </body>
