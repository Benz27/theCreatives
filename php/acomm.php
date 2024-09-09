<?php

session_start();
include("conn.php");


$t_id = $_SESSION['user_id'];
$load = $_GET['load'];

$cid = $_GET['cid'];
$bid = $_GET['bid'];
$aid = $_GET['aid'];


$trnum = 0;

if ($load == 0) {

  $sql = "SELECT * FROM transac where tcc_id=$cid and a_id=$t_id and type = 'COMMISION' order by dteti";
  if ($result = mysqli_query($link, $sql)) {

    if (mysqli_num_rows($result) > 0) {

      while ($row = mysqli_fetch_array($result)) {

        $trnum += 1;

        echo     '<tr>';
        echo "<th scope='row'>" . $trnum . "</th>";
        echo "<td id='" . $row['tr_id'] . "rnum'>" . $row['refnum'] . "</td>";
        echo '<td><button value="' . $row["rimg"] . '" id="' . $row["tr_id"] . '" onclick="mod(this.value,this.id)">' . $row["rimgn"] . '</button></td>';
        echo "<td id='" . $row['tr_id'] . "type'>" . $row['pay'] . "</td>";
        echo "<td id='" . $row['tr_id'] . "dte' hidden>" . $row['dte'] . "</td>";
        echo "<td id='" . $row['tr_id'] . "dteti' hidden>" . $row['dteti'] . "</td>";
        echo         '</tr>';
      }
      mysqli_free_result($result);
    }
  } else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }
} elseif ($load == 1) {

  $sql = "SELECT * from commision where c_id=$cid";
  $result = mysqli_query($link, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    echo $user_data['c_id'] . '|<~*931>|'; //0
    echo $user_data['a_id'] . '|<~*931>|'; //1
    echo $user_data['artype'] . '|<~*931>|'; //2
    echo $user_data['artcanname'] . '|<~*931>|'; //3
    echo $user_data['price'] . '|<~*931>|'; //4
    echo $user_data['details'] . '|<~*931>|'; //5
    echo $user_data['refpic'] . '|<~*931>|'; //6
    echo $user_data['refpicname'] . '|<~*931>|'; //7
    echo $user_data['status'] . '|<~*931>|'; //8
    echo $user_data['dttime'] . '|<~*931>|'; //9
    echo $user_data['tardttime'] . '|<~*931>|'; //10
    echo $user_data['stat'] . '|<~*931>|'; //11
    echo $user_data['accrej'] . '|<~*931>|'; //12
    echo $user_data['dtecom'] . '|<~*931>|'; //13

    $sql2 = "SELECT * from account where user_id=$user_data[buyer_id]";
    $result2 = mysqli_query($link, $sql2);


    $user_data2 = mysqli_fetch_assoc($result2);
    echo $user_data2['name'] . '|<~*931>|'; //14
    echo $user_data2['number'] . '|<~*931>|'; //15

    $sql2 = "SELECT username,email from user where user_id=$user_data[buyer_id]";
    $result2 = mysqli_query($link, $sql2);


    $user_data2 = mysqli_fetch_assoc($result2);
    echo $user_data2['username'] . '|<~*931>|'; //16
    echo $user_data2['email'] . '|<~*931>|';

    $sql2 = "SELECT pic from info where user_id=$user_data[buyer_id]";
    $result2 = mysqli_query($link, $sql2);


    $user_data2 = mysqli_fetch_assoc($result2);
    echo $user_data2['pic'];
  } else {
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }
} elseif ($load == 2) {
  $ide = 0;
  $val = $_POST['val'];

  $sql = "SELECT pay FROM transac WHERE tcc_id=$cid order by pay limit 1";
  $result = mysqli_query($link, $sql);
  if ($result && mysqli_num_rows($result) > 0) {
    $user_data = mysqli_fetch_assoc($result);
    if ($user_data['pay'] == "FULL") {

      $ide = 2;
    } else {
      $ide = 1;
    }
  } else {
    $ide = 0;
  }






  // }
  if ($ide == 2 && $val == 3) {





    $e_buname;
    $e_price;



    date_default_timezone_set("Asia/Manila");
    $trdtedisp = date('Y-m-d');

    $sql = "UPDATE commision SET accrej='COMPLETE',stat='COMPLETE',status='PAID',dtecom='$trdtedisp' WHERE c_id=$cid";
    if ($link->query($sql) === TRUE) {
    } else {
      echo "Error updating record: " . $link->error;
    }





    $e_tid = mt_rand(1000000, 9999999);
    $sqle = "SELECT tc_id FROM earnings where tc_id=$e_tid";
    $resulte = mysqli_query($link, $sqle);
    if ($resulte && mysqli_num_rows($resulte) > 0) {
      $use = mysqli_fetch_assoc($resulte);
      while ($e_tid ==  $use['user_id']) {
        $e_tid = mt_rand(1000000, 9999999);
      }
    }

    $sql3 = "SELECT username FROM user where user_id=$bid;";
    $result3 = mysqli_query($link, $sql3);
    if ($result3 && mysqli_num_rows($result3) > 0) {


      $usr = mysqli_fetch_assoc($result3);
      $e_buname = $usr['username'];
    }




    $sql3 = "SELECT price FROM commision where c_id=$cid;";
    $result3 = mysqli_query($link, $sql3);
    if ($result3 && mysqli_num_rows($result3) > 0) {


      $usr = mysqli_fetch_assoc($result3);
      $e_price = $usr['price'];
    }




    $sql = "INSERT INTO earnings values ($e_tid,$bid,'$e_buname','ART COMMISION','$aid','$trdtedisp',$e_price)";
    if ($link->query($sql) === TRUE) {
    } else {
      echo "Error: " . $link->error;
    }
  } else {
    $stat = 'INCOMPLETE';
    if ($val == 3) {

      $stat = 'PENDING';
    }

    $sql = "UPDATE commision SET accrej='$_POST[btn]',stat='$stat' WHERE c_id=$cid";
    if ($link->query($sql) === TRUE) {
    } else {
      echo "Error updating record: " . $link->error;
    }
  }



  // $sql = "UPDATE commision SET accrej='CANCELED',stat='PENDING',status='PAID',dtecom='$trdtedisp' WHERE c_id=$cid";
  //               if ($link->query($sql) === TRUE) {

  //               } else {
  //                 echo "Error updating record: " . $link->error;
  //               }

  // $sql = "UPDATE commision SET accrej='ACCEPT',stat='PENDING',status='PAID',dtecom='$trdtedisp' WHERE c_id=$cid";
  //               if ($link->query($sql) === TRUE) {

  //               } else {
  //                 echo "Error updating record: " . $link->error;
  //               }



  // $sql = "UPDATE commision SET accrej='COMPLETE',stat='COMPLETE',status='PAID',dtecom='$trdtedisp' WHERE c_id=$cid";
  //               if ($link->query($sql) === TRUE) {

  //               } else {
  //                 echo "Error updating record: " . $link->error;
  //               }

  // $sql = "UPDATE commision SET accrej='PENDING',stat='PENDING',status='UNPAID' WHERE c_id=$cid";
  //               if ($link->query($sql) === TRUE) {

  //               } else {
  //                 echo "Error updating record: " . $link->error;
  //               }

} elseif ($load == 3) {



  $sql = "UPDATE commision SET accrej='$_POST[btn]',stat='$_POST[btn]' WHERE c_id=$cid";
  if ($link->query($sql) === TRUE) {
  } else {
    echo "Error updating record: " . $link->error;
  }

  // $sql = "UPDATE commision SET accrej='$_POST[btn]',stat='PENDING',status='PAID',dtecom='$trdtedisp' WHERE c_id=$cid";
  //             if ($link->query($sql) === TRUE) {

  //             } else {
  //               echo "Error updating record: " . $link->error;
  //             }



} elseif ($load == 4) {
  // $ident=0;
  // $ident2=0;
  // $sql = "SELECT pay FROM transac where tcc_id=$cid and b_id=$t_id and type = 'COMMISION' order by dteti DESC";
  // if($result = mysqli_query($link, $sql)){


  //   $u=mysqli_fetch_assoc($result);

  //   if($u['pay']=="FULL"){

  //     $ident=1;


  //   }

  // }




} elseif ($load == 5) {


  $ident = 0;
  $sql = "SELECT pay FROM transac where tcc_id=$cid order by pay limit 1";
  if ($result = mysqli_query($link, $sql)) {

    if (mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_assoc($result);

      if ($row['pay'] == "FULL") {

        $ident = 2;
      } elseif ($row['pay'] == "PARTIAL") {

        $ident = 1;
      }
    } else {

      $ident = 0;
    }
  } else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }



  $sql = "SELECT stat, accrej from commision where c_id=$cid";
  if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_array($result)) {

        if ($row['accrej'] == "CANCELED") {


          echo 4;
        } else if ($row['accrej'] == "REJECTED") {

          echo 3;
        }
        if ($row['accrej'] == "ACCEPTED") {

          echo 2;
        }
        if ($row['accrej'] == "PENDING") {



          echo 1;
        }
        if ($row['accrej'] == "COMPLETE") {

          echo 5;
        }
        if ($row['accrej'] == "SENT") {


          echo 0;
        }

        echo ',' . $ident;
      }
      mysqli_free_result($result);
    } else {
      echo "No records matching your query were found.";
    }
  } else {
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }
  // $cnter=0;
  // echo '{';
  // echo '"Logo":';
  // echo '{';
  // $sql = "SELECT s_name, logo from pricelist where user_id=$aid order by a_order";
  //     if($result = mysqli_query($link, $sql)){
  //       if(mysqli_num_rows($result) > 0){ 
  //           while($row = mysqli_fetch_array($result)){ 

  //             if($cnter < 17){
  //                 echo '"'. $row['s_name'] .'": ["'. $row['logo'] .'"],';
  //             }else{
  //                 echo '"'. $row['s_name'] .'": ["'. $row['logo'] .'"]';

  //             }



  //             $cnter+=1;



  //         }
  //         mysqli_free_result($result);
  //     } else{
  //         echo "No records matching your query were found.";
  //     }
  //   } else{
  //     echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  //   }
  //   echo '},';

  //   $cnter=0;

  //   echo '"Digital":';
  //   echo '{';
  //   $sql = "SELECT s_name, digital from pricelist where user_id=$aid order by a_order";
  //       if($result = mysqli_query($link, $sql)){
  //         if(mysqli_num_rows($result) > 0){ 
  //             while($row = mysqli_fetch_array($result)){ 

  //               if($cnter < 17){
  //                   echo '"'. $row['s_name'] .'": ["'. $row['digital'] .'"],';
  //               }else{
  //                   echo '"'. $row['s_name'] .'": ["'. $row['digital'] .'"]';

  //               }



  //               $cnter+=1;



  //           }
  //           mysqli_free_result($result);
  //       } else{
  //           echo "No records matching your query were found.";
  //       }
  //     } else{
  //       echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  //     }
  //     echo '}';
  //     echo '}';
  //     $cnter=0;










}
