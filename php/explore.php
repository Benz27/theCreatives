<?php
session_start();
include("conn.php");

$u_id=$_SESSION['user_id'];
$c=$_GET['c'];
$ident=0;
$artist="";
if($c==0){
  $sql = "SELECT * FROM artwork where user_id <> $u_id";

}else{
  $qu=$_GET['qu'];
  $sql = "SELECT * from artwork where artname like '%$qu%' and user_id <> $u_id";

  // $sql = "SELECT * from artwork where (user_id in (select user_id from user where username like '%$qu%') or artname like '%$qu%')and user_id <> $u_id";
  // $sql = "SELECT user.username,artwork.* FROM artwork,user where (user.username LIKE '%$qu%' or artwork.artname LIKE '%$qu%') and artwork.user_id not LIKE '%$u_id%' and user.user_id not LIKE '%$u_id%'";
}




if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 
    while($row = mysqli_fetch_array($result)){  
 
      $sqlf="SELECT username FROM user where user_id=$row[user_id]"; 
      $resultf=mysqli_query($link, $sqlf);  
      if($resultf && mysqli_num_rows($resultf) > 0){ 

        $user_data=mysqli_fetch_assoc($resultf);

        $artist=$user_data['username'];



      }



      
    echo'<div class="col-xl-3 col-lg-4 col-md-6 mb-4">';
    echo'<div class="bg-white rounded shadow-sm">';

    echo '<a href="art.html?art='. $row['art_id'] .'"><img src="'. $row['artwork'] .'" onclick="s()" name="art-pic" alt="" class="img-fluid card-img-top" onContextMenu="return false;"></a>';

    echo '<div class="p-4">';
    echo '<h5 onclick="s()" name="art-n">'. $row['artname'] .'</h5>';
  

    echo '</div>';


    $sql4 = "SELECT * FROM transaction where art_id = $row[art_id] and buyer_id=$u_id";
    if($result4 = mysqli_query($link, $sql4)){
      if(mysqli_num_rows($result4) > 0){ 
        echo '<p onclick="s()" name="price-n" style="float:right;color:saddlebrown;">Already Purchased</p>';

        echo '<p onclick="s()" name="artist-n">by '. $artist .'</p>';

        // echo '<div class="buttons d-flex justify-content-center"><button style="background-color: #ffc107;color:#4a93fe;"  class="btn btn-outline-warning" value="" id="'. $row['art_id'] .'"><a href="">View</a></button> </div>';

        } else{
          echo '<p onclick="s()" name="price-n" style="float:right;color:saddlebrown;">PHP '. $row['price'] .'.00</p>';

          echo '<p onclick="s()" name="artist-n">by '. $artist .'</p>';

          echo '<div class="buttons d-flex justify-content-center"><button class="btn btn-outline-primary mr-1"><a href="purchase.html?art_id='. $row['art_id'] .'&frm=explore">Buy Now</a></button> ';


          $sql2 = "SELECT * FROM cart where art_id = $row[art_id] and user_id=$u_id";
      if($result2 = mysqli_query($link, $sql2)){
      if(mysqli_num_rows($result2) > 0){ 
        echo '<button style="background-color: #ffc107;color:#4a93fe;"  class="btn btn-outline-warning" value="1" id="'. $row['art_id'] .'"  onclick="addto(this.id, this.value)">On cart</button> </div>';

        } else{
        echo '<button style="background-color: none;color:#4a93fe;" class="btn btn-outline-warning" value="0" id="'. $row['art_id'] .'"  onclick="addto(this.id, this.value)">Add to cart</button> </div>';

        }
      } else{
      echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
      echo '<button style="background-color: none;color:#4a93fe;" class="btn btn-outline-warning" value="0" id="'. $row['art_id'] .'"  onclick="addto(this.id, this.value)">Add to cart</button> </div>';

      }

        }
      } else{
      echo "ERROR: Could not able to execute $sql4. " . mysqli_error($link);

      }




    

    echo '</div>';
    echo '</div>';
    }
    mysqli_free_result($result);
    } 
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }


// <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

//                   <div class="bg-white rounded shadow-sm">
// 					<img src="https://bootstrapious.com/i/snippets/sn-gallery/img-1.jpg" onclick="s()" name="art-pic" alt="" class="img-fluid card-img-top">
//                     <div class="p-4">
//                       <h5 onclick="s()" name="art-n">Red paint cup</h5>
//                       <p onclick="s()" name="artist-n">by Daimler Ham Autor</p>
//                     </div>
//                     <div class="buttons d-flex justify-content-center"> <button class="btn btn-outline-primary mr-1"><a href="artist-purchase.html">Buy Now</a></button> <button class="btn btn-outline-warning"><a href="artist-profcart.html">Add to cart</a></button> </div>
//                   </div>
//                 </div>

// '. $row['art_id'] .'
?>