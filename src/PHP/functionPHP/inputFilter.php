<?php
header('Content-Type:application/json');
//输入查询图片
require_once("../config.php");
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$pageSize=$_POST["pageSize"];
$start=$_POST["startIndex"]*$pageSize;
$title=$_POST["inputTitle"];
$query0="select * from travelimage where Title like '%".$title."%'";
$totalResult=$db->query($query0);
$total=$totalResult->num_rows;
$totalPage=ceil($total/$pageSize);
$array["total"]=$total;
$array["pageSize"]=$pageSize;
$array["totalPage"]=$totalPage;
$query1="select * from travelimage where Title like '%".$title."%' limit ".$start.",".$pageSize;
$img=$db->query($query1);
$array["result"]=$img->fetch_all(MYSQLI_ASSOC);
echo json_encode($array);

