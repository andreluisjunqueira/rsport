(function(){
    $('#div-erro').hide();
})();

var mostrarErro = function(texto){
    var divErro = $('#div-erro');
    var erroMsg = $('#msgErro');
    erroMsg.html(texto);
    divErro.slideDown(500);
};

var logar = function(){
    $("#loginForm").bind("submit", function(e){
        var form = $(this);
        var dados = $(this).serializeArray();
        var usuario = dados[0].value;
        var senha = dados[1].value;
        var campousuario =  $('#txtusuario');
        var camposenha = $('#txtsenha');
        var hasIndex = window.location.href.indexOf('index');
        var url = window.location.href;
        if(hasIndex != -1){
        var url = window.location.href.substr(0,hasIndex);
        }
        console.log(url);
        
        if(usuario === ""){
            campousuario.addClass('has-error');
            campousuario.focus();
            mostrarErro('O campo usuario e obrigatorio !');
            return false;
        }else if(senha === ""){
            camposenha.addClass('has-error');
            camposenha.focus();
            mostrarErro('O campo senha e obrigatorio !');
            return false;
        }
        $.ajax({
            url:url+'usuario/login',
            data:{
                usuario:usuario,
                senha:senha
                },
            method:"post",
            success:function(data,status){
                var dados = JSON.parse(data);
                if( parseInt(dados.FL_ADMIN_USU )){
                     window.location.href = url+'admin/index';
                }else{
                     window.location.href = url+'aluno/index';
                }
            },
            error:function(err){
                mostrarErro('Erro ao acessar o sistema.');
               $(form).each(function(){
                   this.reset();
               });
            }
        });
        e.preventDefault();
    });
};

var modals = function(idModal){
    
    //$('#'+idModal).modal();
   
};
