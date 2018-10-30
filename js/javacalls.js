window.onload = function(){
    gatherSlideImages();
    loadMap();
}

window.onresize = function(){
    resizeMap();
    updateTransform();
}