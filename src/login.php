<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</head>

<body>

    <div class="container">
        <div class="login">
            <div class="left">
                <img src="assets/img/gambar-obat.png" alt="Apoteku Mockup" class="mockup">
            </div>
            <div class="right">
                <div class="logo">
                    <img src="assets/img/logo-obat.jpeg" alt="Apoteku">
                </div>
                <form action="login.php" method="post"> <!-- Mengarahkan ke file login-process.php -->
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username Admin" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Kata Sandi" required>
                    </div>
                    <button type="submit" class="btn">SIGN IN</button>
                </form>

                <p>&copy; 2024 Apoteku</p>
            </div>
        </div>
    </div>

</body>


<?php
session_start(); // Memulai session

// Sertakan file untuk koneksi database
include('../../src/database/database.php');

// Memeriksa apakah form telah dikirimkan dengan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Memeriksa apakah input username dan password ada
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];

        // Menggunakan prepared statement untuk menghindari SQL Injection
        $sql = "SELECT * FROM karyawan WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);

        // Memeriksa apakah statement berhasil dipersiapkan
        if (!$stmt) {
            die("Kesalahan dalam query: " . $conn->error);
        }
        
        // Bind parameter (ss = string, string)
        $stmt->bind_param("ss", $user, $pass);
        $stmt->execute();
        $result = $stmt->get_result();

        // Memeriksa apakah ada kecocokan
        if ($result->num_rows > 0) {
            // Login sukses
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username']; // Menyimpan username dalam sesi
            
            // Redirect ke halaman main.php
            header("Location: main.php");
            exit();
        } else {
            // Pesan jika login gagal
            echo "Username atau kata sandi salah!";
        }

        // Menutup statement dan koneksi
        $stmt->close();
        $conn->close();
    } else {
        echo "Username dan password harus diisi!";
    }
} else {
    echo "Form harus dikirim menggunakan metode POST.";
}
?>


</html>
