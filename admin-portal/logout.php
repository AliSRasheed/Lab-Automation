<?php
session_start();
session_unset();  // clear all session vars
session_destroy(); // destroy session
header("Location: login.php");
exit;
