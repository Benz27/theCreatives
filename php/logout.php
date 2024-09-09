<?php
$asd=null;
session_start();
if(isset($_SESSION['user_id'])){ //clears the session user_id variable if there is any value. if there is no value it cant be redirected to the mainpage
unset($_SESSION['user_id']);
}
header("Location: ../html/login.html");
?>