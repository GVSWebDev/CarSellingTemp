window.onscroll = function(){
    if($(document).scrollTop() > 95){
        $final = $(document).scrollTop() - 80;
        $("#buy-section").css("margin-top", $final+"px");
    } else {
        $("#buy-section").css("margin-top", "0px");
    }
}