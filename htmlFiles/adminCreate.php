<?php
session_start(); // Start the session

// Check if the user is logged in
if(!isset($_SESSION['userEmail'])){
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include '../phpFiles/connection.php'; // Include database connection
include '../phpFiles/adminfunctions.php';    // Include admin function

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" href="../cssFiles/index.css">

     <style>
      .btn-create {
          background-color: #d69936;
          color: #212519;
          font-weight: bold;
          border-color: #212519;
          transition: all 0.3s ease;
      }

      .btn-create:hover {
          transform: scale(1.1);
          background-color: #d49735;
          color: #212519;
          font-weight: bold;
          border-color: #212519;
      }
      </style>
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
    <div class="container-fluid d-flex justify-content-center align-items-center p-5 h-75">
     <div class="container content-container shadow-lg rounded-4 w-25 h-85  p-4"> <!-- Big white container sa gitna -->
        <form action="../phpFiles/adminfunctions.php" method="post"> <!--Create function account-->
        <input type="hidden" name="action" value="create">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="userEmail" name="userEmail" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="userPass" name="userPass" placeholder="Password">
                <label for="floatingPassword">Password</label>  
              </div>
              <div class="form-floating mb-3">
                <input type="name" class="form-control" id="firstName" name="firstName" placeholder="First Name">
                <label for="floatingPassword">First Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="name" class="form-control" id="lastName" name="lastName" placeholder="Last Name">
                <label for="floatingPassword">Last Name</label>
              </div>

              <div class="form-floating mb-5">
                <select class="form-control" id="adminRole" name="adminRole">
                    <option value="true">True</option>
                    <option value="false">False</option>
                </select>
                <label for="adminRole">Admin Role</label>
              </div>
    
              <button class="btn btn-lg float-end btn-create" type="submit">Create Account</button>
              </form>
  
     </div>    
    </div>
    
     
          

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>