<?php
    session_start();
    require 'db.php';

    if (isset($_SESSION['user_id'])) {
        $records=$conn->prepare('SELECT id,email,password FROM user WHERE id=:id');
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results=$records->fetch(PDO::FETCH_ASSOC);

        $user=null;

        if (count($results)>0) {
            $user=$results;
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
    <?php require 'partial/header.php'?>

    <?php if (!empty($user)): ?>
    <br>Welcome <?=$user['email']?>
    <br>You are successfully logged in
    <a href="logout.php">Logout</a>
    <?php else:?>
    <h1>Please login or register</h1>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <?php endif;?>
</body>

</html>