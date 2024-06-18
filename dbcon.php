<?php
$dsn = "mysql:host=localhost;dbname=ecommerce";
$username = "root";
$password = "";
try {
    $db = new PDO($dsn, $username, $password);
    /* echo "You Have Connected!"; */
} catch (PDOException $e) {
    $error_message = $e->getMEssage();
    echo $error_message;
    exit();
}
