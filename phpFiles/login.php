<?php
include "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];

    //Select data from database
    $stmt = $conn -> prepare("SELECT userPass FROM tblaccounts WHERE userEmail = ?");
    $stmt -> bind_param("s", $userEmail);
    $stmt -> execute();
    $stmt -> store_result();

    if($stmt -> num_rows() > 0){
        $stmt -> bind_result($db_userPass);
        $stmt -> fetch();

        if($userPass === $db_userPass){
            echo "login successful";
            session_start();
            $_SESSION['userEmail'] = $userEmail;
            header("Location: ../htmlFiles/index.php");
            exit();
        }else
        {
            echo "Incorrect password";
        }
        
    }else{
        echo "User not found";
    }
    $stmt -> close();
    $conn -> close();
    
}

?>
