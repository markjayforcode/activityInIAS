<?php
session_start(); // Start the session

// Check if the user is logged in
if($_SESSION['adminRole'] == false){
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

include '../phpFiles/connection.php'; // Include database connection

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated data from the form
    $userID = $_POST['userID'];
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $adminRole = $_POST['adminRole'];

    // Prepare the SQL query to update the record
    $sql = "UPDATE tblaccounts SET 
            userEmail = ?, 
            userPass = ?, 
            firstName = ?, 
            lastName = ?, 
            adminRole = ? 
            WHERE userID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters (email, password, first name, last name, admin role, user ID)
        $stmt->bind_param("sssssi", $userEmail, $userPass, $firstName, $lastName, $adminRole, $userID);
        $stmt->execute();
        header("Location: adminDashboard.php");  // Redirect to the admin dashboard after successful update
        $stmt->close();
    } else {
        echo "Error: Could not prepare the query.";
    }
}

// Get userID from URL
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Fetch account by userID
    $sql = "SELECT * FROM tblaccounts WHERE userID = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameter (i means integer)
        $stmt->bind_param("i", $userID);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
    }
} else {
    // If userID is not set, handle the error (e.g., redirect or show an error message)
    echo "Error: User ID not provided.";
    exit(); // Exit if user ID is missing
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
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
            <div class="navbar-nav me-auto">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-link" href="../phpFiles/logout.php">Logout</a>
            </div>
</nav>
    <div class="container-fluid d-flex justify-content-center align-items-center p-5 h-75">
     <div class="container content-container shadow-lg rounded-4 w-25 h-85 p-4">
        <form action="adminUpdate.php" method="post">
        <input type="hidden" name="userID" value="<?php echo $user['userID']; ?>">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="userEmail" name="userEmail" value="<?php echo $user['userEmail']; ?>">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="userPass" name="userPass" value="<?php echo $user['userPass'];?>">
                <label for="floatingPassword">Password</label>  
              </div>
              <div class="form-floating mb-3">
                <input type="name" class="form-control" id="firstName" name="firstName" value="<?php echo $user['firstName'];?>">
                <label for="floatingPassword">First Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="name" class="form-control" id="lastName" name="lastName" value="<?php echo $user['lastName'];?>">
                <label for="floatingPassword">Last Name</label>
              </div>

              <div class="form-floating mb-5">
                <select class="form-control" id="adminRole" name="adminRole">
                    <option value="true" <?php echo $user['adminRole'] == 'true' ? 'selected' : ''; ?>>True</option>
                    <option value="false" <?php echo $user['adminRole'] == 'false' ? 'selected' : ''; ?>>False</option>
                </select>
                <label for="adminRole">Admin Role</label>
              </div>
              <button class="btn btn-lg float-end btn-create" type="submit">Update Account</button>
        </form>
     </div>    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>
</html>
