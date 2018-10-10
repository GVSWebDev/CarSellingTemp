function setForm(i){
    if ($("#"+i+"-c").hasClass("form-active")){
        $("#proposal-block").children().removeClass("prop-open");
        $("#proposal-block").find(".prop-c").removeClass("form-active");
        $("#"+i+"-button").find(".side-color").css("width", "0px");
    } else {
    $("#proposal-block").children().removeClass("prop-open");
    $("#proposal-block").find(".side-color").css("width", "0px");
    $("#"+i+"-button").addClass("prop-open");
    $("#"+i+"-button").find(".side-color").css("width", "4px");
    $("#proposal-block").find(".prop-c").removeClass("form-active");
    $("#"+i+"-c").addClass("form-active");
    }
   
}

function setTab(index){
    $("#tabs-c").children().removeClass("tab-show");
    $("#"+index).addClass("tab-show");
    console.log(index);
}

function setContent(cont){
    $(".about-content").css("display", "none");
    $("#"+cont).css("display", "flex");
}
