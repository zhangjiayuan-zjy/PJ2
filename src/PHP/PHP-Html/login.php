<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/login.css">
    <link rel="stylesheet" href="../../css/footer.css">
</head>

<body>
<div class="main">
    <h2>登录</h2>
    <span class="span">
        <?php
session_start();
//判断表单是否提交
if (isset($_GET["submit"])){
    require_once('../config.php');
    $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
    if (mysqli_connect_errno()){
        echo '<p>Do not connect the database please try again later</p>';
        exit;
    }
    $use=$_GET['username'];
    $pass=$_GET['password'];
    //根据表单数据查询用户
    $query="select * from traveluser where Username=?";
    $stmt0=$db->prepare($query);
    $stmt0->bind_param("s",$use);
    $stmt0->execute();
    $result=$stmt0->get_result();
    if ($result->num_rows==0){
        echo "用户不存在，请重新输入";
        $db->close();
    }else{
        $row=$result->fetch_assoc();
        if ($row["Pass"]==null){
            if(password_verify($pass,$row["HashPassword"])){
                $db->close();
                $_SESSION["UID"]=$row["UID"];
                $_SESSION["username"]=$use;
                header("location:../../../index.php");
            }else{
                echo "密码错误，请重新输入";
                $db->close();
            }
        }else {
            if ($row["Pass"]==$pass){
                $db->close();
                $_SESSION["UID"]=$row["UID"];
                $_SESSION["username"]=$use;
                header("location:../../../index.php");
            }else{
                echo "密码错误，请重新输入";
                $db->close();
            }
        }
    }
}
else{
    echo "请输入账号密码登录";
}
?>
    </span>
    <form action="login.php" method="GET">
        <div class="inputs">
            <input type="text" name="username" value="" required>
            <label for="">用户名</label>
        </div>
        <div class="inputs">
            <input type="password" name="password" value="" required>
            <label for="">密码</label>
        </div>
        <input type="submit" name="submit" value="LOGIN" id="submit">
    </form>
</div>
<div class="register">
    还没有账户？
    <a href="signin.php">点击注册
    </a>
    <!-- 跳转注册页面 -->
</div>
<footer>
    Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>

</body>

</html>
<?php

