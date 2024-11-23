<?php
session_start(); // Start the session

// Check if the user is logged in
if(!isset($_SESSION['userEmail'])){
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome to the Index Page</h1>
    <p>Hello, <?php echo htmlspecialchars($_SESSION['userEmail']); ?>! You are now logged in.</p>
    <a href="logout.php">Logout</a>
</body>
</html>