<?php
session_start();
include("conn.php");

$u_id=$_SESSION['user_id'];
$artist="";
$c=$_GET['c'];
$picc;
if($c==0){
  $sql = "SELECT * FROM info where user_id <> $u_id";
}else{
  $qu=$_GET['qu'];

  $sql = "SELECT * from info where user_id in (select user_id from user where username like '%$qu%' and user_id <> $u_id)";
  // "SELECT user.username,info.* FROM info,user where user.username LIKE '%$qu%' and info.user_id not LIKE '%$u_id%' and user.user_id not LIKE '%$u_id%' and user.usertype = 'artist'";

}




if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 
    while($row = mysqli_fetch_array($result)){  
 
        $sql1 = "SELECT * FROM user where user_id = $row[user_id] and usertype='artist'";
        if($result1 = mysqli_query($link, $sql1)){
        
          if(mysqli_num_rows($result1) > 0){ 
    echo'<div class="col-xl-3 col-lg-4 col-md-6 mb-4">';
    echo'<div class="bg-white rounded shadow-sm">';
   echo' <a href="artistabout.html?artist='. $row['user_id'] .'">';
if($row['pic']==""){
  $picc="../images/empty.png";
  // echo '<img src="../images/empty.png" onclick="s()" name="art-pic" alt="" class="img-fluid card-img-top">';
}else{
  $picc=$row['pic'];
  
}
echo '<img style="max-width:384px;max-height: 384px;"src="'. $picc .'" onclick="s()" name="art-pic" alt="" class="img-fluid card-img-top">';
echo '</a>';


$sqlf="SELECT username FROM user where user_id=$row[user_id]"; 
      $resultf=mysqli_query($link, $sqlf);  
      if($resultf && mysqli_num_rows($resultf) > 0){ 

        $user_data=mysqli_fetch_assoc($resultf);

        $artist=$user_data['username'];



      }

    echo '<div class="p-4">';
    
    echo '<h5 onclick="s()" name="art-n">'. $artist .'</h5>';

    $sql2 = "SELECT count(art_id) FROM artwork where user_id = $row[user_id]";
    if($result2 = mysqli_query($link, $sql2)){
        if(mysqli_num_rows($result2) > 0){ 
            while($row2 = mysqli_fetch_array($result2)){  
             echo' <a style="color: black;" href="artisteport.html?artist='. $row['user_id'] .'">';
              if($row2[0]>1){
                echo '<p onclick="s()" name="artist-n">'. $row2[0] .' Artworks</p>';
              }else{
                echo '<p onclick="s()" name="artist-n">'. $row2[0] .' Artwork</p>';
              }
   
              echo'</a>';
            }
    mysqli_free_result($result2);
           
    } 
    } else{
    echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
    }


    echo '</div>';
    echo '<div class="buttons d-flex justify-content-center"><button class="btn btn-outline-primary mr-1"><a href="artistabout.html?artist='. $row['user_id'] .'">Profile</a></button> <button class="btn btn-outline-warning"><a href="reqcomm.html?artist='. $row['user_id'] .'">Request Commision</a></button> </div>';
    echo '</div>';
    echo '</div>';

} 

} else{
echo "ERROR: Could not able to execute $sql1. " . mysqli_error($link);
}

    }
    mysqli_free_result($result);

    
    } 

    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }



?>