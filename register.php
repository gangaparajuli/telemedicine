<?php

include 'databaseconnection.php';

//initialize an empty array to store message
$message =[];

if(isset($_POST['submit'])){
    //get and sanitize user input form the form
    $username = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, ($_POST['password']));
    $confirm_password = mysqli_real_escape_string($connection, ($_POST['confirm-password']));

    //check if a user already exists with the provided username
    $select_users_username = mysqli_query($connection, "SELECT * FROM `users` WHERE username ='$username'");

    //if the username is already taken, add an error message
    if(mysqli_num_rows($select_users_username) > 0){
        $message[] = 'user with this username already exists!';
    }else{
        if($password != $confirm_password){
        $message[] = 'Confirm password does not match!';
    }
    else{
        //if everything is fine, insert the user into the database
        mysqli_query($connection, "INSERT INTO `users`(username, email, password) VALUES('$username', '$email', '$password')") or die('query failed');
        $message[] ='Signup successfully!';

        //redirect the user to the login page
        header('location:login.php');

    }
}
}

//if there are any messages, loop through them and display each one
if(!empty($message)){
    foreach($message as $msg){
        echo '
        <div class="message">
        <span>' .$msg. '</span>
        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet"  href ="style.css">
</head>
<body>

    <!-- header -->
    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <img src="./images/logo.png" width="160px">
                </div>
                <nav>
                    <ul id="MenuItems">
                    <li><a href="home.php" class="active">Home</a></li>
                    <li><a href="services.php" class="active">Services</a></li>
                    <li><a href="help.php" class="active">Help</a></li>
                    <li><a href="aboutus.php" class="active">About Us</a></li>
                </ul>
                </nav>
                <div class="right">
                    <a href="login.php"> <button class="btn" id="loginBtn">Log In</button></a>
                    <a href="register.php"> <button class="btn" id="signupBtn">Sign up</button></a>
                </div>
            </div>
        </div>
     </div>
     <div class="signup-container">
        <h2>Sign-up</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="new-name">Username</label>
                <input type="text" id="new-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Sign up</button>
                <p> Already Signup. <a href = "login.php">Login Now</a></p>
            </div>
        </form>
     </div>
    
</body>
</html>