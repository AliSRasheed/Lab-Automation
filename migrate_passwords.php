<?php
// Run this only ONCE for migration purposes!

include('admin-portal/includes/db.php');

// Default password to assign (employees can change later in settings.php)
$defaultPassword = "default123";
$hashedDefault = password_hash($defaultPassword, PASSWORD_DEFAULT);

// Fetch all users
$sql = "SELECT UserID, UserName, Password FROM Users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $uid = $row['UserID'];
        $pass = $row['Password'];

        // If password is missing or not a bcrypt hash (bcrypt hashes always start with "$2y$")
        if (empty($pass) || strpos($pass, '$2y$') !== 0) {
            $update = "UPDATE Users SET Password='$hashedDefault' WHERE UserID=$uid";
            if ($conn->query($update)) {
                echo "✅ User {$row['UserName']} updated with default hashed password.<br>";
            } else {
                echo "❌ Error updating {$row['UserName']}: " . $conn->error . "<br>";
            }
        } else {
            echo "ℹ️ User {$row['UserName']} already has a hashed password.<br>";
        }
    }
} else {
    echo "No users found in DB.";
}
?>
