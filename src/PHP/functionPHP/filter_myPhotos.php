<?php
header('Content-Type:application/json');
session_start();
require_once("../config.php");
//查询用户已上传的图片数据
if (isset($_SESSION["UID"])){
    $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
    if (mysqli_connect_errno()){
        echo '<p>Do not connect the database please try again later</p>';
        exit;
    }
    $ID=$_SESSION["UID"];
    $pageSize=$_POST["pageSize"];
    $start=$_POST["startIndex"]*$pageSize;
    $query0="select * from travelimage where UID =".$ID;
    $result=$db->query($query0);
    $total=$result->num_rows;
    $totalPage=ceil($total/$pageSize);
    $array["total"]=$total;
    $array["pageSize"]=$pageSize;
    $array["totalPage"]=$totalPage;
    $query1="select * from travelimage where UID =".$ID." limit ".$start.",".$pageSize;
    $imgResult=$db->query($query1);
    $array["result"]=$imgResult->fetch_all(MYSQLI_ASSOC);
    echo json_encode($array);
    $result->free();
    $imgResult->free();
    $db->close();
}
