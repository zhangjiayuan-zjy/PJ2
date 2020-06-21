let totalPage=0;
let total=0;
let currentPage=1;
let pageSize=5;
let url="../functionPHP/defaultSelect.php";
//根据radio选中值判断查询类型
$("#filter").on("click",function () {
    var radioValue=$("input:radio:checked").val();
    if (radioValue=="title"){
        url="../functionPHP/inputFilter.php";
    }else {
        url="../functionPHP/desFilter_search.php";
    }
    getData(1);
})

//radio事件
$("input:radio[name=filter]").on("change",function () {
    var radioValue=$("input:radio:checked").val();
    if (radioValue=="title"){
        $("#desInput").val("");
        $("#desInput").attr("disabled","disabled");
        $("#titleInput").removeAttr("disabled");
    }else {
        $("#titleInput").val("");
        $("#titleInput").attr("disabled","disabled");
        $("#desInput").removeAttr("disabled")
    }

})

function getData(page){
    $.ajaxSetup({async: false});
    var inputTitle=($("#titleInput").val()=="")?"null":$("#titleInput").val();
    var inputDes=($("#desInput").val()=="")?"null":$("#desInput").val();
    console.log(inputDes);
    $.post(url,{
        inputDes:inputDes,
        inputTitle:inputTitle,
        pageSize:pageSize,
        startIndex: page-1
    },function (data) {
        total=data["total"];
        pageSize=data["pageSize"];
        totalPage=data["totalPage"];
        currentPage=page;
        console.log()
        if (totalPage==0){
            let tipSpan=$("<span>暂无相关图片，请浏览下面图片或重新筛选</span>");
            $(".helptips").empty();
            $(".helptips").append(tipSpan);
        }else {
            $(".imgResult").empty();
            for (let i = 0; i < data["result"].length; i++) {
                let div = $("<div class='detail'><div class='image'><a><img src='../../../img/normal/small/" + data["result"][i]["PATH"] + "' class='filterImg' data-path='" + data["result"][i]["PATH"] + "' data-title='" + data["result"][i]["Title"] + "' data-description='" + data["result"][i]["Description"] + "'></a></div><div class='dp'><h2>"+data["result"][i]["Title"]+"</h2><div class='imagedp'><p>"+data["result"][i]["Description"]+"</p></div></div></div>");
                $(".imgResult").append(div);
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
    console.log("11")
    getData(1);
})
