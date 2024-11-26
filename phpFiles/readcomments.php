<?php
include "connection.php";

function fetchComments($conn, $postID) {
    $sql = "SELECT 
                tblaccounts.userEmail, 
                tblcomments.commentContent, 
                tblcomments.commentDate 
            FROM tblcomments
            INNER JOIN tblposts ON tblcomments.postID = tblposts.postID
            INNER JOIN tblaccounts ON tblcomments.userID = tblaccounts.userID
            WHERE tblcomments.postID = ?
            ORDER BY tblcomments.commentDate ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postID); // Bind the postID
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC); // Fetch all comments as an associative array
}
?>
