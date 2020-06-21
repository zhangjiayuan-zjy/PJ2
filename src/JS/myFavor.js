let totalPage=0;
let total=0;
let currentPage=1;
let pageSize=5;
//获取用户的收藏图片数据
function getData(page){
    $.ajaxSetup({async: false});
    $.post("../functionPHP/favorimg_myFavor.php",{
        pageSize:pageSize,
        startIndex: page-1
    },function (data) {
        total=data["total"];
        pageSize=data["pageSize"];
        totalPage=data["totalPage"];
        currentPage=page;
        if (totalPage==0){
            let tipSpan=$("<span>您还没有收藏图片</span>");
            $(".helptips").empty();
            $(".helptips").append(tipSpan);
        }else {
            $(".main").empty();
            for (let i = 0; i < data["result"].length; i++) {
                let div = $("<div class='detail'><div class='image'><a><img src='../../../img/normal/small/" + data["result"][i]["PATH"] + "' class='filterImg' data-path='" + data["result"][i]["PATH"] + "' data-title='" + data["result"][i]["Title"] + "' data-description='" + data["result"][i]["Description"] + "' data-ID='"+data["result"][i]["ImageID"]+"'></a></div><div class='dp'><h2>"+data["result"][i]["Title"]+"</h2><div class='imagedp'><p>"+data["result"][i]["Description"]+"</p></div><div class='input'><input type='button' class='delete' value='delete'></div></div></div>");
                $(".main").append(div);
            }
            if (totalPage > 5) {
                totalPage = 5;
            }
            $(".link").empty();
            getPageBa(page);
        }
        console.log(data)
    })
}

//返回页码
function getPageBa(page){
    var previous=$("<a class='change' data-index='"+(page-1)+"'><</a>");
    var next=$("<a class='change' data-index='"+(page+1)+"'>></a>");
    $(".link").append(previous);
    for (let i=1;i<=totalPage;i++){
        if (page==i){
            var pages=$("<a class='selected change' data-index='"+i+"'>"+i+"</a>");
        }
        else {
            var pages=$("<a class='change' data-index='"+i+"'>"+i+"</a>");
        }
        $(".link").append(pages);
    }
    $(".link").append(next);
}
//实现页码跳转功能
$(".link").on("click",function (event) {
    var index= parseInt(event.target.getAttribute("data-index"));
    if (index==0){
        index=1;
    }
    else if (index==(totalPage+1)){
        index=totalPage;
    }
    getData(index);
})

//准备函数
$(function () {
    getData(1)
})
//根据点击位置执行相应的效果
$(".main").on("click",function (event) {
    if ($(event.target).attr("data-path")){
        var Title=$(event.target).attr("data-title");
        var Description=$(event.target).attr("data-description");
        var Path=$(event.target).attr("data-path");
        $(location).attr("href","detail.php?Title="+Title+"&Description="+Description+"&PATH="+Path);
    }else if ($(event.target).val()=="delete"){
        let detail=$(event.target).parents(".detail");
        let img=$(event.target).parents(".detail").find(".image a img");
        $(detail).remove();
        $.post("../functionPHP/deletePhoto.php",{
            table:"travelimagefavor",
            ImageID:parseInt(img.attr("data-ID"))
        },function () {
            alert("删除成功");
        })
    }
})