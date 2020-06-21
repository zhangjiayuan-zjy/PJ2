<?php
header('Content-Type:application/json');
//刷新功能，返回6张图片数据
require_once("../config.php");
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$query="select * from travelimage where Description != \"\" order by rand() limit 6";
$result=$db->query($query);
$array=$result->fetch_all(MYSQLI_ASSOC);
echo json_encode($array,JSON_UNESCAPED_UNICODE);
$result->free();
$db->close();