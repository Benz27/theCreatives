<?php
session_start();
include("conn.php");

$ss = $_GET['s'];
// if($_SERVER['REQUEST_METHOD']=='POST'){
$sh_id = $_SESSION['user_id'];
if ($ss == 0) {

  $artwork = $_POST['artwork'];
  $artname = $_POST['artname'];
  $type = $_POST['type'];
  $tname = $_POST['tname'];
  $descr = $_POST['descr'];
  $price = $_POST['price'];
  $txtsf = $_POST['txtsf'];

  $usertype = 'artist';

  $sqlf = "SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$sh_id and user.user_id=$sh_id";
  $resultf = mysqli_query($link, $sqlf);
  if ($resultf && mysqli_num_rows($resultf) > 0) {

    $user_data = mysqli_fetch_assoc($resultf);

    $artist = $user_data['fname'] . ' ' . $user_data['lname'];
    $username = $user_data['username'];
  }


  $art_id = mt_rand(1000000, 9999999);     //generates random 7 digit numbers for $user_id


  //this block of code will make sure that the generated id were unique from the existing ones in the databases, if it matches some existing id it will then generate a new one until none of them matches
  $sql = "SELECT art_id FROM artwork where art_id=$art_id";     //sql statment
  $result = mysqli_query($link, $sql);      //executes the query
  if ($result && mysqli_num_rows($result) > 0) {        //executes if the result is true(an id was found that matches the current genereated id) 
    $user_data = mysqli_fetch_assoc($result);         //fetches the whole data of the found id
    while ($art_id ==  $user_data['art_id']) {      //loops the code if the newly generated id still matches the found id and will stop if it no longer matches 
      $art_id = mt_rand(1000000, 9999999);       //generates random 7 digit numbers for $user_id
    }
  }

  date_default_timezone_set("Asia/Manila");
  $trdte = date('Y-m-d H:i:s.nnn');

  $sql = "INSERT INTO artwork (art_id, user_id, artwork, artname,uname,artist, type,tname,descr,price,filename,dte) values ($art_id, $sh_id, '$artwork', '$artname','$username','$artist', '$type','$tname','$descr',$price,'$txtsf','$trdte')";
  if ($link->query($sql) === TRUE) {
  } else {
    echo "Error updating record: " . $link->error;
  }



  $flag = 0;
  $sql = "SELECT usertype FROM user where user_id=$sh_id";
  $result = mysqli_query($link, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    if ($user_data['usertype'] == "user") {

      $flag = 1;
    } else {
      $flag = 0;
    }
  }







  $sql = "UPDATE user SET usertype='$usertype' WHERE user_id=$sh_id";
  if ($link->query($sql) === TRUE) {
  } else {
    echo "Error updating record: " . $link->error;
  }

  if ($flag == 1) {
    $num = 1;
    $s_name = array(
      "Instagram photo sizes, 1080 x 1080 pixels (square)",
      "Instagram photo sizes, 1080 x 566 pixels (landscape)",
      "Instagram photo sizes, 1080 x 1350 pixels",
      "Twitter post image size, 1024 x 512 pixels",
      "Twitter card image size, 1200 x 628 pixels",
      "Pinterest Standard Pin size, 1000 x 1500 pixels",
      "Artstation image size, 1920 pixel width",
      "Artstation image size, 3840 pixel width",
      "Deviant art recommended 1920 x 1080 pixels",
      "A5 paper, 1748 x 2480 pixels",
      "A4 paper, 2480 x 3508 pixels",
      "A3 paper, 3508 x 4960 pixels",
      "8.5 x 11 inch paper, 2550 x 3300 pixels",
      "11 x 14 inch paper, 3300 x 4200 pixels",
      "12 x 18 inch paper, 3600 x 5400 pixels",
      "18 x 24 inch paper, 5400 x 7200 pixels",
      "5 x 7 inch postcard, 1500 x 2100 pixels",
      "24 x 36 inch poster, 7200 x 10800 pixels"
    );

    $price1 = array(
      50,
      100,
      150,
      150,
      150,
      100,
      100,
      200,
      170,
      150,
      200,
      250,
      200,
      250,
      350,
      500,
      50,
      600
    );

    $price2 = array(
      100,
      150,
      200,
      200,
      200,
      150,
      150,
      250,
      250,
      250,
      300,
      350,
      300,
      350,
      450,
      600,
      55,
      700
    );
    $a_type = array("Logo", "Digital");

    $cnt2 = count($a_type);
    $cnt = count($s_name);


    // for($y=0; $y < $cnt2;$y++){



    for ($x = 0; $x < $cnt; $x++) {

      // if($y==0){

      //   $price=$price1[$x];

      // }else{

      //   $price=$price2[$x];

      // }


      $p_id = $sh_id . $x + 1;

      $sql = "INSERT INTO pricelist values ('$p_id',$sh_id,'$s_name[$x]',$price1[$x],$price2[$x],$num)";
      if ($link->query($sql) === TRUE) {
      } else {
        echo "Error updating record: " . $link->error;
      }
      $num += 1;
    }
    $num = 1;



    $sql = "INSERT INTO account values ($sh_id,'$_POST[gname]','$_POST[gnum]')";
    if ($link->query($sql) === TRUE) {
    } else {
      echo "Error updating record: " . $link->error;
    }
  }

  // }


  echo $art_id;
} elseif ($ss == 1) {


  $art = $_GET['art'];

  $artname = $_POST['artname'];
  $type = $_POST['type'];
  $descr = $_POST['descr'];
  $price = $_POST['price'];




  $sql = "UPDATE artwork SET artname='$artname', type='$type',descr='$descr',price='$price' WHERE art_id=$art and user_id=$_SESSION[user_id]";
  if ($link->query($sql) === TRUE) {



    echo $art;
  } else {
    echo "Error updating record: " . $link->error;
  }
} elseif ($ss == 2) {



  $art = $_GET['art'];



  $sql = "SELECT * from artwork where art_id=$art";
  $result = mysqli_query($link, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    echo $user_data['artwork'] . '|<~*931>|';
    echo $user_data['artname'] . '|<~*931>|';
    echo $user_data['type'] . '|<~*931>|';
    echo $user_data['tname'] . '|<~*931>|';
    echo $user_data['price'] . '|<~*931>|';

    echo $user_data['descr'] . '|<~*931>|';

    echo $user_data['filename'] . '|<~*931>|';
    echo $user_data['art_id'];
  } else {
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }
}

// }


//     $sh_id=$_SESSION['user_id'];
//     $sql = "SELECT * FROM info where user_id=$sh_id";
// if($result = mysqli_query($link, $sql)){
//   if(mysqli_num_rows($result) > 0){ 
//       while($row = mysqli_fetch_array($result)){  
//         $ui_pic= $row['pic'];
//         $ui_coverpic= $row['coverpic'];
//           }
//       mysqli_free_result($result);
//   } 
// } else{
//   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }

// $sql = "SELECT username,usertype FROM user where user_id=$sh_id";
// if($result = mysqli_query($link, $sql)){
//   if(mysqli_num_rows($result) > 0){ 
//       while($row = mysqli_fetch_array($result)){     
//         $ui_uname= $row[0];
//         $ui_utype= $row[1]  ;
//           }
//       mysqli_free_result($result);
//   } 
// } else{
//   echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }
