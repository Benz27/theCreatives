<?php
session_start();
include("conn.php");

$u_id=$_SESSION['user_id'];
$sql = "SELECT * FROM artwork where user_id =$u_id order by dte DESC";
if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 
    while($row = mysqli_fetch_array($result)){  
 
        echo'<div class="col-md-4 d-flex justify-content-center">';
        echo'<div class="card p-2">';
        echo'<a href="art.html?art='. $row['art_id'] .'"><div class="text-center"> <img src="'. $row['artwork'] .'" class="img-fluid" onContextMenu="return false;"/> </div></a>';
        echo'<div class="content">';
        
        echo'<div class="d-flex justify-content-between align-items-center"> <span class="category">'. $row['artname'] .'</span></div>';
        echo'<p>'. $row['type'] .'</p>';
        // echo '<div class="buttons d-flex justify-content-center"><button class="btn btn-outline-primary mr-1"><a href="profshowc.html?sub=1&artid='. $row['art_id'] .'">Edit</a></button></div> ';

        echo'</div>';
        
        echo'</div>';
        
        echo'</div>';

   


    }

    mysqli_free_result($result);
    } 
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

//  <div class="col-md-4 d-flex justify-content-center">
//                     <div class="card p-2">
//                         <div class="text-center"> <img src="https://bootstrapious.com/i/snippets/sn-gallery/img-4.jpg" class="img-fluid" /> </div>
//                         <div class="content">
//                             <div class="d-flex justify-content-between align-items-center"> <span class="category">Digital Art</span> <span class="price">PHP 300.00</span> </div>
//                             <p>DOSE Juice</p>
//                         </div>
//                     </div>
//                 </div>

// '. $row['art_id'] .'
?>