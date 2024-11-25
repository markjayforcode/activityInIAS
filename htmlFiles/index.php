<?php
session_start(); // Start the session

// Check if the user is logged in
if(!isset($_SESSION['userEmail'])){
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();


}
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
     <div class="container content-container shadow-lg rounded-4 w-50">
     <div class="container text-center">
  <div class="row">
    <div class="col-3 d-flex align-items-center">
      username
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


        <div class="container d-flex border-bottom">
            <h1 class="text-center">Welcome</h1>

        </div>
    
     </div>   
   
    </div>
    
            <!-- Modal -->
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>