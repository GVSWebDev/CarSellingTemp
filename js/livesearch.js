var liveIsActive = false;

function getStr($str){
    $str = $str.replace(/[^a-z0-9\s]/gi, '');
    if ($str.length >= 3){
        console.log("Buscando por: "+$str);
        $.ajax({url: "livesearch.php?q="+$str,
        success: function(result){
            console.log("AJAX foi completo! Retornado: "+ result);
            if ($("#searchbox-results").length){
                $("#searchbox-results").remove();
            }
            $("#searchbox-c").append(result);
            if ($("#searchbox-results").length){
                liveIsActive = true;
            }
        }
    })
    } else {
        console.log("MENOR QUE 3 "+ $str);
        $("#searchbox-results").remove();
        liveIsActive = false;
    }

}

$(document).on('focus', '.searchbox-resitem', function(){
    $(this).addClass("search-selected");
    
});

$(document).on('focusout', '.searchbox-resitem', function(){
    $(this).removeClass("search-selected");
    
});


$(function() {
    $("body").click(function(e) {
    if(liveIsActive == true){
      if (e.target.id != "searchbox-input") {
        $("#searchbox-results").remove();
        liveIsActive = false;
      }
    }
    });
  });
