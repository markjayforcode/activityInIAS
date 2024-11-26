<?php
session_start(); // Start the session

// Check if the user is logged in
if(!isset($_SESSION['userEmail'])){
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include '../phpFiles/connection.php'; // Include database connection
include '../phpFiles/readpost.php';    // Include fetchPosts function
include '../phpFiles/readcomments.php'; // Include fetchComments function

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../cssFiles/index.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
            <!-- Left Section -->
            <div class="navbar-nav me-auto">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </div>
            <!-- Middle Section -->
            <div class="navbar-nav me-auto">
                <a class="nav-link" href="#">Home </a>
            </div>

            <!-- Right Section -->
            <div class="navbar-nav">
                <a class="nav-link" href="../phpFiles/logout.php">Logout</a>
            </div>
    </nav>
    <div class="container-fluid d-flex justify-content-center align-items-center p-5">
     <div class="container content-container shadow-lg rounded-4 w-50"> <!-- Big white container sa gitna -->
            <div class="container text-center border-bottom"> <!-- container per post sa loob ni white -->
              <div class="row">
                <div class="col-3 d-flex align-items-center">
              <?php
                echo htmlspecialchars($_SESSION['userEmail']); // Display email
              ?>
                </div>
                <div class="col-6">
                  <button type="button" class="btn w-100 modal-post" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="float-start">Launch demo modal</span>
                  </button>
                </div>
                <div class="col-3 d-flex justify-content-center align-items-center">
                  POST
                </div>
              </div>
           </div>   
           <?php
        $posts = fetchPosts($conn); // Fetch all posts once
        foreach ($posts as $post) {
            // Generate a unique ID for each modal using the post ID
            $modalId = "commentModal" . htmlspecialchars($post['postID']);

            // Post container
            echo '<div class="container text-center border-bottom">';
            echo '  <div class="row">';
            echo '    <div class="col-3 d-flex align-items-center">';
            echo        htmlspecialchars($post['userEmail']); // Display email
            echo '    </div>';
            echo '    <div class="col-9">';
            echo '      <button type="button" class="btn w-100 modal-post" data-bs-toggle="modal" data-bs-target="#' . $modalId . '">';
            echo '        <span class="float-start">' . htmlspecialchars($post['postContent']) . '</span>'; // Display post content
            echo '      </button>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';

            // Modal for commenting (added regardless of whether there are comments)
            echo '<div class="modal fade modal-lg" id="' . $modalId . '" tabindex="-1" aria-labelledby="modalLabel' . $modalId . '" aria-hidden="true">';
            echo '  <div class="modal-dialog">';
            echo '    <div class="modal-content">';
            echo '      <div class="modal-header">';
            echo '        <h1 class="modal-title fs-5" id="modalLabel' . $modalId . '">Comment on Post</h1>';
            echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
            echo '      </div>';
            echo '      <div class="modal-body">';
            echo '        <form action="../phpFiles/commenting.php" method="POST">';
            echo '          <input type="hidden" name="postID" value="' . htmlspecialchars($post['postID']) . '">';
            echo '          <div class="mb-3">';
            echo '            <label for="comment-text-' . $modalId . '" class="form-label">Your Comment</label>';
            echo '            <textarea class="form-control" name="commentContent" id="comment-text-' . $modalId . '" rows="3" required></textarea>';
            echo '          </div>';
            echo '          <div class="mb-3">';
            echo '            <label for="comment-text-' . $modalId . '" class="form-label">Comments</label>';

            // Fetch comments and display them if any
            $comments = fetchComments($conn, $post['postID']); // Fetch comments for the post
            if ($comments) {
                foreach ($comments as $comment) {
                    echo '            <div class="container">';
                    echo '              <div class="row">';
                    echo '                <div class="col-3">';
                    echo          htmlspecialchars($comment['userEmail']);
                    echo '                </div>';
                    echo '                <div class="col-5">';
                    echo '                  <p>' . htmlspecialchars($comment['commentContent']) . '</p>';
                    echo '                </div>';
                    echo '                <div class="col-4">';
                    echo '                  ' . htmlspecialchars($comment['commentDate']);
                    echo '                </div>';
                    echo '              </div>';
                    echo '            </div>';
                }
            } else {
                echo '            <p>No comments yet. Be the first to comment!</p>';
            }
            echo '          </div>';
            echo '          <div class="modal-footer">';
            echo '            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
            echo '            <button type="submit" class="btn btn-primary">Submit Comment</button>';
            echo '          </div>';
            echo '        </form>';
            echo '      </div>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
        }
        ?>

     </div>    
    </div>
    
            <!-- Modal for posting -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Share your thoughts</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="../phpFiles/posting.php" method="POST">
            <textarea name="postContent" id="postContent"></textarea>
           
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">POST</button>
                </form>
            </div>
            </div>
        </div>
        </div>
          
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>