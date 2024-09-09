<?php
//this connects the website to the sql database file
$dbhost = "";  //server host
$dbuser = "";   //server username
$dbpass = "";       //server password
$dbname = "";  //the name of the database

$link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);     //initiates connection

if($link === false){    //if the connection fails or invalid
    die("Could not connect!" . mysqli_connect_error()); //it will show an error message
}

?>