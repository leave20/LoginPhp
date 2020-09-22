<?php 
/**
 * Traemos la conección
 */
require 'db.php';
/**
 * Creamos una variable global para los mensajes
 */
$message='';
/**
 * Iniciamos las validaciones de los campos
 * Si no están vacíos los campos que haga lo siguiente
 */
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    /**
     * Creamos una variable el cual va a ser un query de la base de datos para ingresar los datos
     */
    $sql="INSERT INTO users(email,password) VALUES (:email,:password)";
    /**
     * creamos otra variable llamada "stmt" el cual va a tener como valor la variable "conn" 
     * en donde ejecutaremos el metodo "prepare" , dicho metodo va a ejecutar el query de la variable "sql" 
     */
    $stmt=$conn->prepare($sql);
    /**
     * Vinculamos en la misma variable , los siguientes parametros
     */
    $stmt->bindParam(':email',$_POST['email']);
    /**
     * Antes de vincular el parametro del password , vamos a encriptar los datos
     */
    $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
    /**
     * Luego de encriptar los datos del password , podremos vincular dicho parametro
     */
    $stmt->bindParam(':password',$password);
    /**
     * Si se ejecuta la variable stmt , mandará el primer mensaje
     * de lo contrario el mensaje secundario
     */
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