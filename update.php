<?php
require "connection.php";

$id      = $_POST['id'];
$f_name  = $_POST['f_name'];
$l_name  = $_POST['l_name'];
$email   = $_POST['email'];
$address = $_POST['address'];

$stmt = $connection->prepare(
    "UPDATE emp SET f_name = ?, l_name = ?, email = ?, address = ? WHERE id = ?"
);

$stmt->execute([$f_name, $l_name, $email, $address, $id]);

header("Location: list.php");
exit;