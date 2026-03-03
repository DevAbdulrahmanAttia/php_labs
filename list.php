<?php
require "connection.php";

echo "<h2>All Users</h2>";

echo "<table border='1' cellpadding='5'>";
echo "<tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Actions</th>
      </tr>";

$stmt = $connection->query("SELECT * FROM emp");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['f_name']."</td>";
    echo "<td>".$row['l_name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['address']."</td>";
    echo "<td>
            <a href='view.php?id=".$row['id']."'>View</a> |
            <a href='delete.php?id=".$row['id']."'>Delete</a>
          </td>";
    echo "</tr>";
}

echo "</table>";
?>