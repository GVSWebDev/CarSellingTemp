window.onload = function(){
    $("#map-canvas").attr("width", $(".contact-section").outerWidth());
    $("#map-canvas").attr("height", $(".contact-section").outerHeight());
}

window.onresize = function(){
    console.log("on resize called");
    $("#map-canvas").attr("width", $(".contact-section").outerWidth());
    $("#map-canvas").attr("height", $(".contact-section").outerHeight());
}