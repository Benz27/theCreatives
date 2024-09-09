<?php
session_start();

include("conn.php");

$usid=$_SESSION['user_id'];
$load=$_GET['load'];

if($load==0){
$sql = "SELECT * from pricelist where user_id=$usid order by a_order";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
          while($row = mysqli_fetch_array($result)){ 

            echo '<tr>';
            echo '<th scope="row">'. $row['a_order'] .'</th>';
            echo '<td>'. $row['s_name'] .'</td>';
            echo '<td>PHP <input value="'. $row['logo'] .'" id="'. $row['a_order'] .'n" type="text" onchange="textchange('. $row['a_order']-1 .', this.value)"></td>';
            echo '<td>PHP <input value="'. $row['digital'] .'" id="'. $row['a_order']+18 .'n" type="text" onchange="textchange('. $row['a_order']+17 .', this.value)"></td>';
            echo '</tr>';

        }
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
  } else{
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }

}elseif($load==1){
    $sep=0;
  $sql = "SELECT logo from pricelist where user_id=$usid order by a_order";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_array($result)){ 


            echo $row['logo']. ',';


          $sep+=1;
          }
      mysqli_free_result($result);
       } else{
      echo "No records matching your query were found.";
      }
  } else{
  echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }


  $sql = "SELECT digital from pricelist where user_id=$usid order by a_order";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_array($result)){ 

          if($sep < 35){
            echo $row['digital']. ',';

          }else{
            echo $row['digital'];
          }
          $sep+=1;
          }
      mysqli_free_result($result);
       } else{
      echo "No records matching your query were found.";
      }
  } else{
  echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }


}elseif($load==2){

    for($x=1; $x <= 36;$x++){

        $tpe=$_POST[$x.'n'];

        $sql = "UPDATE pricelist SET logo='$tpe' WHERE a_order=$x and user_id=$_SESSION[user_id]";
        if ($link->query($sql) === TRUE) {
     
        } else {
          echo "Error updating record: " . $link->error;
        }
    }
    
$sep=0;
  $sql = "SELECT logo from pricelist where user_id=$usid order by a_order";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_array($result)){ 


            echo $row['logo']. ',';


          $sep+=1;
          }
      mysqli_free_result($result);
       } else{
      echo "No records matching your query were found.";
      }
  } else{
  echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }


  $sql = "SELECT digital from pricelist where user_id=$usid order by a_order";
  if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){ 
        while($row = mysqli_fetch_array($result)){ 

          if($sep < 35){
            echo $row['digital']. ',';

          }else{

            echo $row['digital'];
          }
          $sep+=1;
          }
      mysqli_free_result($result);
       } else{
      echo "No records matching your query were found.";
      }
  } else{
  echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }

                    


}



?>