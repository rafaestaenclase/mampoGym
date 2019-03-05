$("button[type='submit']").prop('disabled', true);
if ($("input[name='premio']").val() !== undefined) {
    $("input[name='nombre']").change(function(){
        ajax_listen($("input[name='nombre']").val(),"index.php?controller=Integrante&action=verificarIntegrante");
    });
}else{
    $("input[name='nombre']").change(function(){
        ajax_listen($("input[name='nombre']").val(),"index.php?controller=Evento&action=verificarEvento");
    });
}


function ajax_listen(data, target){
    $.ajax({
        type: "POST",
        url: target,
        data: {nombre : data},
        success: function(data){
            if (data == 0) {
                $("button[type='submit']").prop('disabled', true);
            }else{
                $("button[type='submit']").prop('disabled', false);
            }
            return data;
        },
        error: function(){}
    });
    console.log(target);
    return false;
}