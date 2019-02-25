function ajax_listen(idForm, target, action){
    var form_data = "";
    if (idForm !== "")
        form_data = $("#"+idForm).serialize();
    $.ajax({
        type: "POST",
        url: target,
        data: form_data,
        success: function(data){
            if(action !== "")
                action(data);
        },
        error: function(){}
    });
    console.log(target);
    return false;
}
let errorLogin = function (data) {

    if(data == 1) {
        
        $("#msg span").html(" Log in con exito");
        $("#msg").addClass("alert-success");
        $("#msg i").addClass("fa-check-circle");
        $("#msg").show();
        setTimeout(function () {
            window.location.href = "index.php";
        }, 1000);
    }else{
        $("#msg span").html(" Usuario o contraseña incorrectos");
        $("#msg").addClass("alert-danger");
        $("#msg i").addClass("fa-times-circle");
        $("#msg").show();
    }
}
