<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to </h1> 
        <h1><b>Chicago Lobbyist Record Management System.</b></h1>
    </div>
    <p>
        <a href="resetPassword.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
    </p>
    <p>
        </br></br><a href="profile.php" class="btn btn-primary">View Personal Information</a>
        <a href="editProfile.php" class="btn btn-primary">Update Personal Information</a>
    </p>
    <p>
        </br></br><a href="viewTables.php" class="btn btn-primary">View Table Information</a>
        <a href="queryPage.php" class="btn btn-primary">Query Tables</a>
    </p>
</body>
</html>