<?php
include "connection.php";

//READ

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
?>