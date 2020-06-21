//点击判断，若为收藏则收藏
$("body").on("click",function (event) {
    var value=$(event.target).val();
    if (value=="Collect"){
        $.post("../functionPHP/collect.php",{
            ImageID:parseInt($(event.target).attr("data-ImageID"))
        },function () {
            alert("成功收藏");
            $(event.target).val("Collected");
        })
    }else if (value=="Collected") {
        $.post("../functionPHP/deletePhoto.php",{
            ImageID: parseInt($(event.target).attr("data-ImageID")),
            table:"travelimagefavor"
        },function () {
            alert("已经取消收藏");
            $(event.target).val("Collect");
        })
    }})