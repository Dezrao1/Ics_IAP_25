<?php
require_once 'db.php';

$sql = "SELECT username, email FROM users ORDER BY username ASC";
$result = $conn->query($sql);

echo "<h2>Registered Users</h2>";
echo "<ol>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row['username'] . " (" . $row['email'] . ")</li>";
    }
} else {
    echo "<li>No users found</li>";
}
echo "</ol>";

$conn->close();
?>