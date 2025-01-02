<?php 

$servername ="localhost";
$username ="root";
$password ="";
$database ="web_db";

$connection = new mysqli($servername, $username, $password, $database);
if($connection){
    echo"Database connected";
}