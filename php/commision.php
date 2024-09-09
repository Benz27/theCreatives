<?php
session_start();
include("conn.php");

$t_id=$_SESSION['user_id'];
$trnum=0;
 


$sql = "SELECT * FROM commision where a_id=$t_id and accrej ='SENT' or accrej ='ACCEPTED' or accrej ='PENDING'";
if($result = mysqli_query($link, $sql)){
  
   echo '<div class="profile-container">';
   echo   ' <div class="table-container rounded bg-white"> ';
   echo        '  <table class="table">';
   echo            '<br>';
   echo                '<h1>Art Commissions</h1>';


  if(mysqli_num_rows($result) > 0){ 


    echo'<thead>';
    echo'<tr>';
    echo  '  <th scope="col">#</th>';
    echo ' <th scope="col">Username</th>';
    echo '<th scope="col">Type of Artwork</th>';
    echo   ' <th scope="col">Art Canvas Size</th>';
    echo   '<th scope="col">Image Reference</th>';
    echo   '<th scope="col">Base Price</th>';
    echo   '<th scope="col">Status</th>';
    echo   ' </tr>';
    echo'</thead>';
    echo'<tbody>';


while($row = mysqli_fetch_array($result)){  
 
        $trnum+=1;
        echo     '             <tr>';
        echo'<th scope="row"><a style="color:black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">' . $trnum . '</a></th>';
        echo '<td><a style="color:black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">@' . $row['a_username'] . '</a></td>';
      echo '<td><a style="color:black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">' . $row['artype'] . '</a></td>';
      echo '<td><a style="color:black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">' . $row['artcanname'] . '</a></td>';
      echo '<td><a style="color:black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">' . $row['refpicname'] . '</td>';
      echo '<td><a style="color:black;" href="../html/aartistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">PHP ' . $row['price'] . '</a></td>';
      echo '<td><a style="color:black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proflistcomm">' . $row['accrej'] . '</a></td>';
      echo         '         </tr>';
    
    }

    
    mysqli_free_result($result);
    echo'</tbody>';
    echo   '</table>';
       echo    '</div>';
    echo   '</div>';

    }else{

      echo '<medium id="md"> (your commisions will apear here.) </medium>';
    } 

    


    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    
   
?>