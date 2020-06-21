<?php
require_once("../config.php");
session_start();
//收藏图片
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$query="select * from travelimagefavor";
$result=$db->query($query);
$total=$result->num_rows+1;
$ImageID=$_POST["ImageID"];
$UID=$_SESSION["UID"];
$insert="insert into travelimagefavor values (".$total.",".$UID.",".$ImageID.")";
$insertResult=$db->query($insert);
$db->close();
