<?php
session_start();

require 'C:\xampp2\htdocs\apoteku\src\database\database.php';

$error = "";

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM karyawan WHERE username = '$username'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row["password"]) {  // Bandingkan langsung
            $_SESSION["login"] = true;
            $_SESSION["user"] = $username;
            header("Location: main.php");
            exit;
        } else {
            $error = "Login gagal! Password salah.";
        }
    } else {
        $error = "Login gagal! Username tidak ditemukan.";
    }
} else {
    $error = "Silakan masukkan username dan password.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Apoteku</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-3xl font-semibold text-center text-blue-600 mb-6">Login to Apoteku</h2>

        <!-- Login Form -->
        <form action="" method="POST">
            <!-- Username Field -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input id="username" name="username" type="text" placeholder="Username" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" name="password" type="password" placeholder="Password" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <!-- Login Button -->
            <button type="submit" name="login" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-300 ease-in-out">
                Login
            </button>

            <!-- Error Message -->
            <?php if (isset($_POST["login"]) && !empty($error)) : ?>
                <p class="text-red-600 text-center mt-4"><?= $error; ?></p>
            <?php endif; ?>
        </form>

        <!-- Footer moved below login -->
        <footer class="text-center mt-6 text-gray-500 text-xs">
            &copy;2024 Apoteku. All rights reserved.
        </footer>
    </div>

</body>

</html>
