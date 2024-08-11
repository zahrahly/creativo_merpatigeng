<?php
session_start();

// Pastikan user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <header>
        <h1>Profil Pengguna</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <main>
        <h2>Hai, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Selamat datang di halaman profil Anda.</p>
        <p>Email: <?php echo $_SESSION['email']; // Pastikan session email diset saat login ?></p>
    </main>
</body>
</html>
