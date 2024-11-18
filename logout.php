<?php
include 'logger.php';
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Log the logout action
    $logger = new Logger();
    $logger->logUserAction($userId, 'logout', 'User logged out');

    // Destroy the session
    session_unset();
    session_destroy();
}


// Destroy all session data
//session_unset();
//session_destroy();

// Redirect to login page or homepage
header("Location: login.php");
exit;
?>
