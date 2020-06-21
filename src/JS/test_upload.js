function checkFile() {
    let value=$("#file").val();
    if (value==""){
        alert("请选择文件");
        return false;
    }
return true;
}
function checkContent() {
    let value=$("#select1").find("option:selected").text();
    if (value=="select content"){
        alert("请选择内容类型");
        return false;
    }
return true;
}
function checkCountry() {
let value=$("#select2").find("option:selected").text();
if (value=="select country"){
    alert("请选择国家");
    return false;
}
return true;
}
function checkCity() {
    let value=$("#select3").find("option:selected").text();
    if (value=="select city"){
        alert("请选择城市");
        return false;
    }
    return true;
}
function checkTitle() {
    let value=$("#title").val();
    if (value==""){
        alert("请输入主题");
        return false;
    }
return true;
}
function checkDes() {
    let value=$("#dp").val();
    if (value==""){
        alert("请输入描述");
        return false;
    }
return true;
}
function checkAll() {
    if (checkFile()&&checkContent()&&checkCountry()&&checkCity()&&checkTitle()&&checkDes()){
        return true;
    }
return false;
}