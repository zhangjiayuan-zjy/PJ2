<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./src/css/reset.css">
    <link rel="stylesheet" href="./fonts/font1/iconfont.css">
    <link rel="stylesheet" href="./fonts/font2/iconfont.css">
    <link rel="stylesheet" href="./fonts/font3/iconfont.css">
    <script src="./src/JS/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/less" href="./src/css/nav.less">
    <link rel="stylesheet" type="text/less" href="./src/css/home.less">
    <script src="./src/css/less.min.js"></script>
</head>

<body>
<!-- 导航栏 -->
<nav class="clear" id="top">
    <ul class="nav">
        <li class="selected"><a>Home</a></li>
        <li><a href="src/PHP/PHP-Html/browser.php">Browser</a></li>
        <li><a href="./src/PHP/PHP-Html/Search.php">Search</a></li>
        <li class="acount">
            <?php
            //判断是否已经登录
            if (isset($_SESSION["username"])){
                echo $_SESSION["username"];
                echo "<ul>";
                echo "<li><a href=\"./src/PHP/PHP-Html/upload.php\"><i class=\"iconfont icon-shangchuan\"></i>Upload</a></li>";
                echo "<li><a href=\"./src/PHP/PHP-Html/myPhotos.php\"><i class=\"iconfont icon-zhaopian\"></i>Photos</a></li>";
                echo "<li><a href=\"./src/PHP/PHP-Html/myFavor.php\"><i class=\"iconfont icon-shoucang\"></i>Collection</a></li>";
                echo "<li><a href='./src/PHP/PHP-Html/logout.php'><i class=\"iconfont icon--dengru\"></i>Log out</a></li>";
                echo " </ul>";
            } else{
                echo "<a href='./src/PHP/PHP-Html/login.php'>LOGIN</a>";
            }
            ?>
        </li>
    </ul>
</nav>

<!-- 高清大图 -->
<div class="mainPhoto">
    <img src="./img/normal/medium/9505536014.jpg" alt="无法显示">
</div>
<!-- 6张图片展示 -->
<div class="otherphoto clear">
    <?php
    require_once ("./src/PHP/config.php");
    $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
    if (mysqli_connect_errno()){
        echo '<p>Do not connect the database please try again later</p>';
        exit;
    }
    $query="select * from travelimage where Description != \"\" order by rand() limit 6";
    $result=$db->query($query);
    //查询6张图片
    while ($array=$result->fetch_assoc()){
        echo "<div class=\"photo\">";
        echo "<a><img src=\"./img/normal/small/".$array["PATH"] ."\"alt=\"无法显示\"></a>";
        echo "<h4>".$array["Title"]."</h4>";
        echo "<div class=\"description\">";
        echo $array["Description"];
        echo " </div>";
        echo " </div>";
    }
    $result->free();
    $db->close();

    ?>
</div>

<!-- 页脚 -->
<footer>
    <div class="firstline">
        关于网站：
        <a href="">关于我们</a>|
        <a href="">关于运营团队</a>|
        <a href="">投资者关系</a> 友情连接：
        <a href="">窃格拉瓦</a>|
        <a href="">奥里给</a>|
        <a href="">初音未来</a>
    </div>
    <div class="secondline">
        联系我们：
        <i class="iconfont icon-iconfontweixin"></i>
        <i class="iconfont icon-QQ"></i>
        <i class="iconfont icon-youxiang"></i>
    </div>
    <div class="thirdline">
        Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
    </div>
</footer>
<!-- 悬浮按钮 -->
<div class="buttons">
    <div><a href="#top"><i class="iconfont icon-tubiao02 i1"></i></a></div>
    <div><i class="iconfont icon-shuaxin i2"></i></div>
</div>
<script>
    $(function () {
        //刷新功能
        $(".i2").on("click", function () {
            $.post("./src/PHP/functionPHP/fresh.php", function (data) {
                for (let i = 0; i < 6; i++) {
                    let path = "./img/normal/small/" + data[i]["PATH"];
                    $(".photo a img").eq(i).attr("src", path);
                    $(".photo h4").eq(i).innerHTML = data[i]["Title"];
                    $(".photo .description").eq(i).innerHTML = data[i]["Description"];
                }
            })
        })
    })
//图片详情
    $(".photo a img").on("click",function (event) {
        var target=event.target.parentNode;
        var $target=$(target);
        var shortPath=event.target.src.substr(event.target.src.lastIndexOf("/")+1);
        $(location).attr("href","./src/PHP/PHP-Html/detail.php?PATH="+shortPath+"&Title="+$target.siblings("h4").text()+"&Description="+$target.siblings(".description").text());
    })
</script>


</body>

</html>
