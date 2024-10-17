<?php

session_start();

require 'C:\xampp2\htdocs\apoteku\src\database\database.php';

$error= "";

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
    <title>Apoteku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="../assets/css/output.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <script defer>
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }
    </script>
</head>

<body class="flex items-center justify-center h-screen bg-white">
    <div class="w-full max-w-xs">
        <form action="" method="POST" class="bg-blue-500 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            
<div class="relative py-3 sm:max-w-xs sm:mx-auto">
  <div
    class="min-h-96 px-8 py-6 mt-4 text-left bg-blue-700 dark:bg-gray-900 rounded-xl shadow-lg"
  >
    <div class="flex flex-col justify-center items-center h-full select-none">
      <div class="flex flex-col items-center justify-center gap-2 mb-8">
    
        <p class="m-0 text-[16px] font-semibold text-white">
          Apoteku Admin
        </p>
      </div>
      <div class="w-full flex flex-col gap-2">
        <label class="font-semibold text-xs text-white">Username</label>
        <input
          placeholder="Username"
          class="border rounded-lg px-3 py-2 mb-5 text-sm w-full outline-none dark:border-gray-500 dark:bg-gray-900"
          type="text" name="username" required
        />
      </div>
    </div>
    <div class="w-full flex flex-col gap-2">
      <label class="font-semibold text-xs text-white">Password</label>
      <input
        placeholder="••••••••"
        class="border rounded-lg px-3 py-2 mb-5 text-sm w-full outline-none dark:border-gray-500 dark:bg-gray-900"
        type="password" name="password" required
      />
    </div>
    <div>
      <button
        class="py-1 px-8 bg-blue-900 hover:bg-blue-950 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg cursor-pointer select-none"
        type="submit" name="login">
        Login
      </button>
    </div>
  </div>
  <p class="font-semibold text-xs text-white"><?php if (isset($_POST["login"])) { echo $error; } ?>

  </p>
</div>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2024 Apoteku. All rights reserved.
        </p>
    </div>
</body>
</html>
