<?php
include('../database/database.php');

$nama = $no_telpon = $jenis_kelamin = $tempat_lahir = $tanggal_lahir = $id_insuransi = '';

$successMessage = '';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header('Location: /apoteku/src/datamaster-supplier/index-supplier.php');
        exit;
    }

    $id = $_GET['id'];

    $sql = "SELECT * FROM supplier WHERE ID_Supplier = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        header('Location: /apoteku/src/datamaster-supplier/index-supplier.php');
        exit;
    }

    $nama = $row['ID_Karyawan'];
    $no_telpon = $row['no_telpon'];
    $jenis_kelamin = $row['jenis_kelamin'];
    $tempat_lahir = $row['tempat_lahir'];
    $tanggal_lahir = $row['tanggal_lahir'];
    $id_insuransi = $row['id_insuransi'];
} else {
    $id = $_POST['id_pasien'];
    $nama = $_POST['nama'];
    $no_telpon = $_POST['no_telpon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $id_insuransi = $_POST['id_insuransi'];

    do {
        if (empty($nama) || empty($no_telpon) || empty($jenis_kelamin) || empty($tempat_lahir) || empty($tanggal_lahir) || empty($id_insuransi)) {
            echo "<script>alert('Please fill all the fields')</script>";
            break;
        }

        $sql = "UPDATE pasien SET nama = '$nama', no_telpon = '$no_telpon', jenis_kelamin = '$jenis_kelamin', tempat_lahir = '$tempat_lahir', tanggal_lahir = '$tanggal_lahir', id_insuransi = '$id_insuransi' WHERE id_pasien = $id";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "<script>alert('Failed to update pasien')</script>";
        }

        $successMessage = 'pasien has been updated!';
    } while (false);
}
?>