<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$first_name = $_POST['first_name'];
$last_name  = $_POST['last_name'];
$address    = $_POST['address'];
$country    = $_POST['country'];
$gender     = $_POST['gender'];
$skills     = $_POST['skills'];
$department = $_POST['department'];
$password   = $_POST['password'];


if($first_name == ""){
    echo "<h3 style='color:red;'>First Name is required</h3>";
    exit;
}

if($last_name == ""){
    echo "<h3 style='color:red;'>Last Name is required</h3>";
    exit;
}

if($address == ""){
    echo "<h3 style='color:red;'>Address is required</h3>";
    exit;
}

if($gender == ""){
    echo "<h3 style='color:red;'>Gender is required</h3>";
    exit;
}

if(strlen($password) < 6){
    echo "<h3 style='color:red;'>Password must be at least 6 characters</h3>";
    exit;
}

if($gender == "Male"){
    $title = "Mr";
}else{
    $title = "Miss";
}
$skills_string = "";

if(!empty($skills)){
    foreach($skills as $skill){
        $skills_string = $skills_string . $skill . ",";
    }
}

$data = $first_name . "|" .
        $last_name . "|" .
        $address . "|" .
        $country . "|" .
        $gender . "|" .
        $skills_string . "|" .
        $department . "\n";

$fp = fopen("data.txt", "a");
fwrite($fp, $data);
fclose($fp);

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
<?php
echo "Name: " . $first_name . " " . $last_name;
?>
</p>

<p>
<?php
echo "Address: " . $address;
?>
</p>

<p>
<?php
echo "Country: " . $country;
?>
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
<?php
echo "Department: " . $department;
?>
</p>

</body>
</html>