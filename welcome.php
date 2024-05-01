<?php
@include 'config.php';
session_start();
if(!isset($_SESSION['username'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Welcome <span><?php echo $_SESSION['username'];?></span></h2>
    <a href="logout.php">Logout</a>
    <a href="userdetail.php">User Profile</a>
    </div>
</body>
</html>