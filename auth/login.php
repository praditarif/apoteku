<?php
session_start();

// Konfigurasi database
$servername = "localhost";
$username = "root"; // Sesuaikan dengan username MySQL Anda
$password = ""; // Sesuaikan dengan password MySQL Anda
$dbname = "apoteku";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    // Periksa apakah user_id dan password ada di database
    $sql = "SELECT * FROM users WHERE user_id='$user_id' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika user_id dan password cocok, buat session login
        $_SESSION['user_id'] = $user_id;
        header("Location: login.html"); // Redirect ke halaman dashboard
    } else {
        echo "<script>alert('Login gagal. ID atau Password salah!');</script>";
    }
}

$conn->close();
?>
