<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="../../../fonts/font1/iconfont.css">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/footer2.css">
    <script src="../../JS/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/less" href="../../css/nav.less">
    <link rel="stylesheet" type="text/less" href="../../css/upload.less">
    <script src="../../css/less.min.js"></script>
</head>
<body>
<!-- 导航栏 -->
<nav class="clear" id="top">
    <ul class="nav">
        <li><a href="../../../index.php">Home</a></li>
        <li><a href="browser.php">Browser</a></li>
        <li><a href="Search.php">Search</a></li>
        <li class="acount">
            <?php
            session_start();
            //判断是否登录
            if (isset($_SESSION["username"])){
                echo $_SESSION["username"];
                echo "<ul>";
                echo "<li><a href=\"./upload.php\"><i class=\"iconfont icon-shangchuan\"></i>Upload</a></li>";
                echo "<li><a href=\"./myPhotos.php\"><i class=\"iconfont icon-zhaopian\"></i>Photos</a></li>";
                echo "<li><a href=\"./myFavor.php\"><i class=\"iconfont icon-shoucang\"></i>Collection</a></li>";
                echo "<li><a href='./logout.php'><i class=\"iconfont icon--dengru\"></i>Log out</a></li>";
                echo " </ul>";
            } else{
                echo "<a href='login.php'>LOGIN</a>";
            }
            ?>
        </li>
    </ul>
</nav>

<div class="main">
    <h1>Upload</h1>
    <div class="upload">
        <!-- 上传照片框 -->
        <form method="POST" action="../functionPHP/uploadPhoto.php" enctype="multipart/form-data" onsubmit="return checkAll()">
        <div id="imgPreview">
            <div class="contain">
                <div class="img" id="img">
                    <p id="p">Photos is not upload</p>
                </div>
                <div class="contains">
                    <div id="prompt3">
                        <input type="file" name="file" id="file" class="filepath">
                        <input type="button" name="button" value="Upload" id="button">
                    </div>
                </div>

            </div>
        </div>
        <!-- 填充图片信息栏 -->
        <label for="select1">Content:</label>
        <div class="item select">
            <select id="select1" name="select1">
                <option value="select content">select content</option>
                <option value="scenery">scenery</option>
                <option value="city">city</option>
                <option value="people">people</option>
                <option value="animal">animal</option>
                <option value="building">building</option>
                <option value="wonder">wonder</option>
                <option value="other">other</option>
            </select>
            <div class="replace" id="replace1">select content<i class="iconfont icon-shangxia"></i></div>
        </div>
        <label for="select2">Country:</label>
        <div class="item select">
            <select id="select2" name="select2">
                <option value="select country">select country</option>
                <?php
                require_once("../config.php");
                //列出数据库中所有的国家
                $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
                $query2="select * from geocountries_regions order by Population DESC limit 20";
                $allCountry=$db->query($query2);
                $allResult=$allCountry->fetch_all(MYSQLI_ASSOC);
                for ($i=0;$i<count($allResult);$i++){
                    echo "<option value='".$allResult[$i]["ISO"]."' data-ISO='".$allResult[$i]["ISO"]."'>".$allResult[$i]["Country_RegionName"]."</option>";
                }
                ?>
            </select>
            <div class="replace" id="replace2">select country<i class="iconfont icon-shangxia"></i></div>
        </div>
        <label for="select3">City:</label>
        <div class="item select">
            <select id="select3" name="select3">
                <option>select city</option>
            </select>
            <div class="replace" id="replace3">select city<i class="iconfont icon-shangxia"></i></div>
        </div>
        <div class="item">
            <div class="head">Title</div>
            <input type="text" class="text" id="title" name="title">
        </div>
        <div class="item">
            <div class="head">Description</div>
            <textarea name="des" id="dp"></textarea>
        </div>
        <input type="submit" id="submit" value="Submit">
        </form>
    </div>
</div>

<footer>
    Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>
<script src="../../JS/upload.js"></script>
<script src="../../JS/test_upload.js"></script>
</body>
</html>
