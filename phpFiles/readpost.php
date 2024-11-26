<?php
include "connection.php";

function fetchPosts($conn){
$sql = "SELECT tblposts.postID, tblaccounts.userEmail, tblposts.postContent, tblposts.postDate FROM tblposts INNER JOIN tblaccounts  ON tblposts.userID = tblaccounts.userID ORDER BY postDate DESC";

$result = $conn->query($sql);
return $result->fetch_all(MYSQLI_ASSOC);

}
?>
