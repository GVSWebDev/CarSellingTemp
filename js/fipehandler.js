var marcaid;
var modelid;

$(document).ready(function(){
    $("#fipe-select-brand").change(function(){
        marcaid = $("#fipe-select-brand").find(":selected").attr("value");
        window.location.replace("fipe.php?m="+marcaid);
    });

    $("#fipe-select-model").change(function(){
        marcaid = $("#fipe-select-brand").find(":selected").attr("value");
        modelid = $("#fipe-select-model").find(":selected").attr("value");
        window.location.replace("fipe.php?m="+marcaid+"&mo="+modelid);
    });
});