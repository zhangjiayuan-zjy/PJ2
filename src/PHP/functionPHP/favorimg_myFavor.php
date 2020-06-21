<?php
header('Content-Type:application/json');
session_start();
require_once("../config.php");
//查询用户收藏的图片
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$pageSize=$_POST["pageSize"];
$userName=$_SESSION["username"];
$start=$_POST["startIndex"]*$pageSize;
$query0="select * from traveluser where UserName = '".$userName."'";
$userID=$db->query($query0);
$IDResult=$userID->fetch_assoc();
$ID=$IDResult["UID"];
$query1="select * from travelimagefavor where UID =".$ID;
$imageFavor=$db->query($query1);
$total=$imageFavor->num_rows;
$totalPage=ceil($total/$pageSize);
$array["total"]=$total;
$array["pageSize"]=$pageSize;
$array["totalPage"]=$totalPage;
$query2="select * from travelimagefavor where UID =".$ID." limit ".$start.",".$pageSize;
$imageID=$db->query($query2);
while ($row=$imageID->fetch_assoc()){
    $favorID=$row["ImageID"];
    $query3="select * from travelimage where ImageID =".$favorID;
    $result=$db->query($query3);
    $array["result"][]=$result->fetch_assoc();
}

echo json_encode($array);
$db->close();
