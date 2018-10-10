var SPMaskBehavior = function (val) {
  return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
},

spOptions = {
  onKeyPress: function(val, e, field, options) {
      field.mask(SPMaskBehavior.apply({}, arguments), options);
    }
};
$(document).ready(function(){
  $("[name='telefone']").mask(SPMaskBehavior, spOptions);
  });

$("form").submit(function(event) {
    $activeForm = $("#proposal-block").find('.form-active').find('form').serializeArray();
    $name = $activeForm[0]["value"];
    $tel = $activeForm[1]["value"];
    $email = $activeForm[2]["value"];
    $msg = $activeForm[3]["value"];
    for (i = 0; i <= 3; i++){
      if($activeForm[i]["value"] === '' || $activeForm[i]["value"].length < 3){
        emptyField(i);
        
      }
    }
  
    if($email.indexOf('@') == -1 || $email.indexOf('.') == -1){
      if(!$("#proposal-block").find('.form-active').find('#email-error').length){
        $("#proposal-block").find('.form-active').find("[name='"+$activeForm[2]["name"]+"']").before("<span id='email-error' class='error'>Digite um email válido</span>");
    }
  } else {
    $("#proposal-block").find('.form-active').find('#email-error').remove();
  }
    event.preventDefault();
  });

  function emptyField(index){
    $("#proposal-block").find('.form-active').find("[name='"+$activeForm[index]["name"]+"']").removeAttr("style");
    setTimeout(function(){
      $("#proposal-block").find('.form-active').find("[name='"+$activeForm[index]["name"]+"']").css("animation-name", "blink-red");
   },1
 );
    return false;
  }

