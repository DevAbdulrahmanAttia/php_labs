<?php

try {

    $connection = new PDO(
        "mysql:host=localhost;dbname=php_lab3",
        "root",
        ""
    );

    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Connection failed: " . $e->getMessage());

}