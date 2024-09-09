<?php

if($_SERVER['REQUEST_METHOD']=='POST'){     // will execute when something were posted from html form(submit button clicked) 
    $userborder="";     // will hold a string of css style value that the input uname border style will use 
    $passborder="";     // will hold a string of css style value that the input pass border style will use 
    $alertp="";     // will hold an innerhtml value of a paragraph element named alertp 
    $userval="";    // will match the value of uname 

$uname=$_POST['uname'];     // holds the value of input element named uname 
$pass=$_POST['pass'];   // holds the value of input element named pass 

if(empty($uname) && empty($pass)){  // will execute if both uname and pass inputs were empty and will echo a javascript text(alternative in case it redirects with empty inputs)
    echo '<script type="text/JavaScript"> 
        alert("fields cannot be empty");
        </script>'
   ;
}
else{   // if there were neither one input
$sql="SELECT * FROM user where username='$uname'"; 
$result=mysqli_query($link, $sql);  
if($result && mysqli_num_rows($result) > 0){    // will check if the value of uname input or username exists in the database 


    $user_data=mysqli_fetch_assoc($result);     // if data exists it will fetch the whole row of information with its matching username 
    if($user_data['password']===$pass){     // and will check if the password matches the input username 
        $_SESSION['user_id']=$user_data['user_id'];     // if the password matches, the session's user_id value will match the account's id
        $_SESSION['usertype']=$user_data['usertype'];   
        header("Location: explore.html");    // and will be redirected to the homepage 

    }else{      // else if the password did not match the username 
        $userval=$uname;    // if data exists it will check if the password matches the input username 
        $passborder="2px solid red";    // the $passborder string value will be used in a javascript code that will then change the border style of input pass to red indicating that the password typed was wrong
        $alertp="Incorrect password!";  // the $alertp string value will be used in a javascript code that will then change the innerhtml or text value of paragraph element "alertp" indicating that the password typed was wrong
        
    }

}else{   // else if the password did not match the username 
    $userval=$uname;    // the page reloads so the value typed by the user in the textboxes disappears. the $userval will match the text typed by the user in the uname input field to preserve tha value he typed, will be used by a javascript code to indicate that the username he typed does not match any account
    $userborder="2px solid red";    // same as $passborder but in the uname input indicating the username does not exist
    $alertp="Username does not belong to an account!";  // will change the innerhtml or text value of paragraph element "alertp" indicating that the username does not exist 

}

}
}
?>