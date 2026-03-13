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

if(!$user){
    echo "User not found!";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="list.php">Employee Management</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <span class="nav-link">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4">User Details</h2>

                    <?php if($user['image']){ ?>
                        <div class="text-center mb-4">
                            <img src="uploads/<?php echo htmlspecialchars($user['image']); ?>" alt="Profile" class="img-fluid" style="max-width: 150px; border-radius: 10px;">
                        </div>
                    <?php } ?>

                    <div class="mb-3">
                        <strong>First Name:</strong> <?php echo htmlspecialchars($user['f_name']); ?>
                    </div>

                    <div class="mb-3">
                        <strong>Last Name:</strong> <?php echo htmlspecialchars($user['l_name']); ?>
                    </div>

                    <div class="mb-3">
                        <strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?>
                    </div>

                    <div class="mb-3">
                        <strong>Address:</strong> <?php echo htmlspecialchars($user['address']); ?>
                    </div>

                    <div>
                        <a href="list.php" class="btn btn-primary">Back to Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>