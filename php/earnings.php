<?php
session_start();
include("conn.php");



$t_id=$_SESSION['user_id'];
$trnum=0;


$username="";

echo '<div class="profile-container">';
echo   ' <div class="table-container rounded bg-white"> ';
$sql = "SELECT * FROM earnings where a_id=$t_id order by datepay";
if($result = mysqli_query($link, $sql)){
  if(mysqli_num_rows($result) > 0){ 


  echo        '  <table class="table">';
  echo            '<br>';
  echo                '<span class="text-black-70">Total Earnings</span>';

  $sql2 = "SELECT SUM(price) FROM earnings where a_id=$t_id";
if($result2 = mysqli_query($link, $sql2)){

  if(mysqli_num_rows($result2) > 0){ 
while($row2 = mysqli_fetch_array($result2)){ 
echo '<h1>PHP '.$row2[0].'</h1>';

   
}


mysqli_free_result($result2);
} 
} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

  echo'<thead>';
  echo'<tr>';
  echo  '  <th scope="col">#</th>';
  echo ' <th scope="col">Username</th>';
  echo '<th scope="col">Transaction Type</th>';
  echo   ' <th scope="col">Date</th>';
  echo   '<th scope="col">Amount</th>';
  echo   ' </tr>';
  echo'</thead>';
  echo'<tbody>';


while($row = mysqli_fetch_array($result)){  
 
        $trnum+=1;

        $sqlf="SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$row[buyyer_id] and user.user_id=$row[buyyer_id]"; 
    $resultf=mysqli_query($link, $sqlf);  
    if($resultf && mysqli_num_rows($resultf) > 0){ 
  
      $user_data=mysqli_fetch_assoc($resultf);
  
      $username=$user_data['username'];
  
  
    }

        echo     '             <tr>';
        echo'<th scope="row">' . $trnum . '</th>';
    echo "<td>@" . $username . "</td>";
    echo "<td>" . $row['ttype'] . "</td>";
    echo "<td>" . $row['datepay'] . "</td>";
    echo "<td>PHP " . $row['price'] . "</td>";
    echo         '</tr>';
    
    }
 
    
    mysqli_free_result($result);
    echo'</tbody>';
    echo   '</table>';


           

    } else{




      echo  '  <table class="table">';
      echo '    <h1>Earnings</h1>';
      echo '<medium id="md"> (your total earnings will apear here.) </medium>';


    }
    } else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }
    echo   '</div>';
    echo    '</div>';
?>