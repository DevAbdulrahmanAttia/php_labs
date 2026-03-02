<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];

$lines = file("data.txt");

unset($lines[$id]);

$fp = fopen("data.txt", "w");

foreach($lines as $line){
    fwrite($fp, $line);
}

fclose($fp);

header("Location: list.php");
exit;
?>