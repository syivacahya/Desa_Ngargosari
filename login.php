<?php
session_start();
include 'koneksi.php';

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $q = mysqli_query($conn,
        "SELECT * FROM admin 
         WHERE username='$user' AND password='$pass'"
    );

    if(mysqli_num_rows($q) > 0){
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
    } else {
        echo "<script>alert('Login gagal');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login Admin</title>
<style>
body{font-family:Arial;background:#0a7f3f}
form{width:300px;margin:120px auto;background:white;padding:20px;border-radius:8px}
input,button{width:100%;padding:10px;margin:8px 0}
button{background:#0a7f3f;color:white;border:none}
</style>
</head>
<body>

<form method="post">
<h2 align="center">Login Admin</h2>

<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>
</form>

</body>
</html>
