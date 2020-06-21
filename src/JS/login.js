var username=document.getElementById("username");
var mail=document.getElementById("mail");
var password=document.getElementById("password");
var repass=document.getElementById("repass");


               function checkUsername(){
                var reg = /^[a-zA-Z][\w]{5,9}$/;
                    var txtUsername= username.value;
                    if(!reg.test(txtUsername)){
                       alert("用户名必须6-10位，第一位为字母")
                        return false;
                    }
                    return true;
                }
                
                
                function checkPassword() {
                    var reg = /^[\d]{6,10}$/;
                    var txtPassword = password.value;
                    if(!reg.test(txtPassword)) {
                        alert('密码必须为6~10位数字');
                        return false;
                    }
                    return true;
                }
                function checkPasswordAgain(){
                    var txtPwd1 = password.value;
                    var txtPwd2 = repass.value;
                    if(txtPwd1!= txtPwd2){
                        alert("请保持两次输入的密码完全一致");
                        return false;
                    }
                    return true;
                }
                
                
                function checkEmail() {
                    var reg = /^[\w!#$%&'*+/=?^_`{|}~-]+(?:\.[\w!#$%&'*+/=?^_`{|}~-]+)*@(?:[\w](?:[\w-]*[\w])?\.)+[\w](?:[\w-]*[\w])?$/;
                    var txtEmail = mail.value;
                    if(!reg.test(txtEmail)) {
                        alert('请输入正确的邮箱地址');
                        return false;
                    }
                    return true;
                }
                    
                function checkAll() {
                    if(checkUsername()&&checkEmail()&&checkPassword()&&checkPasswordAgain()) {
                        return true;
                    }                
                    return false;
                }
    
