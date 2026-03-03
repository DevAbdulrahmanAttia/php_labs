<?php
require "connection.php";

if (!isset($_GET['id'])) {
    echo "User not found";
    exit;
}

$id = $_GET['id'];

$stmt = $connection->prepare("DELETE FROM emp WHERE id = ?");
$stmt->execute([$id]);

header("Location: list.php");
exit;