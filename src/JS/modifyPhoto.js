let cityCode;
let CityArray;
//country联动
$("#select2").on("change",function () {
    var value = this.options[this.selectedIndex].value;
    var replace2=document.getElementById("replace2");
    replace2.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
    if (this.selectedIndex!=0){
        var data=getCityData(this);
        if (data){
            $("#select3").empty();
            let firstOption=$("<option>Filter by city</option>");
            $("#select3").append(firstOption);
            for (let i=0;i<data.length;i++){
                let option=$("<option data-id='"+data[i]["GeoNameID"]+"'value='"+data[i]["AsciiName"]+"'>"+data[i]["AsciiName"]+"</option>");
                $("#select3").append(option);
            }
        }
    }
    else {
        $("#select3").empty();
        let firstOption=$("<option>Filter by city</option>");
        $("#select3").append(firstOption);
        var replace3=document.getElementById("replace3");
        replace3.innerHTML="Filter by city" +"<i class='iconfont icon-shangxia'></i>";
    }
})

//获取城市信息
function getCityData(select) {
    $.ajaxSetup({async: false});
    var countryISO=$(select).find("option:selected").attr("data-ISO");
    cityCode=$(select).find("option:selected").attr("data-cityCode");
    $.post("../functionPHP/CitySelect.php",{
        ISO:countryISO
    },function (data) {
        CityArray=data;
    })
    return CityArray;
}

$("#select3").on("change",function () {
    if (this.selectedIndex!=0){
        var value = this.options[this.selectedIndex].value;
        var replace3=document.getElementById("replace3");
        replace3.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
    }})
//点击上传修改后的图片信息
$("#Modify").on("click",function () {
    let content=$("#select1").find("option:selected").val();
    let title=$("#title").val();
    let des=$("#dp").val();
    let path=$("#modifyImage").attr("data-path");
    let city=$("#select3").find("option:selected").val();
    let cityID=parseInt($("#select3").find("option:selected").attr("data-id")==null?"0":$("#select3").find("option:selected").attr("data-id"));
    let country=$("#select2").find("option:selected").val();
    let countryID=$("#select2").find("option:selected").attr("data-ISO")==null?"0":$("#select2").find("option:selected").attr("data-ISO");
    if (title!=""&&des!=""&&city!="select city"&&country!="select country"&&content!="select content"&&path!=null){
        $.post("../functionPHP/modify_modifyPhoto.php",{
            Content:content,
            Title:title,
            Des:des,
            cityName:city,
            cityID:cityID,
            countryID:countryID,
            path:path
        },function () {
            alert("修改成功");
        })
    }
    else {
        alert("请填写完整信息");
    }
})
//准备函数
$(function () {
    var data=getCityData(document.getElementById("select2"));
    let content=$("#img img").attr("data-content");
    let select1=document.getElementById("select1");
    let replace1=document.getElementById("replace1");
    for (let i=0;i<select1.options.length;i++){
        if (select1.options[i].innerText==content){
            select1.options[i].selected=true;
        }
    }
    replace1.innerHTML=content+"<i class='iconfont icon-shangxia'></i>";
    if (data){
        $("#select3").empty();
        let firstOption=$("<option>Filter by city</option>");
        let option;
        $("#select3").append(firstOption);
        for (let i=0;i<data.length;i++){
            if (data[i]["GeoNameID"]==cityCode){
                option=$("<option selected data-id='"+data[i]["GeoNameID"]+"'value='"+data[i]["AsciiName"]+"'>"+data[i]["AsciiName"]+"</option>");
                document.getElementById("replace3").innerHTML=data[i]["AsciiName"]+"<i class='iconfont icon-shangxia'></i>";
            }else {
                option = $("<option data-id='" + data[i]["GeoNameID"] + "'value='" + data[i]["AsciiName"] + "'>" + data[i]["AsciiName"] + "</option>");
            }
            $("#select3").append(option);
        }
    }
})