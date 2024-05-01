<?php
@include 'config.php';
if(isset($_POST['submit'])){
    // mysqli_real_escape_string() this function is to prevent SQL injection
    $username= mysqli_real_escape_string($conn,$_POST['username']);
    $email= mysqli_real_escape_string($conn,$_POST['email']);
    $password= $_POST['password'];
    $encryp=password_hash($password, PASSWORD_BCRYPT);
// To prevent cross-site scripting
    $username=htmlspecialchars($username);
    $email=htmlspecialchars($email);
    
    $select="SELECT * FROM users WHERE email ='$email'";
    $result = mysqli_query($conn,$select);
    if(mysqli_num_rows($result)>0){
        $error[]='User already exists!!';
    }
    else{
        $insert="INSERT INTO users(username,email,password) VALUES('$username','$email','$encryp')";
        mysqli_query($conn,$insert);
        header('location:login.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h3>Registration Form</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <input type="text" name="username" placeholder="Enter your Username" >
            <input type="email" name="email" placeholder="Enter your Email">
            <input type="password" name="password" placeholder="Enter your Password">
            <button type="submit" name="submit">Submit</button>
            <p>If already have an account please <a href="login.php">Login!</a></p>
        </form>
    </div>
</body>
</html>