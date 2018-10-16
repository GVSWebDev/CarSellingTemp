$prevIndex = 6;
$currIndex = 1;
$nextIndex = 2;
$imagesAmount = 0;

var intervalID1;
var canChange = true;

window.onload = function(){
    $imagesAmount = $(".thumbnail").length;
    console.log($imagesAmount);
    $prevIndex = $imagesAmount;

    if ($imagesAmount < 2){
        $(".display-arrow").css("display", "none");
    }

    for (i = 0; i <= $imagesAmount; i++){
        ic = i + 1;
        console.log("loop starting");
        $(".thumbnail:eq("+i+")").addClass("index"+ic).attr("onclick", "updateIndex("+ic+", true)");
        console.log("loop done with index "+ ic);
    }

    $("#prevImg").attr("src", $(".index"+$prevIndex).attr("src"));
    $("#main-display").attr("src", $(".index"+$currIndex).attr("src"));
    $("#nextImg").attr("src", $(".index"+$nextIndex).attr("src"));
    $(".right-ready").css("transform", "translate("+$("#image-c").innerWidth()+"px, 0px)");
    $(".left-ready").css("transform", "translate(-"+$("#image-c").innerWidth()+"px, 0px)");
    $(".leave-right").css("transform", "translate("+$("#image-c").innerWidth()+"px, 0px)");
    $(".leave-left").css("transform", "translate(-"+$("#image-c").innerWidth()+"px, 0px)");
}

window.onresize = function(){
    updateTransform();
}

function nextRight(){
    if (canChange == true){
    if ($currIndex == $imagesAmount){
        $currIndex = 1;
    } else {
        $currIndex++;
    }
    $prevIndex = $currIndex - 1;
    $nextIndex = $currIndex + 1;
    if ($nextIndex == $imagesAmount + 1){
        $nextIndex = 1;
    }

    if($prevIndex == 0){
        $prevIndex = $imagesAmount;
    }
    updateClasses("left");
    updateIndex($currIndex);
}
}

function nextLeft(){
    if (canChange == true){
    if ($currIndex == 1){
        $currIndex = $imagesAmount;
    } else {
        $currIndex--;
    }
    $prevIndex = $currIndex - 1;
    $nextIndex = $currIndex + 1;
    if ($nextIndex == $imagesAmount + 1){
        $nextIndex = 1;
    }

    if($prevIndex == 0){
        $prevIndex = $imagesAmount;
    }
    console.log("prev index is " + $prevIndex);
    console.log("current index is" + $currIndex);
    console.log("next index is "+ $nextIndex);
    updateClasses("right");
    updateIndex($currIndex, false);
    
}
}

function updateClasses(direction){
    canChange = false;
    $(".blockifier").children().removeClass("notrans");
    $decider = '';
    if (direction == "right"){$decider = 'prev'} else {$decider = "next"}
    $("#"+$decider+"Img").addClass("showing");
    $("#main-display").addClass("leave-"+direction).removeClass("showing");
    updateTransform();
    intervalID1 = setInterval(waitForAnim, 700);
}

function updateTransform(){
    $(".right-ready").css("transform", "translate("+$("#image-c").innerWidth()+"px, 0px)");
    $(".left-ready").css("transform", "translate(-"+$("#image-c").innerWidth()+"px, 0px)");
    $(".leave-right").css("transform", "translate(-"+$("#image-c").innerWidth()+"px, 0px)");
    $(".leave-left").css("transform", "translate(-"+$("#image-c").innerWidth()+"px, 0px)");
}

function waitForAnim(){
    $("#prevImg").removeAttr('class').attr("class", 'notrans left-ready main-image');
    $("#main-display").removeAttr('class').attr("class", 'notrans showing main-image');
    $("#nextImg").removeAttr('class').attr("class", 'notrans right-ready main-image');
    updateImage()
    canChange = true;
    clearInterval(intervalID1);
}

function updateIndex(index, shouldUpImg){
    console.log("index normal é "+ index);
    $("#preview-c").children().removeClass("tab-selected");
    $(".thumbnail:eq("+(index - 1)+")").addClass("tab-selected");
    $currIndex = index;
    $prevIndex = $currIndex - 1;
    $nextIndex = $currIndex + 1;
    if ($nextIndex == $imagesAmount + 1){
        $nextIndex = 1;
    }

    if($prevIndex == 0){
        $prevIndex = $imagesAmount;
    }
    console.log("thumbnail clicked, index is now " + index);
    console.log("prev index is " + $prevIndex);
    console.log("current index is" + $currIndex);
    console.log("next index is "+ $nextIndex);
    if (shouldUpImg == true){
        updateImage();
    }
}

function updateImage(){
    $("#prevImg").attr("src", $(".index"+$prevIndex).attr("src"));
    $("#main-display").attr("src", $(".index"+$currIndex).attr("src"));
    $("#nextImg").attr("src", $(".index"+$nextIndex).attr("src"));
}