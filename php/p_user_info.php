<?php
$pche_id=$_SESSION['user_id'];

if($_SERVER['REQUEST_METHOD']=='POST'){
  

date_default_timezone_set("Asia/Manila");


$art_id=explode(" ",$_POST['artids']);
$cnt=count($art_id);
$tr_price=0;
$tr_tid=mt_rand(1000000, 9999999);    
       
        
  
$sql="SELECT t_id FROM trlist where t_id=$tr_tid";    
$result=mysqli_query($link, $sql);      
if($result && mysqli_num_rows($result) > 0){       
    $user_data=mysqli_fetch_assoc($result);        
    while($pc_tid ==  $user_data['user_id']){    
        $tr_tid=mt_rand(1000000,9999999);      

    }

}



for($x=0; $x < $cnt;$x++){
    $pc_artid = $art_id[$x];

    
  $pc_id=$_SESSION['user_id']; //buyer id
  $pc_dte=date("Y-m-d H:i:s.nnn");
  $pc_dtedisp=date("Y-m-d h:ia");
  $pc_uname= $_POST['uname'];
  $pc_fname= $_POST['fname'];
  $pc_lname= $_POST['lname'];
  $pc_email = $_POST['email'];
  $pc_address= $_POST['address'];

//   $pc_contno= $_POST['contno'];

  $pc_tid=mt_rand(1000000, 9999999);    
       
        
  
  $sql="SELECT t_id FROM transaction where t_id=$pc_tid";    
  $result=mysqli_query($link, $sql);      
  if($result && mysqli_num_rows($result) > 0){       
      $user_data=mysqli_fetch_assoc($result);        
      while($pc_tid ==  $user_data['user_id']){    
          $pc_tid=mt_rand(1000000,9999999);      

      }

  }

  $sql="SELECT user_id, artname, artist, uname, price FROM artwork where art_id=$pc_artid";    
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_array($result)){  
          $pc_artistid= $row['user_id'] ;
          $pc_artname= $row['artname'];
          $pc_auname= $row['uname'];
          $pc_artist= $row['artist'];
          $pc_price= $row['price'];
          $tr_price+=$row['price'];

            }
        mysqli_free_result($result);
    }
  } else{
    echo "ERROR: Could not pcle to execute $sql. " . mysqli_error($link);
  }

            $sql="INSERT INTO transaction values ($pc_tid,$tr_tid,$pc_id,'$pc_uname','$pc_fname','$pc_lname','$pc_address','$pc_email',$pc_artid,$pc_artistid,'$pc_auname','$pc_artname','$pc_artist','$pc_price','PAID','$pc_dte','$pc_dtedisp','$_POST[refnum]')"; 
            if ($link->query($sql) === TRUE) {
              
            } else {
              echo "Error: " . $link->error;
            }

            $sql="DELETE FROM cart where art_id=$pc_artid and user_id=$pche_id";
            if ($link->query($sql) === TRUE) {
                      
            } else {
              echo "Something went wrong: " . $link->error;
            }

            $e_tid=mt_rand(1000000, 9999999);    
       
        
  
  $sqle="SELECT tc_id FROM earnings where tc_id=$e_tid";    
  $resulte=mysqli_query($link, $sqle);      
  if($resulte && mysqli_num_rows($resulte) > 0){       
      $use=mysqli_fetch_assoc($resulte);        
      while($e_tid ==  $use['user_id']){    
          $e_tid=mt_rand(1000000,9999999);      

      }

  }

            $sql="INSERT INTO earnings values ($e_tid,$pche_id,'$pc_uname','ART PURCHASE','$pc_artistid','$pc_dtedisp',$pc_price)"; 
            if ($link->query($sql) === TRUE) {
              
            } else {
              echo "Error: " . $link->error;
            }

            
        }

       

        $trdte=date('Y-m-d H:i:s.nnn');
        $trdtedisp=date('Y-m-d h:ia');
        $asd=str_replace(" ","+",$_POST['artids']);

 $sql="INSERT INTO trlist values ($tr_tid,'$_POST[artids]','$asd',$cnt,$_SESSION[user_id],'$_POST[uname]','$_POST[fname]','$_POST[lname]','$_POST[address]','$_POST[email]','$trdte','$trdtedisp','$tr_price','PAID')"; 
 if ($link->query($sql) === TRUE) {
   
 } else {
   echo "Error: " . $link->error;
 }

 $trid=mt_rand(1000000, 9999999);    
  
 $sql="SELECT tr_id FROM transac where tr_id=$trid";     
 $result=mysqli_query($link, $sql);    
 if($result && mysqli_num_rows($result) > 0){        
     $user_data=mysqli_fetch_assoc($result);       
     while($trid ==  $user_data['trid']){     
         $trid=mt_rand(1000000,9999999);       
     }

 }





$sql = "INSERT INTO transac values ($trid,$tr_tid,$pc_artistid,$pche_id,'ART PURCHASE','$_POST[rnum]','$_POST[rimgs]','$_POST[rimgn]','FULL','$_POST[dte]','$_POST[dteti]')";
if ($link->query($sql) === TRUE) {
  header("Location: purchsum.html?art_id=".$asd."&frm=purch&trlst=".$tr_tid);
} else {
echo "Error updating record: " . $link->error;
}


//  $sql="INSERT INTO reference values ($tr_tid,$pc_artistid,$_SESSION[user_id],'PURCHASE','$_POST[refnum]','',1)"; 
//  if ($link->query($sql) === TRUE) {
   
//  } else {
//    echo "Error: " . $link->error;
//  }








 

}

$sql = "SELECT * FROM info where user_id=$pche_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){  
        $pche_fname= $row['fname']  ;
        $pche_lname= $row['lname']  ;
        $pche_address= $row['address']  ;
        $pche_contno= $row['contno']  ;
          }
      mysqli_free_result($result);
  } else{
      echo "No records matching your query were found.";
  }
} else{
  echo "ERROR: Could not pcle to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT username, email,usertype FROM user where user_id=$pche_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
      while($row = mysqli_fetch_array($result)){     
        $pche_uname= $row[0];
        $pche_email= $row[1];
        $pche_usertype= $row[2];
          }
      mysqli_free_result($result);
  } else{
      echo "No records matching your query were found.";
  }
} else{
  echo "ERROR: Could not pcle to execute $sql. " . mysqli_error($link);
}

?>

