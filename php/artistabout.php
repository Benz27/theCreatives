<?php

$about_uid=$_SESSION['user_id'];
$about_id=$_GET['artist'];

$sql = "SELECT * FROM info where user_id=$about_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){  
        $about_fname= $row['fname']  ;
        $about_lname= $row['lname']  ;
        $about_pic= $row['pic']  ;
        $about_coverpic= $row['coverpic']  ;
        $about_address= $row['address']  ;
        $about_contno= $row['contno']  ;
        $about_state=  $row['state']  ;
        $about_country=  $row['country']  ;
        $about_exp= $row['exp']  ;
        $about_addet= $row['addet']  ;
          }
      mysqli_free_result($result);
  } else{
      echo "No records matching your query were found.";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT username, email,usertype FROM user where user_id=$about_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){     
        $about_uname= $row[0]  ;
        $about_email= $row[1]  ;
        $about_usertype= $row[2]  ;
          }
      mysqli_free_result($result);
  } else{
      echo "No records matching your query were found.";
  }
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}







// Close connection

?>

