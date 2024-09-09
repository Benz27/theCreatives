<?php





  $art_id=$_POST['artid'];
$sql="UPDATE artwork  set artwork='$artwork', artname='$artname',uname='$uname',artist='$artist', type='$type',tname='$tname',descr='$descr',price=$price,filename='$txtsf' where art_id=$art_id and user_id=$sh_id"; 
  if ($link->query($sql) === TRUE) {
    
  } else {
    echo "Error updating record: " . $link->error;
  }


?>