<?php
$server='localhost';
$username='root';
$password='';
$database='login_database';

/**
 * el script intentará (try) conectarse a MySQL utilizando el código proporcionado,
 * pero si hay un problema
 * se ejecutará el código de la sección de captura (catch). 
 * Puedes usar el bloque catch para mostrar mensajes de error de conexión o 
 * ejecutar un código alternativo si falla el bloque try.
 * Si la conexión es exitosa, imprimirá el mensaje «Connected to $dbname at $host successfully«. 
 * Sin embargo, si el intento falla, el código de captura mostrará un mensaje de error simple y eliminará el script.
 */
try {
    $conn=new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    
} catch (PDOException $e) {
    die('Connected failed:' .$e->getMessage());
}


?>