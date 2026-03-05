<?php
require "connection.php";

if (!isset($_GET['id'])) {
    echo "User not found";
    exit;
}

$id = $_GET['id'];

$stmt = $connection->prepare("SELECT * FROM emp WHERE id = ?");
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found";
    exit;
}
?>

<h2>User Details</h2>

<p>First Name: <?php echo $user['f_name']; ?></p>
<p>Last Name: <?php echo $user['l_name']; ?></p>
<p>Email: <?php echo $user['email']; ?></p>
<p>Address: <?php echo $user['address']; ?></p>

<a href="list.php">Back</a>