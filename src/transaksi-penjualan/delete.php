<?php
if (isset($_GET['id'])) {
    include('../database/database.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM transaksi WHERE ID_Transaksi = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: index.php');
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
    mysqli_close($conn);
}