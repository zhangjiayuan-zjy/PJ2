<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/signin.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <script src="../../JS/test_signin.js"></script>
</head>

<body>
<div class="signin ">
    <h2>注册</h2>
    <span class="span">
<?php
//判断表单是否提交
if (isset($_GET["submit"])){
    require_once('../config.php');
    $db=new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
    if (mysqli_connect_errno()){
        echo '<p>Do not connect the database please try again later</p>';
        exit;
    }
    $use=$_GET['username'];
    $mail=$_GET['mail'];
    $pass=password_hash($_GET['password1'],PASSWORD_DEFAULT);
    //判断用户名是否已经被注册
    $query0="select username from traveluser where Username = ?";
    $stmt0=$db->prepare($query0);
    $stmt0->bind_param('s',$use);
    $stmt0->execute();
    $result=$stmt0->get_result();
    if ($result->num_rows>0){
        echo "用户名已经被注册，点击重新输入";
    }else{
        $stmt0=null;
        $query="insert into traveluser (Username,Email,HashPassword) values (?,?,?)";
        $stmt=$db->prepare($query);
        $stmt->bind_param('sss',$use,$mail,$pass);
        $stmt->execute();
        if ($stmt->affected_rows==1){
            $db->close();
            header("location:./login.php");
        }
        else{
            $db->close();
            echo "<a onclick='window.history.go(-1)'>点击回到注册</a>";
        }
    }
}else{
    echo "请按照要求输入信息";
}
?>
        </span>
    <form action="signup.php" method="GET" onsubmit="return checkAll()">
        <div class="input">
            <input type="text" required name="username" id="username">
            <label>用户名</label>
        </div>
        <div class="input">
            <input type="text" required name="mail" value="" id="mail">
            <label>邮箱</label>
        </div>
        <div class="input">
            <input type="password" required  name="password1" value="" id="password">
            <label for="">密码</label>
        </div>
        <div class="input">
            <input type="password" required name="password2" value="" id="repass">
            <label for="">确认密码</label>
        </div>
        <input type="submit" name="submit" value="确认" class="input">
        <!-- 点击后跳转到登录页面 -->
    </form>
</div>
<footer class="clearfix">
    Copyright &copy; 2019-2021 Web Fundamental All Rights Reversed 备案号：19302010044
</footer>
</body>

</html>
