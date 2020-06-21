<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browser</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../../fonts/font1/iconfont.css">
    <link rel="stylesheet" href="../../css/browser.css">
    <link rel="stylesheet" href="../../css/footer2.css">
    <script src="../../JS/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" type="text/less" href="../../css/nav.less">
    <script src="../../css/less.min.js"></script>
</head>

<body>
<!--导航栏 -->
<nav class="clear" id="top">
    <ul class="nav">
        <li><a href="../../../index.php">Home</a></li>
        <li class="selected"><a>Browser</a></li>
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
                echo "<li><a href=\"../functionPHP/logout.php\"><i class=\"iconfont icon--dengru\"></i>Log out</a></li>";
                echo " </ul>";
            } else{
                echo "<a href='./login.php'>LOGIN</a>";
            }
            ?>
        </li>
    </ul>
</nav>


<div class="main clear">
    <!-- 左边栏浏览热门国家，城市 -->
    <div class="leftside">
        <div class="search">
            <div class="tip">search by title</div>
            <div class="texticon"><input type="text" id="title" name="search" value="">
                <div class="icon"><i class="iconfont icon-sousuo"></i></div>
            </div>
        </div>
        <div class="hotcountry">
            <div class="tip">Hot country</div>
            <ul class="hot">
                <?php
                require_once("../config.php");
                $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
                if (mysqli_connect_errno()){
                    echo '<p>Do not connect the database please try again later</p>';
                    exit;
                }
                //从数据库查询热门国家
                /*$query0="select * from geocountries_regions order by rand() limit 5";
                $countries=$db->query($query0);
                $countryResult=$countries->fetch_all(MYSQLI_ASSOC);*/
                //查询热门城市
                /*$query1="select * from geocities order by rand() limit 5";
                $cities=$db->query($query1);*/
                //查询国家
                $query2="select * from geocountries_regions order by Population DESC limit 20";
                $allCountry=$db->query($query2);
                $allResult=$allCountry->fetch_all(MYSQLI_ASSOC);
                //查询热门标题
                $query4="select * from travelimage order by rand() limit 5";
                $title=$db->query($query4);
                //输出热门国家
                echo "<li><a class='country-a' data-ISO='CA'>Canada</a></li>";
                echo "<li><a class='country-a' data-ISO='GB'>United Kingdom</a></li>";
                echo "<li><a class='country-a' data-ISO='DE'>Germany</a></li>";
                echo "<li><a class='country-a' data-ISO='ES'>Spain</a></li>";
                echo "<li><a class='country-a' data-ISO='GR'>Greece</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "<div class=\"hotcountry\">";
                //输出热门主体
                echo "<div class=\"tip\">Hot Title</div>";
                echo "<ul class=\"hot\">";
                while ($row=$title->fetch_assoc()){
                    echo "<li><a class='title-a' data-title=\"".$row["Title"]."\">".$row["Title"]."</a></li>";
                }
                echo "</ul>";
                echo "</div>";
                echo "<div class=\"hotcountry\">";
                echo "<div class=\"tip\">Hot City</div>";
                echo "<ul class=\"hot\">";
                //输出热门城市
                /*while ($row=$cities->fetch_assoc()){
                    echo "<li><a class='city-a' data-ID='".$row["GeoNameID"]."'>".$row["AsciiName"]."</a></li>";
                }*/
                echo "<li><a class='city-a' data-ID='5913490'>Calgary</a></li>";
                echo "<li><a class='city-a' data-ID='5892532'>Banff</a></li>";
                echo "<li><a class='city-a' data-ID='2643743'>London</a></li>";
                echo "<li><a class='city-a' data-ID='6062069'>Lunenburg</a></li>";
                echo "<li><a class='city-a' data-ID='2302357'>Cape Coast</a></li>";
                echo "</ul>";
                echo "</div>";
                echo "</div>";
                echo " <div class=\"rightside\">";
                echo "<div class=\"title\">Filter</div>";
                echo " <div class=\"filter clear\">";
                echo "<div class=\"select\">";
                echo "<select name=\"\" id=\"select1\">";?>
                <option value="Filter by content" class="defaultSelect">Filter by content</option>";
                <option value="scenery">scenery</option>
                <option value="city">city</option>
                <option value="people">people</option>
                <option value="animal">animal</option>
                <option value="building">building</option>
                <option value="wonder">wonder</option>
                <option value="other">other</option>
                <?php
                echo "</select>";
                echo "<div class=\"replace\" id=\"replace1\">Filter by scenery<i class=\"iconfont icon-shangxia\"></i></div>";
                echo "</div>";
                echo "<div class=\"select\">";
                echo "<select name=\"\" id=\"select2\">";
                echo "<option class='defaultSelect'>Filter by country</option>";
                echo "<option value='Canada' data-ISO='CA'>Canada</option>";
                for ($i=0;$i<count($allResult);$i++){
                    echo "<option value='".$allResult[$i]["Country_RegionName"]."' data-ISO='".$allResult[$i]["ISO"]."'>".$allResult[$i]["Country_RegionName"]."</option>";
                }
                echo "</select>";
                echo "<div class=\"replace\" id=\"replace2\">Filter by country<i class=\"iconfont icon-shangxia\"></i></div>";
                echo "</div>";
                echo "<div class=\"select\">";
                echo " <select name=\"\" id=\"select3\">";
                echo "<option value=\"Filter by city\">Filter by city</option>";
                echo "</select>";
                echo "<div class=\"replace\" id=\"replace3\">Filter by city<i class=\"iconfont icon-shangxia\"></i></div>";
                echo "</div>";
                echo " <input type=\"button\" value=\"Filter\" id='filter'>";
                echo "</div>";
                ?>
        <!-- 筛选图片 -->
        <div class="helptips" style="width: 100%;
    text-align: center">
        </div>
        <div class="img clear">
        </div>
        <!-- 页码 -->
        <div class="link">
        </div>
    </div>
</div>
<!-- 页脚 -->
<footer class="footer">
    Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>
    <script src="../../JS/page.js"></script>
    <script src="../../JS/browser.js"></script>
</body>


