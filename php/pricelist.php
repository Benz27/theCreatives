<?php
session_start();

include("conn.php");

$usid=$_GET['artist'];
$us_id=$_SESSION['user_id'];


$cnter=0;
echo '{';
echo '"Logo":';
echo '{';
$sql = "SELECT s_name, logo from pricelist where user_id=$usid order by a_order";
    if($result = mysqli_query($link, $sql)){
      if(mysqli_num_rows($result) > 0){ 
          while($row = mysqli_fetch_array($result)){ 

            if($cnter < 17){
                echo '"'. $row['s_name'] .'": ["'. $row['logo'] .'"],';
            }else{
                echo '"'. $row['s_name'] .'": ["'. $row['logo'] .'"]';

            }
            
    

            $cnter+=1;



        }
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
  } else{
    echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
  }
  echo '},';

  $cnter=0;

  echo '"Digital":';
  echo '{';
  $sql = "SELECT s_name, digital from pricelist where user_id=$usid order by a_order";
      if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){ 
            while($row = mysqli_fetch_array($result)){ 
  
              if($cnter < 17){
                  echo '"'. $row['s_name'] .'": ["'. $row['digital'] .'"],';
              }else{
                  echo '"'. $row['s_name'] .'": ["'. $row['digital'] .'"]';
  
              }
              
      
  
              $cnter+=1;
  
  
  
          }
          mysqli_free_result($result);
      } else{
          echo "No records matching your query were found.";
      }
    } else{
      echo "ERROR: Could not ple to execute $sql. " . mysqli_error($link);
    }
    echo '}';
    echo '}';
    $cnter=0;














//           "Personal Use (project, assignment, activity, etc.)": 
//           {


//             "Instagram photo sizes: 1080 x 1080 pixels (square)": ["50"],
//             "Instagram photo sizes: 1080 x 566 pixels (landscape)": ["100"],
//             "Instagram photo sizes: 1080 x 1350 pixels": ["150"],
//             "Twitter post image size: 1024 x 512 pixels": ["150"],
//             "Twitter card image size: 1200 x 628 pixels": ["150"],
//             "Pinterest Standard Pin size: 1000 x 1500 pixels": ["100"],
//             "Artstation image size: 1920 pixel width": ["100"],
//             "Artstation image size: 3840 pixel width": ["200"],
//             "Deviant art recommended 1920 x 1080 pixels": ["170"],
//             "A5 paper: 1748 x 2480 pixels": ["150"],
//             "A4 paper: 2480 x 3508 pixels": ["200"],
//             "A3 paper: 3508 x 4960 pixels": ["250"],
//             "8.5'' x 11'' paper: 2550 x 3300 pixels": ["200"],
//             "11'' x 14'' paper: 3300 x 4200 pixels": ["250"],
//             "12'' x 18'' paper: 3600 x 5400 pixels": ["350"],
//             "18'' x 24'' paper: 5400 x 7200 pixels": ["500"],
//             "5'' x 7'' postcard: 1500 x 2100 pixels": ["50"],
//             "24'' x 36'' poster: 7200 x 10800 pixels": ["600"]


//           },






//           "Business Purposes (merchandise, branding, etc.)": 
//           {
//             "Instagram photo sizes: 1080 x 1080 pixels (square)": ["50"],
//             "Instagram photo sizes: 1080 x 566 pixels (landscape)": ["100"],
//             "Instagram photo sizes: 1080 x 1350 pixels": ["150"],
//             "Twitter post image size: 1024 x 512 pixels": ["150"],
//             "Twitter card image size: 1200 x 628 pixels": ["150"],
//             "Pinterest Standard Pin size: 1000 x 1500 pixels": ["100"],
//             "Artstation image size: 1920 pixel width": ["100"],
//             "Artstation image size: 3840 pixel width": ["200"],
//             "Deviant art recommended 1920 x 1080 pixels": ["170"],
//             "A5 paper: 1748 x 2480 pixels": ["150"],
//             "A4 paper: 2480 x 3508 pixels": ["200"],
//             "A3 paper: 3508 x 4960 pixels": ["250"],
//             "8.5'' x 11'' paper: 2550 x 3300 pixels": ["300"],
//             "11'' x 14'' paper: 3300 x 4200 pixels": ["450"],
//             "12'' x 18'' paper: 3600 x 5400 pixels": ["550"],
//             "18'' x 24'' paper: 5400 x 7200 pixels": ["700"],
//             "5'' x 7'' postcard: 1500 x 2100 pixels": ["50"],
//             "24'' x 36'' poster: 7200 x 10800 pixels": ["1,000"],
//             "Printful T-shirt: 3600 x 4800 pixels": ["500"],
//             "Printful Mug: 2700 x 1050 pixels": ["350"],
//             "Printful iPhone case: 879 x 1830 pixels": ["70"]
//           }

?>