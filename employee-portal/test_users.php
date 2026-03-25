<?php
include('includes/db.php');

$res = $conn->query("SELECT UserID, UserName, Password FROM users");
while($row = $res->fetch_assoc()) {
    echo "<pre>"; print_r($row); echo "</pre>";
}