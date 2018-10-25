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
        }
    })
    } else {
        console.log("MENOR QUE 3 "+ $str);
        $("#searchbox-results").remove();
    }

}