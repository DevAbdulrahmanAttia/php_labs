<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

require "connection.php";

$id = $_GET['id'];

$stmt = $connection->prepare("SELECT * FROM emp WHERE id = ?");
$stmt->execute([$id]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<div style='float:right;'>
Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> | 
<a href='logout.php'>Logout</a>
</div>

<h2>Edit User</h2>

<form action="update.php" method="POST">

    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

    First Name:
    <input type="text" name="f_name" value="<?php echo $user['f_name']; ?>">
    <br><br>

    Last Name:
    <input type="text" name="l_name" value="<?php echo $user['l_name']; ?>">
    <br><br>

    Email:
    <input type="text" name="email" value="<?php echo $user['email']; ?>">
    <br><br>

    Address:
    <input type="text" name="address" value="<?php echo $user['address']; ?>">
    <br><br>

    <input type="submit" value="Update">

</form>

</body>
</html>