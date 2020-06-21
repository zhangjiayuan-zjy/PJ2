
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
        <div id="imgPreview">
            <div class="contain">
                <div class="img" id="img">
                    <?php
                    $path=$_GET["path"];
                    $title=$_GET["title"];
                    $des=$_GET["des"];
                    require_once("../config.php");
                    //根据已知信息查询图片完整信息
                    $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
                    $query3="select * from travelimage where PATH = '".$path."'";
                    $result=$db->query($query3);
                    $imgMessage=$result->fetch_assoc();
                    echo "<img src='../../../img/normal/small/".$path."' data-path ='".$path."' id='modifyImage' data-title='".$title."' data-des='".$des."' data-content='".$imgMessage["Content"]."'>"
                    ?>
                </div>
                <div class="contains">
                    <div id="prompt3">
                        <input type="file" id="file" class="filepath">
                        <input type="button" name="#" value="Upload" id="button">
                    </div>
                </div>

            </div>
        </div>
        <!-- 填充图片信息栏 -->
        <label for="select1">Content:</label>
        <div class="item select">
            <select id="select1">
                <option>select content</option>
                <option>scenery</option>
                <option>city</option>
                <option>people</option>
                <option>animal</option>
                <option>building</option>
                <option>wonder</option>
                <option>other</option>
            </select>
            <div class="replace" id="replace1">scenery<i class="iconfont icon-shangxia"></i></div>
        </div>
        <label for="select2">Country:</label>
        <div class="item select">
            <select id="select2" name="select2">
                <option>select country</option>
                <?php
                //查询并输出所有国家
                $query2="select * from geocountries_regions order by Population DESC";
                $allCountry=$db->query($query2);
                $allResult=$allCountry->fetch_all(MYSQLI_ASSOC);
                $countryName="";
                for ($i=0;$i<count($allResult);$i++){
                    if ($allResult[$i]["ISO"]==$imgMessage["Country_RegionCodeISO"]){
                        $countryName=$allResult[$i]["Country_RegionName"];
                        echo "<option selected value='".$allResult[$i]["Country_RegionName"]."' data-ISO='".$allResult[$i]["ISO"]."' data-cityCode='".$imgMessage["CityCode"]."'>".$allResult[$i]["Country_RegionName"]."</option>";
                    }else {
                        echo "<option value='". $allResult[$i]["Country_RegionName"] . "' data-ISO='" . $allResult[$i]["ISO"] . "'>" . $allResult[$i]["Country_RegionName"] . "</option>";
                    }
                }
                ?>
            </select>
            <div class="replace" id="replace2"><?php echo $countryName;?><i class="iconfont icon-shangxia"></i></div>
        </div>
        <label for="select3">City:</label>
        <div class="item select">
            <select id="select3">
                <option>select city</option>
            </select>
            <div class="replace" id="replace3">select city<i class="iconfont icon-shangxia"></i></div>
        </div>
        <div class="item">
            <div class="head">Title</div>
            <?php
            echo "<input type='text' class='text' id='title' value='".$title."'>"
            ?>
        </div>
        <div class="item">
            <div class="head">Description</div>
            <?php
            echo " <textarea id='dp'>".$des."</textarea>"
            ?>
        </div>
        <input type="button" id="Modify" value="Modify">
    </div>
</div>
<footer>
    Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>
</body>
<script src="../../JS/modifyPhoto.js"></script>
</html>

