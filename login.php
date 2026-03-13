<?php
session_start();

// Redirect to list.php if already logged in
if(isset($_SESSION['user_id'])){
    header("Location: list.php");
    exit;
}

require "connection.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM emp WHERE username = ?");
    $stmt->execute([$username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && $user['password'] == $password){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header("Location: list.php");
        exit;

    }else{

        $error = "Invalid username or password";

    }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>Login</h2>

<?php if($error){ ?>

<p style="color:red;">
<?php echo $error; ?>
</p>

<?php } ?>

<form method="POST">

<label>Username</label>
<br>
<input type="text" name="username" required>
<br><br>

<label>Password</label>
<br>
<input type="password" name="password" required>
<br><br>

<button type="submit">Login</button>

</form>

</body>
</html>