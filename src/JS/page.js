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
    console.log(index);
    if (index==0){
        index=1;
    }
    else if (index==(totalPage+1)){
        index=totalPage;
    }
    getData(index);
})
//图片详情页
$(".main").on("click",function (event) {
    if ($(event.target).attr("data-path")){
        var Title=$(event.target).attr("data-title");
        var Description=$(event.target).attr("data-description");
        var Path=$(event.target).attr("data-path");
        $(location).attr("href","detail.php?Title="+Title+"&Description="+Description+"&PATH="+Path);
    }
})