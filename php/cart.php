<?php
session_start();
include("conn.php");

$t_id=$_SESSION['user_id'];
$lt=$_GET['lt'];

if ($lt==0){
  $artist="";
      $username="";
  $trnum=0;
  $btn=0;
  $licnt=0;
  $mat=array();
$sql = "SELECT COUNT(o_id) FROM cart where user_id=$t_id";
if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 
    echo '<div class="cart_title">Shopping Cart</div>';
while($row = mysqli_fetch_array($result)){ 
  $btn=$row[0];
if($row[0]>1){

  echo '<medium id="md"> ('. $row[0] .' items in your cart) </medium>';
  // echo '<input type="checkbox" name="ckall" class="form-check-input" value="" id="selall">Select All</input>';
}elseif($row[0]<1){


  echo '<medium id="md"> (your items will apear here.) </medium>';
}
else{
  echo '<medium id="md"> ('. $row[0] .' item in your cart) </medium>';
  // echo '<input type="checkboxall" class="form-check-input" value="" id="selall" onclick="">Select All</input>';
}

}


mysqli_free_result($result);
} 
} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}




$sql = "SELECT * FROM cart where user_id=$t_id";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 
    echo'<div class="cart_items">';
    echo'<ul class="cart_list">';
while($row = mysqli_fetch_array($result)){  
 
    

    $sql4 = "SELECT * FROM artwork where art_id=$row[art_id]";
    if($result4 = mysqli_query($link, $sql4)){
      if(mysqli_num_rows($result4) > 0){ 
    while($row4 = mysqli_fetch_array($result4)){  

      $sqlf="SELECT username FROM user where user_id=$row4[user_id]"; 
    $resultf=mysqli_query($link, $sqlf);  
    if($resultf && mysqli_num_rows($resultf) > 0){ 
  
      $user_data=mysqli_fetch_assoc($resultf);

      $username=$user_data['username'];


  
  
    }

      echo '<li class="cart_item clearfix" id="'. $row4['art_id'] .'li">';
      echo '<div class="cart_item_image">';
      echo '<input type="checkbox" class="form-check-input" name="ck" value="" id="'. $row4['art_id'] .'"onclick="chck(this.id)">';
      echo '<label class="form-check-label" for="save-info"></label>';
      echo '<img src="'. $row4['artwork'] .'" alt="'. $row4['artname'] .'" width="140" height="120">';
      echo '</div>';
      echo '<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">';

      echo '<div class="cart_item_name cart_info_col">';
      echo '<div class="cart_item_title">Name</div>';
      echo '<div class="cart_item_text">'. $row4['artname'] .'</div>';
      echo '</div>';

      echo '<div class="cart_info_col">';
      echo '<div class="cart_item_title">Type</div>';
      echo '<div class="cart_item_text">'. $row4['type'] .'</div>';
      echo '</div>';

      echo '<div class="cart_info_col">';
      echo '<div class="cart_item_title">Author</div>';
      echo '<div class="cart_item_text">'. $username .'</div>';
      echo '</div>';

      echo '<div class="cart_item_price cart_info_col">';
      echo '<div class="cart_item_title">Price</div>';
      echo '<div class="cart_item_text">PHP '. $row4['price'] .'</div>';
      echo '<input type="text" value="'. $row4['price'] .'" id="'. $row4['art_id'] .'inp" hidden/>';
      echo '</div>';


      echo '</div>';
      echo '</li>';
      $licnt+=1;
      $trnum+=$row4['price'];

      array_push($mat, $row['art_id']);
    } 
  mysqli_free_result($result4);


  } 

  } else{
  echo "ERROR: Could not able to execute $sql4. " . mysqli_error($link);
  }

    }

    mysqli_free_result($result);

    echo'</ul>';
    echo'</div>';

    echo'<div class="order_total">';
    echo'<div class="order_total_content text-md-right">';
    echo'<div class="order_total_title" id="ort">Order Total:</div>';
    echo'<div class="order_total_amount" id="dprice">PHP '. $trnum .'</div>';
    echo '<input type="text" value="'. $trnum .'" id="tprice" hidden/>';
    echo '<input type="text" value="'. $licnt .'" id="licnt" hidden/>';
    echo'</div>';
    echo'</div>';


    } 
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
  }else{

    $aid=explode(" ",$_GET['ids']);
    $cnt=count($aid);
    for($x=0; $x < $cnt;$x++){
    
      $artid = $aid[$x];

      $sql="DELETE FROM cart where art_id=$artid and user_id=$t_id";
      if ($link->query($sql) === TRUE) {
        echo "1";
      } else {
        echo "Something went wrong: " . $link->error;
      }

    }

  }

  