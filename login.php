<?php
session_start();

if (isset($_SESSION)) {
    header('Location: /LoginPhp');
}

require 'db.php';

if (!empty($_POST['email'])&& !empty($_POST['password'])) {
    $records=$conn->prepare('SELECT id,email , password FROM user WHERE email=:email');
    $records->bindParam(':email',$_POST['email']);
    $records->execute();
    $results=$records->fetch(PDO::FETCH_ASSOC);

    $message='';

    if (count($results)>0 && password_verify($_POST['password'],$results['password'])) {
        $_SESSION['user_id']=$results['id'];
        header('Location: /LoginPhp');
    }else{
        $message='Sorry, those credentials do not match ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php
require 'partial/header.php'
?>
    <h1>Login</h1>
    <span>or <a href="register.php">Register</a></span>
    <?php
        if (!empty($message)):?>

        <p><?=$message?></p>
        <?php endif;?>
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="submit" name="submit" value="Send">

    </form>
</body>

</html>