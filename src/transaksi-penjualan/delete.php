<?php
if (isset($_GET['id'])) {
    // Menyertakan file koneksi ke database
    include('/../src/database/database.php');

    // Mendapatkan ID dari parameter URL
    $id = intval($_GET['id']); // Menggunakan intval untuk mengonversi ID menjadi tipe integer

    // Menggunakan prepared statement untuk menghindari SQL Injection
    $sql = "DELETE FROM transaksi WHERE ID_Transaksi = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Mengikat parameter ke statement
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        // Menjalankan statement
        if (mysqli_stmt_execute($stmt)) {
            // Mengalihkan ke halaman index.php setelah berhasil menghapus data
            header('Location: index.php');
            exit(); // Pastikan script berhenti setelah header
        } else {
            // Menampilkan pesan error jika eksekusi gagal
            echo 'Error: ' . mysqli_error($conn);
        }
        
        // Menutup statement
        mysqli_stmt_close($stmt);
    } else {
        // Menampilkan pesan error jika prepared statement gagal dibuat
        echo 'Error preparing the SQL query: ' . mysqli_error($conn);
    }

    // Menutup koneksi database
    mysqli_close($conn);
}
?>
