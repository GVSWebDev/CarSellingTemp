window.onscroll = function(){
    if($(document).scrollTop() > $("#navbar").outerHeight() && $(document).scrollTop() <= $("#navbar").outerHeight() + $("#wrapper").outerHeight() - ($("#price-block").outerHeight() + $("#proposal-block").outerHeight()) - 20){
        $final = $(document).scrollTop() - $("#navbar").outerHeight();
        $("#buy-section").css("margin-top", $final+"px");
    } else if ($(document).scrollTop() < $("#navbar").outerHeight()){
        $("#buy-section").css("margin-top", "0px");
    }
    
    if ($(document).scrollTop() >= $("#navbar").outerHeight() + $("#wrapper").outerHeight() - ($("#price-block").outerHeight() + $("#proposal-block").outerHeight()) - 20){
        $finalbot = ($("#wrapper").outerHeight() - ($("#price-block").outerHeight() + $("#proposal-block").outerHeight()) - 22);
        $("#buy-section").css("margin-top", $finalbot+"px");
    }
}