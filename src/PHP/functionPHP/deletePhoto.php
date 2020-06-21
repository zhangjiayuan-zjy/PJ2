<?php
require_once ("../config.php");
session_start();
//删除图片信息
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$table=$_POST["table"];
$UID=$_SESSION["UID"];

if ($table=="travelimage"){
    $delete="delete from travelimage where PATH = '".$_POST["Path"]."'";
}else if ($table=="travelimagefavor"){
    $delete="delete from travelimagefavor where ImageID =".$_POST["ImageID"]." and UID =".$UID;
}
$result=$db->query($delete);
$db->close();
