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
     <div class="d-flex justify-content-between align-items-center">
      <h1>List of users</h1>
      <a class="btn btn-add" href="adminCreate.php"> <i class="fa fa-plus"></i>Add new User </a>
     </div>
        <table class="table table-color">
          <thead class="table-color">
            <th scope="col">userID </th>
            <th scope="col">userEmail </th>
            <th scope="col">userPass </th>
            <th scope="col">firstName</th>
            <th scope="col">lastName </th>
            <th scope="col">adminRole </th>
          </thead>
          <tbody>
            <?php
             $accounts = fetchAccounts($conn); //fetch accounts 
             foreach($accounts as $account){
              echo '<tr class="table-color">';
              echo '<th scope="row">' . htmlspecialchars($account['userID']) . '</th>';
              echo '<td>'.htmlspecialchars($account['userEmail']) . '</td>';
              echo '<td>'.htmlspecialchars($account['userPass']) . '</td>';
              echo '<td>'.htmlspecialchars($account['firstName']) . '</td>';
              echo '<td>'.htmlspecialchars($account['lastName']) . '</td>';
              echo '<td>'.htmlspecialchars($account['adminRole']) . '</td>';
              echo "<td>
              <form action='../phpFiles/adminfunctions.php' method='POST' style='display:inline-block;'>
                 <input type='hidden' name='action' value='delete'>
                  <input type='hidden' name='userID' value='{$account['userID']}'>
                  <button type='submit' class='btn btn-danger'>Delete</button>
              </form>
          </td>";
          echo "<td>
              <form action='adminUpdate.php' method='GET' style='display:inline-block;'>
                  <input type='hidden' name='userID' value='{$account['userID']}'>
                  <button type='submit' class='btn btn-success'>Update</button>
              </form>
          </td>";
             }
            ?>
          </tbody>
        </table>
  
     </div>    
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
