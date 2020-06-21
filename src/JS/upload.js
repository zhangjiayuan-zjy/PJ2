var imgPreview = document.getElementById("imgPreview");
var file = document.getElementById("file");
var imgs = document.getElementById("img");
var p = document.getElementById("p");
let path=null;
let wholePath=null;
let cityArray;
//选择图片后展示
file.onchange = function() {
    var fr = new FileReader();
    fr.readAsDataURL(this.files[0]);
    var name=$("#file").val();
    wholePath=name;
    path=name.substr(name.lastIndexOf("\\")+1);
    fr.onload = function() {
        var img = document.createElement("img");
        img.src = fr.result;
        imgs.appendChild(img);
        p.style.display = "none";
    }
}
$("#select1").on("change",function () {
    let value = this.options[this.selectedIndex].innerText;
    let replace1=document.getElementById("replace1");
    replace1.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
})
//country联动
$("#select2").on("change",function () {
    var value = this.options[this.selectedIndex].innerText;
    var replace2=document.getElementById("replace2");
    replace2.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
    if (this.selectedIndex!=0){
        var data=getCityData(this);
        if (data){
            $("#select3").empty();
            let firstOption=$("<option>select city</option>");
            $("#select3").append(firstOption);
            for (let i=0;i<data.length;i++){
                let option=$("<option data-id='"+data[i]["GeoNameID"]+"' value='"+data[i]["GeoNameID"]+"'>"+data[i]["AsciiName"]+"</option>");
                $("#select3").append(option);
            }
        }
    }
    else {
        $("#select3").empty();
        let firstOption=$("<option>select city</option>");
        $("#select3").append(firstOption);
        var replace3=document.getElementById("replace3");
        replace3.innerHTML="select city" +"<i class='iconfont icon-shangxia'></i>";
    }
})

//获取相应国家的城市信息
function getCityData(select) {
    $.ajaxSetup({async: false});
    var countryISO=$(select).find("option:selected").attr("data-ISO");
    $.post("../functionPHP/CitySelect.php",{
        ISO:countryISO
    },function (data) {
        CityArray=data;
    })
    return CityArray;
}

$("#select3").on("change",function () {
    if (this.selectedIndex!=0){
        var value = this.options[this.selectedIndex].innerText;
        var replace3=document.getElementById("replace3");
        replace3.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
    }})