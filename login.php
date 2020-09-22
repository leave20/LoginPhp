<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: /LoginPhp');
}

require 'db.php';
/**
 * Si no está vacío los campos "email" y "password" , haremos una consulta a la base de datos
 */
if (!empty($_POST['email'])&& !empty($_POST['password'])) {
    /**
     * vamos a crear una variable , luego ejecutamos una consulta de SQL
     * En este caso vamos a hacer un select de id, email y password  desde la base de datos de la tabla 
     * "users" donde "email" sea igual al parametro ":email" que vamos a crear
     */
    $records=$conn->prepare('SELECT id,email , password FROM users WHERE email=:email');
    /**
     * vinculamos ambos parametros 
     */
    $records->bindParam(':email',$_POST['email']);
    /**
     * ejecutamos la consulta
     */
    $records->execute();
    /**
     * creamos una variable para obtener los datos "records" y usaremos el fetch para obtener los datos del usuario
     */
    $results=$records->fetch(PDO::FETCH_ASSOC);
    /**
     * Creamos una variable "message" para usarlo en una validación
     */
    $message='';
    /**
     * creamos un flujo
     * Si los resultados son mayores a cero y verificamos que el password que nos manda el usuario es identico con el de 
     * la base de datos , entonces almacenaremos el id del resultado en una variable de SESSION
     * y luego redireccionamos a la raiz de nuestro proyecto "/LoginPhp"
     */
    if (count($results)>0 && password_verify($_POST['password'],$results['password'])) {
        /**
         * Para crear una variable de session , debemos inicializarlas con un metodo como "session_start()"
         */
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
    /**
     * Si no está vacío , que lo muestre en un parrafo el mensaje
     */
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