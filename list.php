<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$lines = file("data.txt");

echo "<h2>All Users</h2>";

echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Country</th>
        <th>Actions</th>
      </tr>";

$id = 0;

foreach($lines as $line){

    $data = explode("|", $line);

    echo "<tr>";
    echo "<td>".$id."</td>";
    echo "<td>".$data[0]."</td>";
    echo "<td>".$data[1]."</td>";
    echo "<td>".$data[3]."</td>";
    echo "<td>
            <a href='view.php?id=".$id."'>View</a> |
            <a href='delete.php?id=".$id."'>Delete</a>
          </td>";
    echo "</tr>";

    $id = $id + 1;
}

echo "</table>";
?>