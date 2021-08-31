<?php
    $host = '127.0.0.1';
    $name = 'record';
    $user = 'root';
    $pass = 'root';
    $charset='utf8';
    $dsn = "mysql:host=$host;charset=$charset;dbname=$name";
//  connection to the database
try{
    $db = new PDO ($dsn, $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "<p class='text-success'>Connecion to the database was successful !</p>";
} catch (PDOException $e){
    // echo "<p class='text-danger'>Connecion to the database was not successful!</p>";
    echo $e->getMessage();
}
require_once 'crud.php';
$crud = new crud($db);