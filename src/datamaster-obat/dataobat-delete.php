<?php
if (isset($_GET['id'])) {
    include('../database/database.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM obat WHERE ID_Obat = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: dataobat.php');
    } else {
        echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
    }
    mysqli_close($conn);
}