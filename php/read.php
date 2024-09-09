<?php
//upon loging in, the website session will have the user's id indicating that this user/someone was logged in and using the page
//also, session's $id variable will match the id indicating that this session is currently the user's session
//this fuction only checks if the user_id has value and existing in the database
function check_login($link){

    if(isset($_SESSION['user_id'])){       //checks if $_SESSION['user_id'](declared session id) has value

        //this checks if the id was valid or existing in database
        $id = $_SESSION['user_id'];     //gets the session's user_id
        $query="select user_id from user where user_id = '$id'";    
        $result=mysqli_query($link,$query);     
        if($result && mysqli_num_rows($result) > 0){    //if the id exist it will return or end the whole function 


            $user_data=mysqli_fetch_assoc($result);     //fetches the id found
            return $user_data;      //ends the execution of the fuction



        }
    }   

    header("Location: ../html/login.html"); //redirects back to the login page if session id does not have value


}
?>