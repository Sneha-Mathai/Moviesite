<?php
include 'user.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    //$role = $_POST['role'];
    $user = new User();
    $loginResult = $user->login($email, $password);  
}
session_start();
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Log the login action
    // $logger = new Logger();
    // $logger->logUserAction($userId, 'login', 'User logged in');

    // Redirect based on role
    if ($_SESSION['role'] == 'Admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: user_dashboard.php");
    }

    exit(); // Make sure this is after the logging
}








?>


<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    
    <form action="login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!--<label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>-->

        <button type="submit">Login</button>
    </form>
</body>
</html>

