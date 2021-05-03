<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id16390077_moviedb_username');
define('DB_PASSWORD', 'ntBP<RYsa7)VvaY|');
define('DB_NAME', 'id16390077_moviedb');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

<!-- 
    title
    year
    rating
    moviedb
    moviedb_username
    ntBP<RYsa7)VvaY|
 -->

