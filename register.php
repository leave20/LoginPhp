<?php 
require 'db.php';
$message='';

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql="INSERT INTO user(email,password) VALUES (:email,:password)";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(':email',$_POST['email']);
    $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
    $stmt->bindParam(':password',$password);

    if ($stmt->execute()) {
        $message='Successfully created new user';
    }else{
        $message='Sorry there must have an issue creating your account';
    }

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
<?php
    if (!empty($message)):?>
    <p><?= $message?></p>
    <?php endif;?>
    <h1>Register</h1>
    <span>or <a href="login.php">Login</a></span>
    <form action="register.php" method="post">

        <input type="email" name="email" placeholder="Ingrese su email">
        <input type="password" name="password" placeholder="Ingrese su contraseña">
        <input type="password" name="confirmarpassword" placeholder="Confirme contraseña">
        <input type="submit" name="submit" value="Send">

    </form>
</body>

</html>