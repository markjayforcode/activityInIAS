<?php
include "connection.php";
session_start();
// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../htmlFiles/userLogin.html"); // Redirect to login page if not logged in
    exit();
}

//get the values
$userID = $_SESSION['userID'];
$postContent = $_POST['postContent'];


//insert values into database 

$sql = "INSERT INTO `tblposts` (userID, postContent, postDate) VALUES (?, ?, NOW())"; //new knowledge use questions marks as form of security
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $userID, $postContent);

if ($stmt->execute()) {
    echo "Post successfully added!";
    header("Location: ../htmlFiles/index.php");
} else {
    echo "Error: " . $stmt->error;
}

mysqli_close($conn);
?>
