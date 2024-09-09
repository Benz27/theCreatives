<?php
    
    if($_SERVER['REQUEST_METHOD']=='POST'){ //will execute if the form was submitted/posted

        $uname=$_POST['uname'];     //holds the value of uname input from the submitted form of signup.html
        $fname=$_POST['fname'];     //holds the value of fname input from the submitted
        $lname=$_POST['lname'];     //holds the value of lname input from the submitted
        $email=$_POST['email'];     //holds the value of email input from the submitted
        $pass=$_POST['pass'];       //holds the value of pass input from the submitted
        $usertype="user";

        $user_id=mt_rand(1000000, 9999999);     //generates random 7 digit numbers for $user_id
       
        
        //this block of code will make sure that the generated id were unique from the existing ones in the databases, if it matches some existing id it will then generate a new one until none of them matches
        $sql="SELECT user_id FROM user where user_id=$user_id";     //sql statment
        $result=mysqli_query($link, $sql);      //executes the query
        if($result && mysqli_num_rows($result) > 0){        //executes if the result is true(an id was found that matches the current genereated id) 
            $user_data=mysqli_fetch_assoc($result);         //fetches the whole data of the found id
            while($user_id ==  $user_data['user_id']){      //loops the code if the newly generated id still matches the found id and will stop if it no longer matches 
                $user_id=mt_rand(1000000,9999999);       //generates random 7 digit numbers for $user_id
    
            }

        }
     
                    $sql="INSERT INTO user (user_id, username, email, password, usertype) values ($user_id,'$uname','$email','$pass','$usertype')"; 
                    mysqli_query($link, $sql);//inserts user's id, username, email and password

                    $sql="INSERT INTO info (user_id, fname, lname) values ($user_id,'$fname','$lname')";
                    mysqli_query($link, $sql);//inserts user's id, firstname and lastname

                    
                    header("Location: login.html");
                    

    }
?>