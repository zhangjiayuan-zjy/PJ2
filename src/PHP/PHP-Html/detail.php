
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../../fonts/font1/iconfont.css">
    <link rel="stylesheet" href="../../css/footer2.css">
    <script src="../../JS/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/less" href="../../css/nav.less">
    <link rel="stylesheet" type="text/less" href="../../css/detail.less">
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
    <!-- 图片详情 -->
    <div class="detail">
        <div class="head">
            <p>Details</p>
        </div>
        <div class="main">
            <h1>
        <?php
        require_once('../config.php');
        if (isset($_GET["Title"])){
        $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
        if (mysqli_connect_errno()){
        echo '<p>Do not connect the database please try again later</p>';
        exit;
        }
        $path=$_GET["PATH"];
        $description=$_GET["Description"];
        $Title=$_GET["Title"];
        //通过获取的信息查询相应的图片，获得完整数据
        $query0="select * from travelimage where PATH=? limit 1";
        $stmt0=$db->prepare($query0);
        $stmt0->bind_param("s",$path);
        $stmt0->execute();
        $img0=$stmt0->get_result();
        $imgArray=$img0->fetch_assoc();
        $imageID=$imgArray["ImageID"];
        $ISO=$imgArray["Country_RegionCodeISO"];
        //通过国家ISO获得国家名
        $query1="select * from geocountries_regions where ISO='$ISO'";
        $result=$db->query($query1);
        $country=$result->fetch_assoc();
        $intCity=(int)$imgArray["CityCode"];
        //获得城市名
        $query2="select * from geocities where GeoNameID={$intCity}";
        $City=$db->query($query2);
        $cityResult=$City->fetch_assoc();
        $UID=$imgArray["UID"];
        //获得用户名
        $query3="select * from traveluser where UID= '$UID'";
        $user=$db->query($query3);
        $userArray=$user->fetch_assoc();
        //判断是否被收藏
        $query4="select * from travelimagefavor where UID =".$_SESSION["UID"]." and ImageID = ".$imageID;
        $isCollect=$db->query($query4);
        //计算被收藏数
        $query5="select * from travelimagefavor where ImageID = ".$imageID;
        $like=$db->query($query5);
        $likeNumber=$like->num_rows;

        echo $imgArray["Title"];
        echo "</h1>";
        echo " <div class='image'>";
        echo " <img src='../../../img/normal/small/".$path."' alt='无法显示'>";
        echo "</div>";
        echo "<div class=\"message\">";
        echo "<div class=\"number list\">";
        echo "<h2>Like Number</h2>";
        echo " <div class=\"content\">".$likeNumber."</div>";
        echo "</div>";
        echo "<div class=\"contents list\">";
        echo "<h2>Image</h2>";
        echo "<div class=\"content bottom\"> Content:".$imgArray["Content"]."</div>";
        echo "<div class=\"content bottom\">Country:".$country["Country_RegionName"]."</div>";
        if($cityResult==null){
            $cityResult["AsciiName"]="null";
        }
        echo "<div class=\"content\">City:".$cityResult["AsciiName"]."</div>";
        echo "</div>";
        echo "<div class=\"list\">";
        echo "<h2>Author</h2>";
        echo "<div class=\"content\">".$userArray["UserName"]."</div>";
        echo "</div>";
        echo "<div class=\"input\">";
        if ($isCollect->num_rows==1){
            echo "<input type=\"button\" id='collect' value=\"Collected\"></div>";
        }else{
            echo "<input type=\"button\" id='collect' value='Collect' data-UID='".$UID."' data-ImageID='".$imageID."'></div>";
        }
        echo "</div>";
        echo "</div>";
        echo "<div class=\"description\"><p>".$imgArray["Description"]."</p>";
        echo "</div>";
        echo "</div>";}
        ?>
    <footer>
      Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
    </footer>
                <script src="../../JS/detail.js"></script>
</body>

</html>
