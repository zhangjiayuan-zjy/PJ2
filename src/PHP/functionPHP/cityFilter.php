<?php
header('Content-Type:application/json');
//热门城市查询图片
require_once("../config.php");
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$start=$_POST["startIndex"]*16;
$cityCode=$_POST["hotCity"];
$query0="select * from travelimage where CityCode='".$cityCode."'";
$totalResult=$db->query($query0);
$total=$totalResult->num_rows;
$pageSize=16;
$totalPage=ceil($total/$pageSize);
$array["total"]=$total;
$array["pageSize"]=$pageSize;
$array["totalPage"]=$totalPage;
$query1="select * from travelimage where CityCode='".$cityCode."' limit ".$start.",16";
$img=$db->query($query1);
$array["result"]=$img->fetch_all(MYSQLI_ASSOC);
echo json_encode($array);
