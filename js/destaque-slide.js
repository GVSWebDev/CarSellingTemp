var intervalID3 = setInterval(scrollDecide, 11500);
var direction = 0;
var lastPos = 0;

function scrollDecide(){
    if(lastPos == $('#destaque-container').scrollLeft()){
        direction = 1
    }
    if(lastPos == 0){
        direction = 0
    }
    if (direction == 0){
        scrollToRight();
    } else {
        scrollToLeft();
    }
}

function scrollToRight(){
    var curPos = $('#destaque-container').scrollLeft();
        $('#destaque-container').animate({scrollLeft: curPos + 2 + $(".rec-item").outerWidth(true)}, 500);
        lastPos = $('#destaque-container').scrollLeft();
}

function scrollToLeft(){
    var curPos = $('#destaque-container').scrollLeft();
        $('#destaque-container').animate({scrollLeft: curPos - 2 - $(".rec-item").outerWidth(true)}, 500);
        lastPos = $('#destaque-container').scrollLeft();
}