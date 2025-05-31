<?php
$server = "localhost";
$username ="root";
$password ="";
$database ="jueli_ltd";

$conn = mysqli_connect($server, $username, $password, $database);
if(!$conn){
    die("<script>alert('Connection Failed.')</script>");
}
?>