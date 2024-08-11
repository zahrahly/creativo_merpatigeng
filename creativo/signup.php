<?php
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $konfirmasi = $_POST["konfirmasi"];

    // Cek apakah password dan konfirmasi password cocok
    if ($password !== $konfirmasi) {
        echo "Password dan Konfirmasi Password tidak cocok.";
        exit();
    }

    // Simpan password apa adanya tanpa hashing
    $plain_password = $password;

    // Query untuk memasukkan data ke database
    $query_sql = "INSERT INTO tbl_login (username, email, password) 
                  VALUES ('$username', '$email', '$plain_password')";

    if (mysqli_query($conn, $query_sql)) {
        // Redirect ke halaman index.html setelah pendaftaran berhasil
        header("Location: index.html");
        exit();
    } else {
        echo "Pendaftaran Gagal: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <title>Sign Up - Creativo</title>
    <link rel="shortcut icon" href="./assets/images/logoo.png" type="image/svg+xml">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #ffffff;
        }

        .container {
            display: flex;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 800px;
            overflow: hidden;
        }

        .left {
            background-color: #ffffff;
            padding: 40px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .left h1 {
            font-size: 32px;
            color: #004AAD;
            margin-bottom: 20px;
            text-align: left;
        }

        .left p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            text-align: left;
        }

        .right {
            background-color: #ffffff;
            padding: 40px;
            width: 50%;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
            text-align: left;
        }

        .box-input {
            margin-bottom: 20px;
            position: relative;
        }

        .box-input input {
            width: 100%;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 30px;
            font-size: 16px;
        }

        .btn-input {
            width: 100%;
            padding: 15px;
            background-image: linear-gradient(to right, #004AAD, #FF914D);
            border: none;
            border-radius: 30px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-input:hover {
            background-image: linear-gradient(to right, #003f98, #ff7a33);
        }

        .bottom {
            text-align: center;
            margin-top: 20px;
        }

        .bottom a {
            color: #FF914D;
            text-decoration: none;
        }

        .bottom a:hover {
            text-decoration: underline;
        }

        label {
            font-size: 12px;
            color: #666;
        }

        label a {
            color: #333;
            text-decoration: none;
        }

        label a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left">
            <h1>Creativo</h1>
            <p>Halo, Selamat datang di Creativo!</p>
            <img src="assets/images/signup.png" alt="Illustration" style="width: 100%; max-width: 300px;">
        </div>
        <div class="right">
            <h1>Sign Up</h1>
            <form action="signup.php" method="POST">
                <div class="box-input">
                    <input type="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="box-input">
                    <input type="text" name="username" placeholder="Masukkan Username" required>
                </div>
                <div class="box-input">
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="box-input">
                    <input type="password" name="konfirmasi" placeholder="Konfirmasi Password" required>
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="checkbox" name="terms" required>
                    <label for="terms">Dengan membuat akun, saya setuju dengan <a href="#">Syarat dan Ketentuan</a>, dan <a href="#">Ketentuan Privasi Creativo</a></label>
                </div>
                <button type="submit" name="signup" class="btn-input">Sign Up</button>
                <div class="bottom">
                    <p>Sudah punya akun? <a href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

