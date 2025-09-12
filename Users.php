<?php
// users.php
require_once 'Services/db.php';

$sql = "SELECT username, email, created_at FROM users ORDER BY username ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registered Users</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        ol { font-size: 18px; }
        li { margin: 10px 0; padding: 10px; background: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Registered Users (Ordered by Username Ascending)</h2>
    
    <ol>
    <?php
    if ($result->num_rows > 0) {
        $count = 1;
        while($row = $result->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($row['username']) . "</strong> - " 
                 . htmlspecialchars($row['email']) . " (Joined: " . $row['created_at'] . ")</li>";
            $count++;
        }
    } else {
        echo "<li>No users registered yet</li>";
    }
    ?>
    </ol>

    <p><a href="index.php">Back to Home</a></p>
</body>
</html>

<?php $conn->close(); ?>