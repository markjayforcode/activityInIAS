<?php
include "connection.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check the action type from a hidden input field
    if (isset($_POST['action']) && $_POST['action'] === 'create') {
        // Process create account
        $userEmail = $_POST['userEmail'];
        $userPass = $_POST['userPass'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $adminRole = $_POST['adminRole'];

        createAccount($conn, $userEmail, $userPass, $firstName, $lastName, $adminRole);
    } elseif (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Process delete account
        $userID = $_POST['userID'];

        deleteAccount($conn, $userID);
    }
}




//READ ACCOUNTS

function fetchAccounts($conn){

$sql = "SELECT * FROM tblaccounts";
$result = $conn->query($sql);

if($result === false){
    die("Error fetching accounts:" .$conn->error);

}

//fetch accounts
$accounts = $result->fetch_all(MYSQLI_ASSOC);

$result->free(); //knowledge : freeing results are done tuwing SELECT to diminish memory usaage. avoid memory leaks

return $accounts;

}

//READ POSTS
function fetchPosts($conn){

    $sql = "SELECT * FROM tblposts";
    $result = $conn->query($sql);
    
    if($result === false){
        die("Error fetching posts:" .$conn->error);
    
    }
    
    //fetch posts
    $posts = $result->fetch_all(MYSQLI_ASSOC);
    
    $result->free(); //knowledge : freeing results are done tuwing SELECT to diminish memory usaage. avoid memory leaks
    
    return $posts;
    
    }


//CREATE

function createAccount($conn, $userEmail, $userPass, $firstName, $lastName, $adminRole){
    $sql = "INSERT INTO tblaccounts (userEmail, userPass, firstName, lastName, adminRole) VALUES ('$userEmail', '$userPass', '$firstName', '$lastName', '$adminRole')";  

    if(mysqli_query($conn, $sql)){
        echo "New account created successfully";
        header("Location: ../htmlFiles/adminDashboard.php");
        exit();
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}



//DELETE

function deleteAccount($conn, $userID){
    $sql = "DELETE FROM tblaccounts WHERE userID = $userID";

    if(mysqli_query($conn, $sql)){
        echo "Account deleted successfully";
        header("Location: ../htmlFiles/adminDashboard.php");
        exit();
    }else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

?>


