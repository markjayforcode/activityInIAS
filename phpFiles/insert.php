<?php
include "connection.php";

//take values from form
$userPass = $_REQUEST['userPass'];
$firstName = $_REQUEST['firstName'];
$lastName = $_REQUEST['lastName'];

//insert values into database 

$sql = "INSERT INTO `tblaccounts` (userEmail, userPass, firstName, lastName) VALUES ('$userEmail', '$userPass', '$firstName', '$lastName')";

if(mysqli_query($conn, $sql)){
    echo "New record created successfully";
}else{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
