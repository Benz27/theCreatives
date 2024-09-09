<?php
$about_id = $_SESSION['user_id'];
// $about_fname;
// $about_lname;
// $about_contno;
// $about_address;
// $about_state;
// $about_country;
// $about_exp;
// $about_addet;
// $about_pic;



// Attempt select query execution

if ($_SERVER['REQUEST_METHOD'] == 'POST') { //will execute if the form was submitted/posted
  $ab_id = $_SESSION['user_id'];
  $ab_uname = $_POST['uname'];
  $ab_fname = $_POST['fname'];
  $ab_lname = $_POST['lname'];
  $ab_pic = $_POST['pic'];
  $ab_coverpic = $_POST['coverpic'];
  $ab_email = $_POST['email'];
  $ab_address = $_POST['add'];
  $ab_contno = $_POST['contno'];
  $ab_state =  $_POST['state'];
  $ab_country =  $_POST['country'];
  $ab_exp = $_POST['exp'];
  $ab_addet = $_POST['addet'];

  $sql = "UPDATE info SET fname='$ab_fname', lname='$ab_lname',address='$ab_address',contno='$ab_contno',state='$ab_state',country='$ab_country',exp='$ab_exp',addet='$ab_addet',pic='$ab_pic',coverpic='$ab_coverpic' WHERE user_id=$ab_id";
  if ($link->query($sql) === TRUE) {
  } else {
    echo "Error updating record: " . $link->error;
  }
  $sql = "UPDATE user SET username='$ab_uname',email='$ab_email' WHERE user_id=$ab_id";
  if ($link->query($sql) === TRUE) {
  } else {
    echo "Error updating record: " . $link->error;
  }


  $sql = "SELECT * FROM account where user_id=$ab_id";
  if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
      $sqla = "UPDATE account SET name='$_POST[gname]', number='$_POST[gnum]' WHERE user_id=$ab_id";
      if ($link->query($sqla) === TRUE) {
      } else {
        echo "Error updating record: " . $link->error;
      }
    }
  }
}

$sql = "SELECT * FROM info where user_id=$about_id";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $about_fname = $row['fname'];
      $about_lname = $row['lname'];
      $about_pic = $row['pic'];
      $about_coverpic = $row['coverpic'];
      $about_address = $row['address'];
      $about_contno = $row['contno'];
      $about_state =  $row['state'];
      $about_country =  $row['country'];
      $about_exp = $row['exp'];
      $about_addet = $row['addet'];
    }
    mysqli_free_result($result);
  } else {
    echo "No records matching your query were found.";
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$sql = "SELECT username, email,usertype FROM user where user_id=$about_id";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $about_uname = $row[0];
      $about_email = $row[1];
      $about_usertype = $row[2];
    }
    mysqli_free_result($result);
  } else {
    echo "No records matching your query were found.";
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

$about_gname = "";
$about_gnum = "";
$sql = "SELECT * FROM account where user_id=$about_id";
if ($result = mysqli_query($link, $sql)) {
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
      $about_gname = $row[1];
      $about_gnum = $row[2];
    }
    mysqli_free_result($result);
  }
} else {
  echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}





// Close connection
