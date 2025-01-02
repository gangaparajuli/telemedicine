<?php

include 'databaseconnection.php';

//start the session to use session variables
session_start();

//check if the 'submit'button is clicked in the form
if(isset($_POST['submit'])){

    //sanitize user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    //query the database to check if the entered username and password exist in the 'users' table
    $select_users = mysqli_query($connection, "SELECT * FROM `users` WHERE username = '$username' AND password = '$password'");

    //if the user exists, set session variables for username and password , and redirect to the home page
    if(mysqli_num_rows($select_users) >0){

        $row = mysqli_fetch_assoc($select_users);


        //store user details in the session
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        header('location:home.html');
    }else{
        $message[] = 'user doesnot exist!';
    }
}
//check if there are any message to display(like an error)
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
    <title>Log in</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <!-- Header -->
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

     <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Log In</button>
                <p>don't have a account? <a href ="register.php"> Signup Now </a></p>
            </div>
        </form>
     </div>
</body>
</html>