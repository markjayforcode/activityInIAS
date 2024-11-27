<?php
include "connection.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];

    //Select data from database
    $stmt = $conn -> prepare("SELECT userID,userPass, adminRole FROM tblaccounts WHERE userEmail = ?");
    $stmt -> bind_param("s", $userEmail);
    $stmt -> execute();
    $stmt -> store_result();

    if($stmt -> num_rows() > 0){
        $stmt -> bind_result($userID,$db_userPass,$adminRole);
        $stmt -> fetch();



        if($userPass === $db_userPass){
            if($adminRole === "true"){
                echo "login successful as admin";
                session_start();
                $_SESSION['userEmail'] = $userEmail;
                $_SESSION['userID'] = $userID;
                $_SESSION['adminRole'] = $adminRole;
                header("Location: ../htmlFiles/adminDashboard.php");
                exit();
            }else{     
                echo "login successful";
                session_start();
                $_SESSION['userEmail'] = $userEmail;
                $_SESSION['userID'] = $userID;
             
    
                header("Location: ../htmlFiles/index.php");
                exit();}
      
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
