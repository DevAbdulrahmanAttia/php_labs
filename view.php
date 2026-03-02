<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$id = $_GET['id'];

$lines = file("data.txt");

$line = $lines[$id];

$data = explode("|", $line);

echo "<h2>User Details</h2>";

echo "First Name: " . $data[0] . "<br>";
echo "Last Name: " . $data[1] . "<br>";
echo "Address: " . $data[2] . "<br>";
echo "Country: " . $data[3] . "<br>";
echo "Gender: " . $data[4] . "<br>";
echo "Skills: " . $data[5] . "<br>";
echo "Department: " . $data[6] . "<br>";

echo "<br><a href='list.php'>Back</a>";
?>