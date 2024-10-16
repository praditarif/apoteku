<?php
if (isset($_GET['id'])) {
    include('../database/database.php');

    // Ambil ID dari parameter URL
    $id = $_GET['id'];

    // Hapus data terkait di tabel detail_resep
    $sql = "DELETE dr FROM detail_resep dr
            INNER JOIN obat o ON dr.ID_Obat = o.ID_Obat
            WHERE o.ID_Supplier = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Hapus data terkait di tabel obat
    $sql = "DELETE FROM obat WHERE ID_Supplier = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Hapus data di tabel supplier
    $sql = "DELETE FROM supplier WHERE ID_Supplier = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect ke halaman index supplier setelah berhasil dihapus
        header('Location: index-supplier.php');
        exit();
    } else {
        // Tampilkan pesan error jika gagal menghapus data
        echo 'Error: ' . $stmt->error;
    }

    // Tutup koneksi
    $stmt->close();
    mysqli_close($conn);
}
?>
