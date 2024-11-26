<?php
include "connection.php";
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../htmlFiles/userLogin.html"); // Redirect to login page if not logged in
    exit();
}

// Get the values from the POST request
$userID = $_SESSION['userID'];
$postID = $_POST['postID']; // Correct name for the hidden input field
$commentContent = $_POST['commentContent'];

// Validate the input
if (empty($commentContent)) {
    echo "Comment content cannot be empty.";
    exit();
}

// Insert values into the database
$sql = "INSERT INTO `tblcomments` (postID, userID, commentContent, commentDate) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Error preparing SQL statement: " . $conn->error);
}

// Bind parameters: `postID` and `userID` as integers, `commentContent` as a string
$stmt->bind_param("iis", $postID, $userID, $commentContent);

if ($stmt->execute()) {
    echo "Comment successfully added!";
    header("Location: ../htmlFiles/index.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$conn->close();
?>
