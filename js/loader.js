function removeLoader(){
    $(".loader-container").fadeOut(500, function() {
        $(".loader-container").remove();
    })
}
