<?php
session_start();

include("conn.php");

$usid=$_SESSION['user_id'];
$load=$_GET['load'];
$frm=$_GET['frm'];
$cid=$_GET['cid'];

$bid=$_GET['bid'];
$aid=$_GET['aid'];


if($load==0){



    $sql = "SELECT * from commision where c_id=$cid";
        if($result = mysqli_query($link, $sql)){
          if(mysqli_num_rows($result) > 0){ 
              while($row = mysqli_fetch_array($result)){ 
                echo '<h5>Art Details</h5>';
                echo '<div class="col-sm-6">';
                echo '<label for="firstName" class="form-label">Art Type</label>';
                echo '<input type="text" class="form-control" id="type" name="type" placeholder="" value="'. $row['artype'] .'" readonly>';
                echo '<input type="text" id="ids" name="artids" value="" hidden>';
                echo '</div>';
    
                echo '<div class="col-sm-6">';
                echo '<label for="lastName" class="form-label">Art Size</label>';
                echo '<input type="text" class="form-control" id="size" name="size" placeholder="" value="'. $row['artcanname'] .'" readonly>';
                echo '</div>';
    
                echo '<div class="col-sm-6">';
                echo '<label for="add" class="form-label">Date</label>';
                echo '<input type="add" class="form-control" id="date" name="date" placeholder="" value="'. $row['tardttime'] .'" readonly>';
                echo '</div>';
                
                echo '<div class="col-sm-6">';
                echo '<label for="add" class="form-label">Target Date</label>';
                echo '<input type="add" class="form-control" id="tardate" name="tardate" placeholder="" value="'. $row['dttime'] .'" readonly>';
                echo '</div>';  
    
                echo '<div class="col-sm-6">';
                echo '<label for="email" class="form-label">Base Price</label>';
                echo '<input type="email" class="form-control" id="email" name="email" placeholder="" value="PHP '. $row['price'] .'.00" readonly>';
                echo '</div>';

      
                echo '<div class="col-12">';
                echo '<label for="email" class="form-label">Details:</label>';
                echo '<textarea id="addet" style="height:200px;width:100%;" placeholder="Type out specifics here." name="addet" value="" readonly>'. $row['details'] .'</textarea>';
        
              
                if($row['refpic']!= ""){
        
                
                echo '<div class="col-12">';
                echo '<label class="form-label">Image Reference:</label>';
                echo '<div class="buttons d-flex justify-content-center">';
            
                echo '<img src="'. $row['refpic'] .'" alt="reference" class="img-fluid col-sm-4" id="my_image">';
                echo '</div>';
                echo '</div>';
                echo '<hr>';
        
               
        
                }
    
                
    
    
          //       $sql2 = "SELECT fname, lname from info where user_id=$row[buyer_id]";
          //       if($result2 = mysqli_query($link, $sql2)){
          //         if(mysqli_num_rows($result2) > 0){ 
          //             while($row2 = mysqli_fetch_array($result2)){
    
          //       echo '<div class="col-sm-6">';
          //       echo '<label for="username" class="form-label">Account Name</label>';
          //       echo '<div class="input-group has-validation">';
          //       echo '<input type="text" class="form-control" id="name" name="name" value="'. $row2[0] .' '.  $row2[1] . '" readonly>';
          //       echo '</div>';
          //        echo '</div>';
       
               
    
          //       }
          //       mysqli_free_result($result2);
          //   } else{
          //       echo "No records matching your query were found.";
          //   }
          // } else{
          //   echo "ERROR: Could not ple to execute $sql2. " . mysqli_error($link);
          // }
         

        

        $sql3="SELECT username FROM user where user_id=$row[buyer_id];"; 
        $result3=mysqli_query($link, $sql3);  
        if($result3 && mysqli_num_rows($result3) > 0){    
        
          
            $usr=mysqli_fetch_assoc($result3);
            echo '<h5>Commisioner</h5>';     
            echo '<div class="col-sm-6">';
        echo '<label for="username" class="form-label">Username</label>';
        echo '<div class="input-group has-validation">';
        echo '<span class="input-group-text">@</span>';
        echo '<input type="text" class="form-control" id="uname" name="uname" value="'.   $usr['username'] .'" readonly>';
        echo '</div>';
        echo '</div>';

    }

        $sql3="SELECT email FROM user where user_id=$row[buyer_id];"; 
        $result3=mysqli_query($link, $sql3);  
        if($result3 && mysqli_num_rows($result3) > 0){ 
            
          $usr=mysqli_fetch_assoc($result3); 
        echo '<div class="col-sm-6">';
        echo '<label for="email" class="form-label">Email</label>';
        echo '<input type="email" class="form-control" id="email" name="email" placeholder="" value="'. $usr['email'] .'" readonly>';
        echo '</div>';
  
      }
  
            echo '<hr>';
       
        $sql3="SELECT username FROM user where user_id=$aid;"; 
        $result3=mysqli_query($link, $sql3);  
        if($result3 && mysqli_num_rows($result3) > 0){    
        
          
            $usr=mysqli_fetch_assoc($result3);  
            echo '<h5>Artist Commisioned</h5>';   
            echo '<div class="col-sm-6">';
        echo '<label for="username" class="form-label">Username</label>';
        echo '<div class="input-group has-validation">';
        echo '<span class="input-group-text">@</span>';
        echo '<input type="text" class="form-control" id="uname" name="uname" value="'.   $usr['username'] .'" readonly>';
        echo '</div>';
        echo '</div>';
        
            }



          //   $sql2 = "SELECT fname, lname from info where user_id=$aid";
          //       if($result2 = mysqli_query($link, $sql2)){
          //         if(mysqli_num_rows($result2) > 0){ 
          //             while($row2 = mysqli_fetch_array($result2)){
    
          //       echo '<div class="col-sm-6">';
          //       echo '<label for="username" class="form-label">Account Name</label>';
          //       echo '<div class="input-group has-validation">';
          //       echo '<input type="text" class="form-control" id="name" name="name" value="'. $row2[0] .' '.  $row2[1] . '" readonly>';
          //       echo '</div>';
          //        echo '</div>';
       
               
    
          //       }
          //       mysqli_free_result($result2);
          //   } else{
          //       echo "No records matching your query were found.";
          //   }
          // } else{
          //   echo "ERROR: Could not ple to execute $sql2. " . mysqli_error($link);
          // }

          $sql3="SELECT email FROM user where user_id=$aid;"; 
          $result3=mysqli_query($link, $sql3);  
          if($result3 && mysqli_num_rows($result3) > 0){ 
              
            $usr=mysqli_fetch_assoc($result3); 
          echo '<div class="col-sm-6">';
          echo '<label for="email" class="form-label">Email</label>';
          echo '<input type="email" class="form-control" id="email" name="email" placeholder="" value="'. $usr['email'] .'" readonly>';
          echo '</div>';
    
        }

        echo '<br>';
    
    


















        
      
 
        
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