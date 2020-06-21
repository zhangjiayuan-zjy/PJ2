<?php?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="../../../fonts/font1/iconfont.css">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/footer2.css">
    <script src="../../JS/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/less" href="../../css/nav.less">
    <link rel="stylesheet" type="text/less" href="../../css/search.less">
    <script src="../../css/less.min.js"></script>
</head>
<body>
<nav class="clear" id="top">
    <ul class="nav">
        <li><a href="../../../index.php">Home</a></li>
        <li><a href="browser.php">Browser</a></li>
        <li class="selected"><a>Search</a></li>
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
    <!-- 搜索栏 -->

    <div class="search">
        <h1>Search</h1>
        <div class="main">
            <input type="radio" name="filter" value="title" class="radio" checked>Filter by Title
        <div class="title"><input type="text" id="titleInput"></div>
            <input type="radio" name="filter" value="description" class="radio">Filter by description
            <div class="description"><textarea id="desInput" disabled></textarea></div>
            <div class="button"><input type="button" name="" value="Filter" id="filter" "></div>
        </div>
    </div>
    <!-- 图片结果 -->
    <div class="result">
        <h1>Result</h1>
        <div class="helptips" style="width: 100%;
    text-align: center">
        </div>
        <div class="main imgResult">
        </div>
        <div class="link">
        </div>
    </div>

    <footer>
Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>
<script src="../../JS/Search.js"></script>
<script src="../../JS/page.js"></script>

</body>

</html>