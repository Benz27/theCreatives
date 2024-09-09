<?php
session_start();
include("conn.php");

$id = $_GET['id'];
$uid = $_SESSION['user_id'];
$c = $_GET['c'];
$oid = mt_rand(1000000, 9999999);

if ($c == 0) {
    $sql = "SELECT o_id FROM cart where o_id=$oid";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
        while ($oid ==  $user_data['o_id']) {
            $oid = mt_rand(1000000, 9999999);
        }
    }

    $sql = "INSERT INTO cart (o_id, art_id, user_id) values ($oid,$id,$uid)";
    if ($link->query($sql) === TRUE) {
    } else {
        echo "Something went wrong: " . $link->error;
    }

    echo "1";
} elseif ($c == 1) {
    $sql = "DELETE FROM cart where art_id=$id and user_id=$uid";
    if ($link->query($sql) === TRUE) {
    } else {
        echo "Something went wrong: " . $link->error;
    }
    echo "0";
}
