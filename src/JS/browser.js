let currentPage=1;
let total=0;
let pageSize=16;
let totalPage=0;
let CityArray;
let url="../functionPHP/defaultSelect.php";
//country联动
$("#select2").on("change",function () {
    var value = this.options[this.selectedIndex].value;
    var replace2=document.getElementById("replace2");
    replace2.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
    if (this.selectedIndex!=0){
        var data=getCityData(this);
        console.log(data)
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

//返回特定国家信息
function getCityData(select) {
    $.ajaxSetup({async: false});
    var countryISO=$(select).find("option:selected").attr("data-ISO");
    $.post("../functionPHP/CitySelect.php",{
        limit:5,
        ISO:countryISO
    },function (data) {
        CityArray=data;
    })
    return CityArray;
}

//国家城市查询
$("#filter").on("click",function () {
    clearInput();
    url="../functionPHP/Filter.php";
    getData(1);
})
//热门国家查询
$(".country-a").on("click",function (){
    clearInput();
    clearSelect();
    url="../functionPHP/countryFilter.php";
    getData(1,this);

})
//热门城市查询
$(".city-a").on("click",function () {
    clearInput();
    clearSelect();
    url="../functionPHP/cityFilter.php";
    getData(1,this);
})
//热门主体查询
$(".title-a").on("click",function () {
    clearInput();
    clearSelect();
    url="../functionPHP/hotTitle.php";
    getData(1,this);
})
//输入查询
$(".icon").on("click",function () {
    clearSelect();
    url="../functionPHP/inputFilter.php";
    getData(1);
})



//select3
$("#select3").on("change",function () {
    if (this.selectedIndex!=0){
        var value = this.options[this.selectedIndex].value;
        var replace3=document.getElementById("replace3");
        replace3.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
    }})
//select1
$("#select1").on("change",function () {
    let value = this.options[this.selectedIndex].innerText;
    let replace1=document.getElementById("replace1");
    replace1.innerHTML = value + "<i class='iconfont icon-shangxia'></i>";
})
//获取查询信息，并分页
function getData(page,hot){
    $.ajaxSetup({async: false});
    var content=$("#select1").find("option:selected").val()=="Filter by content"?"null":$("#select1").find("option:selected").val();
    var country=$("#select2").find("option:selected").attr("data-ISO")==null?"null":$("#select2").find("option:selected").attr("data-ISO");
    var city=$("#select3").find("option:selected").attr("data-id")==null?0:parseInt($("#select3").find("option:selected").attr("data-id"));
    var hotcity=($(hot).attr("data-ID")==null)?"null":$(hot).attr("data-ID");
    var hotCountry=($(hot).attr("data-ISO")==null)?"null":$(hot).attr("data-ISO");
    var hotTitle=($(hot).attr("data-title")==null)?"null":$(hot).attr("data-title");
    var inputTitle=($("#title").val=="")?"null":$("#title").val();
    console.log(hotCountry)
    //$(location).attr("href","../functionPHP/countryFilter.php?hotCountry="+hotCountry+"&startIndex="+(page-1))
    $.post(url,{
        content:content,
        cityID:city,
        countryISO:country,
        startIndex: page-1,
        hotCity:hotcity,
        hotCountry:hotCountry,
        hotTitle:hotTitle,
        inputTitle:inputTitle,
        pageSize:pageSize
    },function (data) {
        total=data["total"];
        pageSize=data["pageSize"];
        totalPage=data["totalPage"];
        currentPage=page;
        console.log(data)
        if (totalPage==0){
            let tipSpan=$("<span>暂无相关图片，请浏览下面图片或重新筛选</span>");
            $(".helptips").empty();
            $(".helptips").append(tipSpan);
        }else {
            $(".helptips").empty();
            $(".img").empty();
            for (let i = 0; i < data["result"].length; i++) {
                if (data["result"][i]["PATH"]!=null){
                    let img = $("<div><img src='../../../img/normal/small/" + data["result"][i]["PATH"] + "' class='filterImg' data-path='" + data["result"][i]["PATH"] + "' data-title=\"" + data["result"][i]["Title"] + "\" data-description='" + data["result"][i]["Description"] + "'></div>");
                    $(".img").append(img);
                }
            }
            if (totalPage > 5) {
                totalPage = 5;
            }
            $(".link").empty();
            getPageBa(page);
        }
    })
}
//准备函数
$(function () {
    getData(1);
})

//清除select值
function clearSelect() {
    $(".defaultSelect").attr("selected","selected");
    $("#select2").trigger("change");
}

//清除input值
function clearInput() {
    $("#title").val("");
}