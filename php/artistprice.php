<?php
session_start();

include("conn.php");

$usids=$_SESSION['user_id'];
$usid=$_GET['artist'];

$sql = "SELECT * from pricelist where user_id=$usid order by a_order";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
          while($row = mysqli_fetch_array($result)){ 

            echo '<tr>';
            echo '<th scope="row">'. $row['a_order'] .'</th>';
            echo '<td>'. $row['s_name'] .'</td>';
            echo '<td>PHP '. $row['logo'] .'</td>';
            echo '<td>PHP '. $row['digital'] .'</td>';
            echo '</tr>';


        }
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
  } else{
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }
  
?>