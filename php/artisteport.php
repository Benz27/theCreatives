<?php
session_start();
include("conn.php");

$u_id=$_SESSION['user_id'];
$vu_id=$_GET['artist'];
$sql = "SELECT * FROM artwork where user_id =$vu_id order by dte DESC";
if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 
    while($row = mysqli_fetch_array($result)){  
 
        echo'<div class="col-md-4 d-flex justify-content-center">';
        echo'<div class="card p-2">';
        echo'<a href="art.html?art='. $row['art_id'] .'"><div class="text-center"> <img src="'. $row['artwork'] .'" class="img-fluid" /> </div></a>';
        echo'<div class="content">';
        echo'<div class="d-flex justify-content-between align-items-center"> <span class="category">'. $row['artname'] .'</span> </div>';
        echo'<p>'. $row['type'] .'</p>';
        echo'</div>';
        echo'</div>';
        echo'</div>';

    }

    mysqli_free_result($result);
    } 
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
 
?>