var intervalID3 = setInterval(scrollDecide, 11500);
var intervalID4;
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
        scrollToRight(false);
    } else {
        scrollToLeft(false);
    }
}

function bringAutoScrollBack(){
    intervalID3 = setInterval(scrollDecide, 11500);
    clearInterval(intervalID4);
}

function scrollToRight(byUserClick){
    if (byUserClick == true){
        clearInterval(intervalID3);
        clearInterval(intervalID4);
        intervalID4 = setInterval(bringAutoScrollBack, 10000);
    }
    var curPos = $('#destaque-container').scrollLeft();
        $('#destaque-container').animate({scrollLeft: curPos + 2 + $(".rec-item").outerWidth(true)}, 500);
        lastPos = $('#destaque-container').scrollLeft();
}

function scrollToLeft(byUserClick){
    if (byUserClick == true){
        clearInterval(intervalID3);
        clearInterval(intervalID4);
        intervalID4 = setInterval(bringAutoScrollBack, 10000);
    }
    var curPos = $('#destaque-container').scrollLeft();
        $('#destaque-container').animate({scrollLeft: curPos - 2 - $(".rec-item").outerWidth(true)}, 500);
        lastPos = $('#destaque-container').scrollLeft();
}