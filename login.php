<?php
session_start();
include "koneksi.php";

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $pass  = md5($_POST['password']); // SESUAI DENGAN DATABASE (MD5)

    $query = mysqli_query(
        $conn,
        "SELECT * FROM admin 
         WHERE username='$email' 
         AND password='$pass'"
    );

    if (mysqli_num_rows($query) > 0) {

        // SET SESSION (INI YANG SEBELUMNYA SALAH)
        $_SESSION['login'] = true;
        $_SESSION['admin'] = $email;

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>

<style>
*{
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background:#f3f6f4;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.login-box{
    width:380px;
    background:#7fb56a;
    padding:40px 30px;
    border-radius:10px;
    text-align:center;
    box-shadow:0 5px 15px rgba(0,0,0,0.2);
}

.logo{
    width:80px;
    margin-bottom:15px;
}

h2{
    color:white;
    margin-bottom:25px;
}

.input-group{
    text-align:left;
    margin-bottom:15px;
}

.input-group label{
    color:white;
    font-size:14px;
}

.input-group input{
    width:100%;
    padding:10px;
    border:none;
    border-radius:5px;
    margin-top:5px;
}

button{
    width:100%;
    padding:12px;
    background:#2f5e2b;
    border:none;
    color:white;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#244a21;
}

.error{
    background:#ffdddd;
    color:#b30000;
    padding:8px;
    margin-bottom:15px;
    border-radius:5px;
}
</style>
</head>

<body>

<div class="login-box">

    <img src="assets/img/logo.png" class="logo" alt="Logo">

    <h2>Login Admin</h2>

    <?php if($error != ""){ ?>
        <div class="error"><?= $error ?></div>
    <?php } ?>

    <form method="POST">

        <div class="input-group">
            <label>Email</label>
            <input type="text" name="email" placeholder="Masukkan email" required>
        </div>

        <div class="input-group">
            <label>Kata Sandi</label>
            <input type="password" name="password" placeholder="Masukkan password" required>
        </div>

        <button type="submit" name="login">Masuk</button>

    </form>

</div>

</body>
</html>
