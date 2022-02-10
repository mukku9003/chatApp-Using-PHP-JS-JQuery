<?php

$servername = "localhost";
$username = 'root';
$pass = '';
$database = 'chatroom';


$conn = mysqli_connect($servername, $username, $pass, $database);

if(!$conn) {
    die("Error Database connection");
}

