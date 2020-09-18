<?php 
require 'db.php';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql="INSERT INTO users(email,password) VALUES (:email,:password)";
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Document</title>
</head>

<body>
    <?php
require 'partial/header.php'
?>
    <h1>Register</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="index.html" method="post">

        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="password" name="confirmarpassword" placeholder="Confirme contraseña">
        <input type="submit" name="submit" value="Send">

    </form>
</body>

</html>