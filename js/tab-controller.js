function setTab(index){
    $("#tabs-c").children().removeClass("tab-show");
    $("#"+index).addClass("tab-show");
    console.log(index);
}

function setContent(cont){
    $(".about-content").css("display", "none");
    $("#"+cont).css("display", "block");
}