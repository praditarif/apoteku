<?php
if (isset($_GET['id'])) {
    // Menyertakan koneksi ke database
    include('../src/database/database.php');

    // Validasi ID
    $id = intval($_GET['id']); // Mengonversi ke integer untuk menghindari SQL injection

    // Siapkan query dengan prepared statement
    $sql = "DELETE FROM transaksi WHERE ID_Transaksi = ?";
    
    // Menggunakan prepared statement untuk mencegah SQL injection
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Mengikat parameter
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // Eksekusi query
        if (mysqli_stmt_execute($stmt)) {
            // Jika berhasil, redirect ke halaman index
            header('Location: /apoteku/src/transaksi-penjualan/index.php');
            exit;
        } else {
            // Tampilkan pesan error jika gagal
            echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
        }

        // Tutup statement
        mysqli_stmt_close($stmt);
    } else {
        echo 'Error preparing statement: ' . mysqli_error($conn);
    }

    // Tutup koneksi database
    mysqli_close($conn);
} else {
    echo "ID tidak ditemukan.";
}
?>
