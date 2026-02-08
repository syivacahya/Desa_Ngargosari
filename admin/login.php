<?php
session_start();
require_once "../public/koneksi.php"; // PATH FIX

// Redirect ke dashboard kalau sudah login
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5($_POST['password']); // password = 12345

    $query = mysqli_query(
        $koneksi,
        "SELECT * FROM admin 
         WHERE username='$username' 
         AND password='$password'"
    );

    if (!$query) {
        die("Query Error: " . mysqli_error($koneksi));
    }

    if (mysqli_num_rows($query) === 1) {
        $_SESSION['login'] = true;
        $_SESSION['admin'] = $username;

        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-sm bg-white- shadow-lg rounded-lg p-8">
    <div class="flex flex-col items-center mb-6">
        <img src="../assets/img/logo.png" alt="Logo Desa" class="w-24 mb-3">
        <h2 class="text-2xl font-bold text-gray-700">Login Admin</h2>
    </div>

    <?php if($error): ?>
        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded text-center">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="space-y-4">
        <div>
            <label class="block text-gray-600 mb-1">Username</label>
            <input type="text" name="username" placeholder="Masukkan username"
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <div>
            <label class="block text-gray-600 mb-1">Password</label>
            <input type="password" name="password" placeholder="Masukkan password"
                   class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-green-500">
        </div>

        <button type="submit" name="login"
                class="w-full bg-green-700 hover:bg-green-800 text-white py-2 rounded font-semibold transition-colors">
            Masuk
        </button>
    </form>
</div>

</body>
</html>
