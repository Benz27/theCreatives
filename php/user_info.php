<?php
$ui_id=$_SESSION['user_id'];
$sql = "SELECT * FROM info where user_id=$ui_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){  
        $ui_pic= $row['pic']  ;
        $ui_coverpic= $row['coverpic']  ;
          }
      mysqli_free_result($result);
  } 
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT username, usertype FROM user where user_id=$ui_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){     
        $ui_uname= $row[0]  ;
        $ui_utype= $row[1]  ;
          }
      mysqli_free_result($result);
  } 
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

?>

