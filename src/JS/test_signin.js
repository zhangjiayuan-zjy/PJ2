//在客户端对输入信息进行初步判断
function checkUsername() {
    var reg = /^[a-zA-Z][\w]{5,9}$/;
    var txtUsername= document.getElementById("username").value;
    if(!reg.test(txtUsername)){
        document.querySelector(".span").innerHTML='用户名必须为6-10位且第一位是字母';
        return false;
    }
    return true;
}


function checkPassword() {
    var reg = /^[\S]{6,10}$/;
    var txtPassword =document.getElementById("password").value;
    if (!reg.test(txtPassword)) {
        document.querySelector(".span").innerHTML='密码必须为6~10位';
        return false;
    }
    return true;
}
function checkPasswordAgain() {
    var txtPwd1 =document.getElementById("password").value;
    var txtPwd2 = document.getElementById("repass").value;
    if (txtPwd1 != txtPwd2) {
        document.querySelector(".span").innerHTML='请保持两次输入的密码完全一致';
        return false;
    }
    return true;
}


function checkEmail() {
    var reg = /^[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/;
    var txtEmail = document.getElementById("mail").value;
    if (!reg.test(txtEmail)) {
        document.querySelector(".span").innerHTML='请输入正确的邮箱地址';
        return false;
    }
    return true;
}

function checkAll() {
    if (checkUsername() && checkEmail() && checkPassword() && checkPasswordAgain()) {
        return true;
    }
    return false;
}
