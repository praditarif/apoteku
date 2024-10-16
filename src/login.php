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
        <form action="login.php" method="post" class="bg-green-300 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            
<div class="relative py-3 sm:max-w-xs sm:mx-auto">
  <div
    class="min-h-96 px-8 py-6 mt-4 text-left bg-green-600 dark:bg-gray-900 rounded-xl shadow-lg"
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
        />
      </div>
    </div>
    <div class="w-full flex flex-col gap-2">
      <label class="font-semibold text-xs text-white">Password</label>
      <input
        placeholder="••••••••"
        class="border rounded-lg px-3 py-2 mb-5 text-sm w-full outline-none dark:border-gray-500 dark:bg-gray-900"
        type="password"
      />
    </div>
    <div>
      <button
        class="py-1 px-8 bg-green-800 hover:bg-green-900 focus:ring-offset-blue-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg cursor-pointer select-none"
      >
        Login
      </button>
    </div>
  </div>
</div>
        </form>
        <p class="text-center text-gray-500 text-xs">
            &copy;2024 Apoteku. All rights reserved.
        </p>
    </div>
</body>


<?php
session_start(); // Memulai session

// Sertakan file untuk koneksi database
include('C:\xampp\htdocs\apoteku\src\database\database.php');

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
