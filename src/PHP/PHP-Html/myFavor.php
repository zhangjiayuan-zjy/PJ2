
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favor</title>
    <link rel="stylesheet" href="../../../fonts/font1/iconfont.css">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/footer2.css">
    <script src="../../JS/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/less" href="../../css/nav.less">
    <link rel="stylesheet" type="text/less" href="../../css/favor.less">
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
<div class="favor">
    <h1>My Favorite</h1>
    <div class="helptips">
    </div>
    <div class="main">
        <!-- 图片简略信息 -->
    </div>
    <div class="link">
    </div>

</div>

<footer>
    Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>
<script src="../../JS/myFavor.js"></script>
</body>

</html>
