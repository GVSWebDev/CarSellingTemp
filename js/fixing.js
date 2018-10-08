window.onscroll = function(){
    if($(document).scrollTop() > $("#navbar").outerHeight()){
        $final = $(document).scrollTop() - $("#navbar").outerHeight();
        $("#buy-section").css("margin-top", $final+"px");
    } else {
        $("#buy-section").css("margin-top", "0px");
    }
}