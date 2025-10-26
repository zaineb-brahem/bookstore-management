<?php
function connect()
{
    require('config.php');
    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

    try {
        $pdo = new PDO($dsn, $user, $password);

        return $pdo;
    } catch (PDOException $e) {
        echo "Attention : une exception s'est produite<br>";
        echo $e->getMessage();
        return null;
    }
}

?>