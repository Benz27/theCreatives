<?php

if($_SERVER['REQUEST_METHOD']=='POST'){ //will execute if the form was submitted/posted
    $ab_id=$_SESSION['user_id'];

    $sql = "SELECT username FROM user where user_id=$ab_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){  
        $ab_username=$row[0];
          }
      mysqli_free_result($result);
  } 
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

    $ab_artist=$_POST['artistid'];

    $ab_uname= $_POST['artistuname'];
    $ab_fulln= $_POST['fulln'];

    $ab_type = $_POST['type'];
    $ab_size = $_POST['size'];

    $ab_price = $_POST['price'];

    $ab_addet= $_POST['addet'];

    $ab_refpic= $_POST['refpic'];
    $ab_refpicname= $_POST['refpicname'];


    $ab_date= $_POST['date'];
    $ab_tardate= $_POST['tardate'];

    $c_id=mt_rand(1000000, 9999999);     
       
        
    $sql="SELECT c_id FROM commision where c_id=$c_id";    
    $result=mysqli_query($link, $sql);     
    if($result && mysqli_num_rows($result) > 0){        
        $user_data=mysqli_fetch_assoc($result);        
        while($c_id ==  $user_data['user_id']){      
            $c_id=mt_rand(1000000,9999999);      

        }

    }
 

    $sql="INSERT INTO commision values ($c_id,$ab_id,'$ab_username',$ab_artist,'$ab_uname','$ab_fulln','$ab_type','$ab_size',$ab_price,'$ab_addet','$ab_refpic','$ab_refpicname','UNPAID','$ab_date','$ab_tardate','INCOMPLETE','SENT','')";
    if ($link->query($sql) === TRUE) {
              
    } else {
      echo "Something went wrong: " . $link->error;
    }


    header("Location: commision.html?frm=reqcomm&cid=".$c_id."&bid=".$ab_id."&aid=".$ab_artist);

            //   $sql = "UPDATE info SET fname='$ab_fname', lname='$ab_lname',address='$ab_address',contno='$ab_contno',state='$ab_state',country='$ab_country',exp='$ab_exp',addet='$ab_addet',pic='$ab_pic',coverpic='$ab_coverpic' WHERE user_id=$ab_id";
            //   if ($link->query($sql) === TRUE) {
                
            //   } else {
            //     echo "Error updating record: " . $link->error;
            //   }
            //   $sql = "UPDATE user SET username='$ab_uname',email='$ab_email' WHERE user_id=$ab_id";
            //   if ($link->query($sql) === TRUE) {
                
            //   } else {
            //     echo "Error updating record: " . $link->error;
            //   }

  }

$ui_id=$_SESSION['user_id'];
$rq=$_GET['artist'];

$sql = "SELECT * FROM info where user_id=$rq";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){  
        $ui_pic= $row['pic']  ;
        $ui_coverpic= $row['coverpic']  ;
        $ui_fname= $row['fname']  ;
        $ui_lname= $row['lname']  ;
          }
      mysqli_free_result($result);
  } 
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT username, user_id FROM user where user_id=$rq";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){     
        $ui_uname= $row[0]  ;
        $ui_userid= $row[1]  ;
          }
      mysqli_free_result($result);
  } 
} else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}




?>