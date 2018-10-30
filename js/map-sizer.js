function loadMap(){
    $("#map-canvas").attr("width", $(".contact-section").outerWidth());
    $("#map-canvas").attr("height", $(".contact-section").outerHeight());
}

function resizeMap(){
    console.log("on resize called");
    $("#map-canvas").attr("width", $(".contact-section").outerWidth());
    $("#map-canvas").attr("height", $(".contact-section").outerHeight());
}