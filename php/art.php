<?php
$sh_id = $_SESSION['user_id'];
$wt = 0;
$sql = "SELECT * FROM info where user_id=$sh_id";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $ui_pic = $row['pic'];
      $ui_coverpic = $row['coverpic'];
    }
    mysqli_free_result($result);
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT username,usertype FROM user where user_id=$sh_id";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $ui_uname = $row[0];
      $ui_utype = $row[1];
    }
    mysqli_free_result($result);
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}




$art_id = $_GET['art'];
$sql = "SELECT * FROM artwork where art_id=$art_id";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    $art = $data['artwork'];
    $artname = $data['artname'];
    $descr = $data['descr'];
    $atype = $data['type'];
    $asize = $data['tname'];
    $aprice = $data['price'];

    $sql2 = "SELECT username FROM user where user_id=$data[user_id];";
    if ($result2 = mysqli_query($link, $sql2)) {
      if (mysqli_num_rows($result2) > 0) {
        $data2 = mysqli_fetch_assoc($result2);
        $uname = $data2['username'];
      }
    } else {
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }



    if ($data['user_id'] == $sh_id) {
      $wt = 0;
    } else {





      $sql3 = "SELECT buyer_id, art_id FROM transaction where buyer_id=$sh_id and art_id=$art_id;";
      if ($result3 = mysqli_query($link, $sql3)) {
        if (mysqli_num_rows($result3) > 0) {
          $wt = 1;
        } else {



          $sql4 = "SELECT * FROM cart where art_id = $data[art_id] and user_id=$sh_id;";
          if ($result4 = mysqli_query($link, $sql4)) {
            if (mysqli_num_rows($result4) > 0) {
              $wt = 2;
            } else {
              $wt = 3;
            }
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
          }
        }
      } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
      }
    }








    mysqli_free_result($result);
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
