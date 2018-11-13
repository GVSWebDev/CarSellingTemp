window.onload = function(){
    gatherSlideImages();
    loadMap();
    removeLoader();
    
}

window.onresize = function(){
    resizeMap();
    updateTransform();
}