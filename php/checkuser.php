
<?php

include("../php/conn.php");     //the page was only requesting data via url from this php file and wasnt included in the main page so it must include its own seperate php files
$q = $_GET['q'];       //gets the url variable 'q'
$qu = $_GET['qu'];      //gets the url variable 'qu'


$sql="SELECT * FROM user where $qu='$q'";//the $qu was used as a table name and $q as data 
$result=mysqli_query($link, $sql);
if($result && mysqli_num_rows($result) > 0){


$user_data=mysqli_fetch_assoc($result);
echo "1";       //if it fetch something it will send a value (1 means the sql fetch some data and 0 means none) which will the retrieve by the mainpage


}else{

    echo "0";
}
 
mysqli_close($link);
?>
