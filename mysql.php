<?php
$servername = "localhost";
$username = "root";
$password = "my_P4ssw0rd";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>