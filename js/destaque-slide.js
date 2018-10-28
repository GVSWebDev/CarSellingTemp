function scrollToRight(){
    console.log($(".rec-item").outerWidth(true));
    var curPos = $('#destaque-container').scrollLeft();
        $('#destaque-container').animate({scrollLeft: curPos + $(".rec-item").outerWidth(true)}, 500);
}

function scrollToLeft(){
    var curPos = $('#destaque-container').scrollLeft();
        $('#destaque-container').animate({scrollLeft: curPos - $(".rec-item").outerWidth(true)}, 500);
}