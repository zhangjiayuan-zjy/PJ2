<?php
require_once("../config.php");
//更新数据库图片信息
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$update="update travelimage set Title ='".$_POST["Title"]."',Description='".$_POST["Des"]."',CityCode=".$_POST["cityID"].",	Country_RegionCodeISO ='".$_POST["countryID"]."',Content='".$_POST["Content"]."' where PATH='".$_POST["path"]."'";
$result=$db->query($update);

