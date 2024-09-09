<?php

session_start();

include("conn.php");
$total=0;

$pru_id=$_SESSION['user_id'];
$art_id=explode(" ",$_GET['art_id']);
// $frm=$_GET['frsm'];
$cnt=count($art_id);
$trd=$_GET['trlst'];
$artist="";
    $username="";
    $refnum;
    $gnum=0;
echo'<div class="cart_items">';




echo'<ul class="cart_list" id="cartlist">';

$sql = "SELECT dtedisp,refnum FROM transaction where art_id=$art_id[0] and buyer_id=$pru_id";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
        $data=mysqli_fetch_assoc($result); 

        $refnum=$data['refnum'];
  echo "<h5>Date: ". $data['dtedisp'] ."</h5>";


          mysqli_free_result($result);
      } else{
          echo "No records matching your query were found.";
      }
    } else{
      echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
    }



    for($x=0; $x < $cnt;$x++){
    
        $pr_artid = $art_id[$x];

    $sql = "SELECT * FROM artwork where art_id=$pr_artid";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
          while($row = mysqli_fetch_array($result)){    
            $sqlf="SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$row[user_id] and user.user_id=$row[user_id]"; 
            $resultf=mysqli_query($link, $sqlf);  
            if($resultf && mysqli_num_rows($resultf) > 0){ 
          
              $user_data=mysqli_fetch_assoc($resultf);
              // $artist=$user_data['fname']. ' ' .$user_data['lname'];
              $username=$user_data['username'];
          
          
            }

            echo'<li class="cart_item clearfix">';
            echo'<div class="cart_item_image">';
            echo'<img src="'. $row['artwork'] .'" alt="" width="140" height="120">';
            echo'</div>';
            echo'<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">';
            echo'<div class="cart_item_name cart_info_col">';
            echo'<div class="cart_item_title">Name</div>';
            echo'<div class="cart_item_text">'. $row['artname'] .'</div>';
            echo'</div>';

            echo '<div class="cart_info_col">';
            echo '<div class="cart_item_title">Type</div>';
            echo '<div class="cart_item_text">'. $row['type'] .'</div>';
            echo '</div>';
      
            echo '<div class="cart_info_col">';
            echo '<div class="cart_item_title">Artist</div>';
            echo '<div class="cart_item_text">'. $username .'</div>';
            echo '</div>';

            echo'<div class="cart_item_total cart_info_col">';
            echo'<div class="cart_item_title">Price</div>';
            echo'<div class="cart_item_text">PHP '. $row['price'] .'</div>';
            echo'</div>';


            echo'</div>';
            
            echo'</li>';
            $total+= $row['price'];
    
              }
          mysqli_free_result($result);
      } else{
          echo "No records matching your query were found.";
      }
    } else{
      echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
    }
    
    }

    echo'</ul>';
    echo'<h5>Total: PHP '. $total.'</h5>';

    echo'</div>';

    $sql = "SELECT * FROM info where user_id=$pru_id";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
          while($row = mysqli_fetch_array($result)){   
    // echo'<hr class="my-3">';
    // echo'<h4>Payment Method</h4>';
    // echo'<div class="my-3">';
    // echo'<div class="form-check">';
    // echo'<label class="form-check-label" for="gcash" style-"weight:bold;">GCash</label>';
    // echo'<br>';
    // echo'<div class="col-12">';
    // echo'<label for="gc-number" class="form-label">Reference Number</label>';
    // echo'<input type="text" class="form-control" id="refnum" name="refnum" placeholder="" value="'.$refnum.'" readonly>';

    // echo'</div>';

    // echo'</div>';
    // echo'</div>';
    // echo'<hr class="my-4">';
    // echo'<div class="form-check">';
    // echo'<input type="checkbox" class="form-check-input" id="save-info">';
    // echo'<label class="form-check-label" for="save-info">Save this information for next time.</label>';
    // echo'</div>';
    echo'</div>';
    echo'<hr class="my-4">';
    echo'<div class="col-md-3 my-3">';
    echo'<label style="font-weight: bold; margin-bottom: 5px; font-size: 22px;">Artist Payment Details</label>';
    echo'</div>';  
    
    
    }
    mysqli_free_result($result);
    } else{
    echo "No records matching your query were found.";
    }
    } else{
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
    }

    $mat=array();
    for($x=0; $x < $cnt;$x++){
    
        $pr_artid = $art_id[$x];
 
    $sql = "SELECT * FROM artwork where art_id=$pr_artid";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
          while($row = mysqli_fetch_array($result)){ 
            // $sqlf="SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$row[user_id] and user.user_id=$row[user_id]"; 
            $sqlf="SELECT * FROM account where user_id=$row[user_id]"; 
            $resultf=mysqli_query($link, $sqlf);  
            if($resultf && mysqli_num_rows($resultf) > 0){ 
          
              $user_data=mysqli_fetch_assoc($resultf);
              // $artist=$user_data['fname']. ' ' .$user_data['lname'];
              $username=$user_data['name'];
              $gnum=$user_data['number'];
          
            }

            $matc=count($mat);
 
            if($matc>0){
               
                for($y=0; $y < $matc;$y++){
                    
                    if($mat[$y]==$row['user_id']){
                       
                        break 2;
                
                    }
            
            
                }
                
            }
          
            echo'<div class="col-md-3 my-3">';
            echo'<label for="gc-name-artist" class="form-label">GCash Name</label>';
            echo'<input type="text" class="form-control" id="gc-name-artist" placeholder="Jane A. Doe" value="'. $username .'" required readonly>';
            echo'</div>';

            
            echo'<div class="col-md-3 my-3">';
            echo'<label for="gc-number-artist" class="form-label">GCash Number</label>';
            echo'<input type="text" class="form-control" id="gc-number-artist" placeholder="" value="'. $gnum .'" required readonly>';
   
            echo'</div>';
            // echo'<div class="col-md-3 my-3">';
            // echo'<label for="gc-name-artist" class="form-label"></label>';
            // echo'<input type="text" class="form-control" id="gc-name-artist" placeholder="Jane A. Doe" value="'. $username .'" required readonly>';
            // echo'<div class="invalid-feedback">';
            // echo'GCash name is required';
            // echo'</div>';
            // echo'</div>';
            // echo'<div class="col-md-3 my-3">';
            // echo'<label for="gc-number-artist" class="form-label">GCash Number</label>';
            // echo'<input type="text" class="form-control" id="gc-number-artist" placeholder="09xxxxxxxxx" value="" required readonly>';
            // echo'<div class="invalid-feedback">';
            // echo'GCash name is required';
            // echo'</div>';
            // echo'</div>';
         
            array_push($mat, $row['user_id']); 
            

            }
          mysqli_free_result($result);
      } else{
          echo "No records matching your query were found.";
      }
    } else{
      echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
    }
    
    }

echo '<hr class="my-4">';

$sqlf="SELECT * FROM transac where tcc_id=$trd"; 
            $resultf=mysqli_query($link, $sqlf);  
            if($resultf && mysqli_num_rows($resultf) > 0){ 
          
              $user_data=mysqli_fetch_assoc($resultf);

                echo '<table class="table">';
                echo '<h5>Payment Method: GCash</h5>';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">Reference Number</th>';
                echo '<th scope="col">Proof of Transaction</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody id="tbody">';
                echo '<tr>';
                echo '<td id="1rnum" style="cursor: pointer;">'.  $user_data['refnum'] .'</td>';
                echo '<td><button id="1" style="border: none;" value="'.  $user_data['rimg'] .'" onclick="mod(this.value,this.id)">'.  $user_data['rimgn'] .'</button></td>';
                echo '</tr>';
                echo '</tbody>';
                echo '</table>';
                echo '<hr class="my-4">';
                
            }

        //     <table class="table">
        //     <h5>Payment</h5>
        //     <thead>
        //       <tr>
        //         <th scope="col">#</th>
        //         <th scope="col">Reference Number</th>
        //         <th scope="col">Proof of Transaction</th>
        //         <th scope="col">Type</th>
        //       </tr>
        //     </thead>
        //     <tbody id="tbody">


        //       <div id="payrow">




        //     </div>


        //     </tbody>

        // </table>

?>

