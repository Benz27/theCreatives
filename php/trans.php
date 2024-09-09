<?php
session_start();
include("conn.php");

$tbl=$_GET['tbl'];


echo  '<div class="table-container rounded bg-white">';


$t_id=$_SESSION['user_id'];
$trnum=0;
$artist="";
$username="";
if($tbl==0){



$sql = "SELECT * FROM trlist where buyer_id=$t_id order by dte DESC";
if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 
      


    echo  '  <table class="table">';
    echo '    <h1>Purchase History</h1>';
    echo'    <thead>';
    echo    '  <tr>';
    echo   '   <th scope="col">#</th>';
    echo      '              <th scope="col">Items</th>';
    echo     '               <th scope="col">Date</th>';
    echo    '                <th scope="col">Amount</th>';
    echo   '               </tr>';
    echo  '              </thead>';
    echo '               <tbody>';


while($row = mysqli_fetch_array($result)){  
 
    $trnum+=1;

    echo     '<tr>';
    echo"<th scope='row'><a style='color: black;' href='purchsum.html?art_id=" . $row['i_link'] . "&frm=proftrans&trlst=" . $row['t_id'] . "'>" . $trnum . "</a></th>";
echo "<td><a style='color: black;' href='purchsum.html?art_id=" . $row['i_link'] . "&frm=proftrans&trlst=" . $row['t_id'] . "'>" . $row['itmc'] . "</a></td>";
echo "<td><a style='color: black;' href='purchsum.html?art_id=" . $row['i_link'] . "&frm=proftrans&trlst=" . $row['t_id'] . "'>" . $row['dtedisp'] . "</a></td>";
echo "<td><a style='color: black;' href='purchsum.html?art_id=" . $row['i_link'] . "&frm=proftrans&trlst=" . $row['t_id'] . "'>PHP " . $row['price'] . "</a></td>";

echo         '</tr>';

}
mysqli_free_result($result);
echo  '              </tbody>';
echo '           </table>';

} else{


  echo '    <h1>Purchase History</h1>';
  echo '<medium id="md"> (your purchase history will apear here.) </medium>';


}



} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

}elseif($tbl==1){





$cnum=0;
$sql = "SELECT * FROM commision where buyer_id=$t_id order by dttime DESC";
if($result = mysqli_query($link, $sql)){

  if(mysqli_num_rows($result) > 0){ 

      
echo    '        <table class="table" id="'.$t_id .'com">';
echo  '              <h1>Arts Commissioned</h1>';
echo '               <thead>';
echo                 ' <tr>';

echo                '    <th scope="col"></th>';
echo               '     <th scope="col">Artist</th>';
echo              '      <th scope="col">Type of Artwork</th>';
echo             '       <th scope="col">Art Canvas Size</th>';
echo            '        <th scope="col">Amount</th>';
echo           '         <th scope="col">Status</th>';

echo          '        </tr>';
echo         '       </thead>';
echo        '        <tbody>';


while($row = mysqli_fetch_array($result)){  

  $sqlf="SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$row[a_id] and user.user_id=$row[a_id]"; 
  $resultf=mysqli_query($link, $sqlf);  
  if($resultf && mysqli_num_rows($resultf) > 0){ 

    $user_data=mysqli_fetch_assoc($resultf);

    $artist=$user_data['fname']. ' ' .$user_data['lname'];
    $username=$user_data['username'];


  }
  
  $cnum+=1;
  echo     '             <tr>';
  echo'<th scope="row"><a style="color: black;" href="../html/commision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $cnum . '</a></th>';
  // echo '<td><a href="../html/commsum.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $artist . '</a></td>';
echo '<td><a style="color: black;" href="../html/commision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">@' . $username . '</a></td>';
echo '<td><a style="color: black;" href="../html/commision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['artype'] . '</a></td>';
echo '<td><a style="color: black;" href="../html/commision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['artcanname'] . '</td>';
echo '<td><a style="color: black;" href="../html/commision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">PHP ' . $row['price'] . '</a></td>';
echo '<td><a style="color: black;" href="../html/commision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['accrej'] . '</a></td>';
echo         '         </tr>';
// echo '../html/commsum.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=trans';
}


mysqli_free_result($result);
echo  '              </tbody>';
echo '           </table>';
} else{



  echo '    <h1>Arts Commissioned</h1>';
  echo '<medium id="md"> (the arts you commisioned to artists will apear here.) </medium>';

}



} else{
echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
}elseif($tbl==2){

  $identif=0;
  $num=0;
  // $sql = "SELECT * FROM transaction where artist_id=$t_id order by dte DESC";
  // $sql="SELECT art_id,artname from artwork where user_id=$t_id";
  $sql="select artname,art_id, (select count(art_id) from transaction t where t.art_id= a.art_id) as 'count' , (select sum(price) from transaction t where t.art_id= a.art_id) as 'price' from artwork a where a.user_id=$t_id having count > 0 order by artname";
  if($result = mysqli_query($link, $sql)){
  
    if(mysqli_num_rows($result) > 0){ 
        
  
  
      echo  '  <table class="table">';
      echo '    <h1>Artworks Sold</h1>';
      echo'    <thead>';
      echo    '  <tr>';
      echo   '   <th scope="col">#</th>';
      echo      '              <th scope="col">Artwork</th>';
      echo    '                <th scope="col">Quantity</th>';
      echo     '               <th scope="col">Amount</th>';
      // echo     '               <th scope="col">Date</th>';
      // echo    '                <th scope="col">Price</th>';
      echo   '               </tr>';
      echo  '              </thead>';
      echo '               <tbody>';
  
  
  while($row = mysqli_fetch_array($result)){  


    

    // $sqlf="SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$row[buyer_id] and user.user_id=$row[buyer_id]"; 
    // $sqlf="SELECT count(art_id), sum(price) from transaction where art_id=$row[art_id]"; 
    // $resultf=mysqli_query($link, $sqlf);  
    // if($resultf && mysqli_num_rows($resultf) > 0){ 

    //   $dataa=mysqli_fetch_assoc($resultf); 

  
    // }
    // if($dataa['count(art_id)']>0){
      $trnum+=1;
      echo     '<tr>';
      echo"<th scope='row'><a style='color: black;' href='art.html?art=" . $row['art_id'] . "'>" . $trnum . "</a></th>";
     echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "'>" . $row['artname'] . "</a></td>";
     echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "'>" . $row['count'] . "</a></td>";
     echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "'>PHP " . $row['price'] . "</a></td>";
  
     echo         '</tr>';

    // }
  

  
  }
  mysqli_free_result($result);

  echo  '              </tbody>';
echo '           </table>';
  
  } else{


    echo '    <h1>Artworks Sold</h1>';
    echo '<medium id="md"> (your arts that have been sold will apear here.) </medium>';

  }

  } else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }



}elseif($tbl==3){


  $cnum=0;
  $sql = "SELECT * FROM commision where a_id=$t_id and stat = 'COMPLETE'";
  if($result = mysqli_query($link, $sql)){
  
    if(mysqli_num_rows($result) > 0){ 

  
  echo    '        <table class="table" id="'.$t_id .'com">';
  echo  '              <h1>My Commisions</h1>';
  echo '               <thead>';
  echo                 ' <tr>';
  
  echo                '    <th scope="col">#</th>';
  echo               '     <th scope="col">Username</th>';
  echo              '      <th scope="col">Type of Artwork</th>';
  echo             '       <th scope="col">Art Canvas Size</th>';
  echo             '       <th scope="col">Image Reference</th>';
  echo            '        <th scope="col">Amount</th>';
  echo           '         <th scope="col">Status</th>';
  
  echo          '        </tr>';
  echo         '       </thead>';
  echo        '        <tbody>';
  
  
  while($row = mysqli_fetch_array($result)){  

    $sqlf="SELECT info.fname, info.lname,user.username FROM info,user where info.user_id=$row[buyer_id] and user.user_id=$row[buyer_id]"; 
    $resultf=mysqli_query($link, $sqlf);  
    if($resultf && mysqli_num_rows($resultf) > 0){ 
  
      $user_data=mysqli_fetch_assoc($resultf);
  
      $artist=$user_data['fname']. ' ' .$user_data['lname'];
      $username=$user_data['username'];
  
  
    }

    $cnum+=1;
    echo     '             <tr>';
    echo'<th scope="row"><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $cnum . '</a></th>';
    echo '<td><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">@' . $username . '</a></td>';
  echo '<td><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['artype'] . '</a></td>';
  echo '<td><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['artcanname'] . '</a></td>';
  echo '<td><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['refpicname'] . '</td>';
  echo '<td><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">PHP ' . $row['price'] . '</a></td>';
  echo '<td><a style="color: black;" href="../html/artistcommision.html?aid='. $row['a_id'] .'&bid='. $row['buyer_id'] .'&cid='. $row['c_id'] .'&frm=proftrans">' . $row['status'] . '</a></td>';
  echo         '         </tr>';

  //   echo     '<tr>';
  //   echo'<th scope="row">' . $cnum . '</th>';
  //   echo "<td>@" . $row['b_username'] . "</td>";
  // echo "<td>" . $row['artype'] . "</td>";
  // echo "<td>" . $row['artcanname'] . "</td>";
  // echo "<td>" . $row['refpicname'] . "</td>";
  // echo "<td>PHP " . $row['price'] . "</td>";
  // echo "<td>" . $row['status'] . "</td>";
  // echo         '</tr>';
  
  }
  
  
  mysqli_free_result($result);

  echo  '              </tbody>';
  echo '           </table>';
  } else{



    echo '    <h1>My Commisions</h1>';
    echo '<medium id="md"> (your finished art commisions will apear here.) </medium>';
 

  }

  } else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }



}elseif($tbl==4){





  $sql = "SELECT * FROM transaction where buyer_id=$t_id order by dte DESC";
  if($result = mysqli_query($link, $sql)){
  
    if(mysqli_num_rows($result) > 0){ 
        
  
  
      echo  '  <table class="table">';
      echo '    <h1>Purchased Artworks</h1>';
      echo'    <thead>';
      echo    '  <tr>';
      echo   '   <th scope="col">#</th>';
      echo      '              <th scope="col">Artwork</th>';
      echo     '               <th scope="col">Artist</th>';
      echo     '               <th scope="col">Date</th>';
      echo    '                <th scope="col">Amount</th>';
      echo   '               </tr>';
      echo  '              </thead>';
      echo '               <tbody>';
  
  
  while($row = mysqli_fetch_array($result)){  
    $sqlf="SELECT user.username,artwork.artname FROM artwork,user where artwork.user_id=$row[artist_id] and user.user_id=$row[artist_id] and artwork.art_id=$row[art_id]"; 
  $resultf=mysqli_query($link, $sqlf);  

  if($resultf && mysqli_num_rows($resultf) > 0){ 

    $user_data=mysqli_fetch_assoc($resultf);
    $user=$user_data['username'];
    $artn=$user_data['artname'];

  }


      $trnum+=1;
  
      echo     '<tr>';
      echo"<th scope='row'><a style='color: black;' href='art.html?art=" . $row['art_id'] . "&frm=proftrans'>" . $trnum . "</a></th>";


  echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "&frm=proftrans'>" . $artn . "</a></td>";


  echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "&frm=proftrans'>" . $user . "</a></td>";


  echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "&frm=proftrans'>" . $row['dtedisp'] . "</a></td>";
  echo "<td><a style='color: black;' href='art.html?art=" . $row['art_id'] . "&frm=proftrans'>PHP " . $row['price'] . "</a></td>";
  
  echo         '</tr>';
  
  }
  mysqli_free_result($result);
  echo  '              </tbody>';
  echo '           </table>';
  
  } else{
  
  
    echo '    <h1>Purchased Artworks</h1>';
    echo '<medium id="md"> (your purchased artworks will apear here.) </medium>';
  
  
  }
  
  
  
  } else{
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }






}

echo '       </div>';

?>