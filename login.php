<?php
include 'config.php';
if(isset($_POST['submit'])){
    $email= mysqli_real_escape_string($conn,$_POST['email']);
    $password= $_POST['password'];
    $select = "SELECT * FROM users WHERE email = '$email'";
    $check = mysqli_query($conn,$select);
    if(mysqli_num_rows($check)==1){
        $result = mysqli_fetch_assoc($check);
        $hash = $result['password'];
            if(password_verify($password,$hash)){
                session_start();
                $_SESSION['username']= $result['username'];
                header('location:welcome.php');
            }else{
                $error[]="Incorrect Password!!";
            }
    }
    else{
        $error[]="Fields are necessary!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h3>Login Form</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>
            <input type="email" name="email" placeholder="Enter your Email">
            <input type="password" name="password" placeholder="Enter your Password">
            <button type="submit" name="submit">Submit</button>
            <p>If do not have an account please <a href="register.php">register!</a></p>
        </form>
    </div>
</body>
</html>