<?php
header('Content-Type:application/json');
//热门主题查询图片
require_once("../config.php");
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$start=$_POST["startIndex"]*16;
$title=$_POST["hotTitle"];
$query0="select * from travelimage where Title=?";
$stmt=$db->prepare($query0);
$stmt->bind_param("s",$title);
$stmt->execute();
$result0=$stmt->get_result();
$total=$result0->num_rows;
$pageSize=16;
$totalPage=ceil($total/$pageSize);
$array["total"]=$total;
$array["pageSize"]=$pageSize;
$array["totalPage"]=$totalPage;
$query1="select * from travelimage where Title=? limit ".$start.",16";
$stmt1=$db->prepare($query1);
$stmt1->bind_param("s",$title);
$stmt1->execute();
$img=$stmt1->get_result();
$array["result"]=$img->fetch_all(MYSQLI_ASSOC);
echo json_encode($array);
$db->close();
