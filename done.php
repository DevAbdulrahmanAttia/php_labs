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
<title>Review</title>
</head>

<body>

<h2>
<?php
echo "Thanks " . $title . " " . $first_name . " " . $last_name;
?>
</h2>

<p><strong>Please Review Your Information:</strong></p>

<p>
<?php echo "Name: " . $first_name . " " . $last_name; ?>
</p>

<p>
<?php echo "Address: " . $address; ?>
</p>

<p>
<?php echo "Country: " . $country; ?>
</p>

<p>
Skills:
<?php
if(!empty($skills)){
    foreach($skills as $skill){
        echo $skill . " ";
    }
}else{
    echo "No skills selected";
}
?>
</p>

<p>
<?php echo "Department: " . $department; ?>
</p>

<?php if($image_name != ""){ ?>

<p>
<img src="uploads/<?php echo $image_name; ?>" width="150">
</p>

<?php } ?>

</body>
</html>