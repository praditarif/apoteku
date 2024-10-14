<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoteku</title>
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body></body>
    

    <div class="container">
        <div class="login-container">
            <div class="left">
                <img src="assets/img/gambar-obat.png" alt="Apoteku Mockup" class="mockup">
            </div>
            <div class="right">
                <div class="logo">
                    <img src="assets/img/logo-obat.jpeg" alt="Apoteku">
                </div>
                <form action="login.php" method="post">
                    <div class="form-group">
                        <input type="text" name="member_id" placeholder="Username Admin" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Kata Sandi" required>
                    </div>
                    <div class="form-group">
                        <a href="#" class="forgot-password">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn">SIGN IN</button>
                </form>
                <p>&copy; 2024 Apoteku</p>
            </div>
        </div>
    </div>


</body>
</html>