<?php

// Start session memory
session_start();

// Verify if session memory doesn't contains admin logged
if (!isset($_SESSION['admin'])) {
    
    // Redirect to Admin Login
    header('Location: /admin/index.php');
}
?>

<p>Admin Home Page</p>