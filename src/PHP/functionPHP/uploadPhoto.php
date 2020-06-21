<?php
require_once ("../config.php");
session_start();
//上传图片
$db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
if (mysqli_connect_errno()){
    echo '<p>Do not connect the database please try again later</p>';
    exit;
}
$query="select * from travelimage";
$result=$db->query($query);
$total=$result->num_rows+2;
$Title=$_POST["title"];
$des=$_POST["des"];
$city=(int)$_POST["select3"];
$country=$_POST["select2"];
$content=$_POST["select1"];
$path=$_FILES["file"]["name"];
$insert="insert into travelimage values (".$total.",'".$Title."','".$des."',null,null,".$city.",'".$country."',".$_SESSION["UID"].",'".$path."','".$content."')";
$insertResult=$db->query($insert);
move_uploaded_file($_FILES["file"]["tmp_name"],"../../../img/normal/small/".$_FILES["file"]["name"]);
echo "已成功保存";
echo "<a href='../PHP-Html/myPhotos.php'>点击浏览</a>";