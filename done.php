<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "connection.php";

$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$address    = $_POST['address'];
$country    = $_POST['country'];
$gender     = $_POST['gender'];
$skills     = $_POST['skills'] ?? [];
$department = $_POST['department'];
$username   = $_POST['username'];
$password   = $_POST['password'];

/* password validation */

if(!preg_match("/^[a-z0-9_]{8}$/", $password)){
    echo "<h3 style='color:red;'>Password must be exactly 8 characters (a-z,0-9,_)</h3>";
    exit;
}

/* upload image */

$image_name = "";

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){

    $allowed_types = ['image/jpeg','image/png'];
    $max_size = 2 * 1024 * 1024; // 2MB

    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];

    if(!in_array($file_type,$allowed_types)){
        echo "<h3 style='color:red;'>Only JPG and PNG images are allowed</h3>";
        exit;
    }

    if($file_size > $max_size){
        echo "<h3 style='color:red;'>Image size must be less than 2MB</h3>";
        exit;
    }

    $tmp_name = $_FILES['image']['tmp_name'];

    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    $image_name = uniqid() . "." . $extension;

    $upload_path = "uploads/" . $image_name;

    move_uploaded_file($tmp_name,$upload_path);
}

/* title */

if($gender == "Male"){
    $title = "Mr";
}else{
    $title = "Miss";
}

/* insert into database */

$stmt = $connection->prepare(
"INSERT INTO emp (f_name, l_name, email, address, username, password, image)
 VALUES (?, ?, ?, ?, ?, ?, ?)"
);

$stmt->execute([
    $first_name,
    $last_name,
    $first_name . "@mail.com",
    $address,
    $username,
    $password,
    $image_name
]);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Complete - Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-success">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-check-circle" style="font-size: 3rem; color: #28a745;"></i>
                    </div>

                    <h2 class="card-title text-center mb-4">
                        Thanks <?php
                        echo htmlspecialchars($title . " " . $first_name . " " . $last_name);
                        ?>
                    </h2>

                    <p class="text-center text-muted mb-4"><strong>Please Review Your Information:</strong></p>

                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Name:</strong><br>
                                    <?php echo htmlspecialchars($first_name . " " . $last_name); ?>
                                </div>
                                <div class="col-md-6">
                                    <strong>Email:</strong><br>
                                    <?php echo htmlspecialchars($first_name . "@mail.com"); ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Country:</strong><br>
                                    <?php echo htmlspecialchars($country); ?>
                                </div>
                                <div class="col-md-6">
                                    <strong>Gender:</strong><br>
                                    <?php echo htmlspecialchars($gender); ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12">
                                    <strong>Address:</strong><br>
                                    <?php echo htmlspecialchars($address); ?>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Skills:</strong><br>
                                    <?php
                                    if(!empty($skills)){
                                        foreach($skills as $skill){
                                            echo "<span class='badge bg-info me-1'>" . htmlspecialchars($skill) . "</span>";
                                        }
                                    }else{
                                        echo "<span class='text-muted'>No skills selected</span>";
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6">
                                    <strong>Department:</strong><br>
                                    <?php echo htmlspecialchars($department); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if($image_name != ""){ ?>
                        <div class="text-center mb-4">
                            <strong>Profile Image:</strong><br>
                            <img src="uploads/<?php echo htmlspecialchars($image_name); ?>" alt="Profile" class="img-fluid mt-2" style="max-width: 200px; border-radius: 10px;">
                        </div>
                    <?php } ?>

                    <div class="alert alert-success" role="alert">
                        Your registration has been completed successfully!
                    </div>

                    <div class="text-center">
                        <a href="login.php" class="btn btn-primary btn-lg">Go to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>