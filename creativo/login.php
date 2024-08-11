<?php
session_start();
require 'koneksi.php'; // Pastikan file ini sudah benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepared statement untuk menghindari SQL injection
    $query_sql = "SELECT * FROM tbl_login WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query_sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan informasi user ke session
            $_SESSION['id_login'] = $row['id_login'];
            $_SESSION['username'] = $row['username'];

            // Redirect ke halaman index setelah berhasil login
            header("Location: index.php");
            exit();
        } else {
            echo "Password salah";
        }
    } else {
        echo "Email tidak ditemukan";
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}

// Tutup koneksi
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Creativo</title>
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
            <h1>Sign In</h1>
            <form action="login.php" method="POST">
                <div class="box-input">
                    <input type="email" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="box-input">
                    <input type="password" name="password" placeholder="Masukkan Password" required>
                </div>
                <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center;">
    <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Ingat saya</label>
    </div>
    <div>
        <a href="#" style="font-size: 13x; color: #666;">Lupa password?</a>
    </div>
</div>

                <button type="submit" name="signin" class="btn-input">Sign In</button>
                <div class="bottom">
                    <p>Belum punya akun? <a href="signup.php">Sign Up</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
