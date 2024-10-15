<?php
include('../database/database.php');

// Cek apakah ID sudah diterima melalui URL
if (isset($_GET['id'])) {
    $id_obat = $_GET['id'];

    // Hapus data di tabel detail_resep yang berelasi dengan ID_Obat
    $sql_delete_detail = "DELETE FROM detail_resep WHERE ID_Obat = $id_obat";
    $result_detail = mysqli_query($conn, $sql_delete_detail);
    
    if ($result_detail) {
        // Jika penghapusan di detail_resep berhasil, lanjutkan dengan menghapus di tabel obat
        $sql_delete_obat = "DELETE FROM obat WHERE ID_Obat = $id_obat";
        $result_obat = mysqli_query($conn, $sql_delete_obat);

        if ($result_obat) {
            // Jika berhasil, redirect kembali ke halaman dataobat.php
            header("Location: /apoteku/src/datamaster-obat/dataobat.php");
            exit;
        } else {
            // Jika gagal menghapus di tabel obat, tampilkan error
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Jika gagal menghapus di tabel detail_resep, tampilkan error
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Jika tidak ada ID di URL, redirect kembali ke halaman dataobat.php
    header("Location: /apoteku/src/datamaster-obat/dataobat.php");
    exit;
}
?>
