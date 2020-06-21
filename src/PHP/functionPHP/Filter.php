<?php
header('Content-Type:application/json');
//国家城市查询图片
require_once("../config.php");
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$cityID=$_POST["cityID"];
$countryID=$_POST["countryISO"];
$content=$_POST["content"];
$start=$_POST["startIndex"]*16;
$query0="select * from travelimage where Content ='".$content."' and CityCode =".$cityID;
$totalResult=$db->query($query0);
$total=$totalResult->num_rows;
$pageSize=16;
$totalPage=ceil($total/$pageSize);
$array["total"]=$total;
$array["pageSize"]=$pageSize;
$array["totalPage"]=$totalPage;
$query="select * from travelimage where Content ='".$content."' and CityCode =".$cityID." limit ".$start.",16";
$img=$db->query($query);
$array["result"]=$img->fetch_all(MYSQLI_ASSOC);
echo json_encode($array);

