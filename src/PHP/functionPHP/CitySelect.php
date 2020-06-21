<?php
header('Content-Type:application/json');
require_once("../config.php");
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
if (isset($_POST["limit"])){
    $query="select * from geocities where Country_RegionCodeISO = '{$_POST["ISO"]}'order by Population DESC limit 20";
}else{
    $query="select * from geocities where Country_RegionCodeISO = '{$_POST["ISO"]}'order by Population DESC ";
}
    $city=$db->query($query);
    $result=$city->fetch_all(MYSQLI_ASSOC);
    echo json_encode($result);