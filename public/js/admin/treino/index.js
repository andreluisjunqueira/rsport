
$('#modal1').on('show.bs.modal',function(){
   var url = window.location.href;
   (url.indexOf('?') !== -1) ? url = url.split('?')[0]+'/getobjetivos':url+='/getobjetivos';
  $.get(url,function(res){
    var resposta = JSON.parse(res);
    var select = $('#select2');
    select.html('');
    $.each(resposta,function(chave,valor){
       select.append('<option value="'+valor.ID_OBJETIVO_OBJ+'">'+valor.ST_NOME_OBJ+'</option>'); 
    });
  });
});

var novoObjetivo = function(){
    $('#form-objetivo').unbind('submit').bind('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var url = window.location.href;
       (url.indexOf('?') !== -1) ? url = url.split('?')[0]+'/objetivoput':url+='/objetivoput';

        $.post(url,data,function(response){
            if(response){
                console.log(response);
                $('#modal2').modal('hide');
                Notify('Salvou com sucesso', 'top-right', '5000', 'success', 'fa-list', true);
            }else{
                $('#modal2').modal('hide');
                 Notify('Salvou com sucesso', 'top-right', '5000', 'danger', 'fa-list', true);
            }
        });
    });
};
var novoTreino = function(){
    $('#form-treino').unbind('submit').bind('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        var descricao = $('#summernote').code();
        data += "&descricao="+descricao;
        var url = window.location.href;
       (url.indexOf('?') !== -1) ? url = url.split('?')[0]+'/put':url+='/put';

        $.post(url,data,function(response){
            if(response){
                console.log(response);
                $('#modal1').modal('hide');
                Notify('Salvou com sucesso', 'top-right', '5000', 'success', 'fa-list', true);
            }else{
                $('#modal1').modal('hide');
                 Notify('Salvou com sucesso', 'top-right', '5000', 'danger', 'fa-list', true);
            }
        });
    });
};

var excluirTreino = function(id){
        var url = window.location.href;
       (url.indexOf('?') !== -1) ? url = url.split('?')[0]+'/delete':url+='/delete';
    bootbox.confirm("Tem certeza que deseja excluir esse treino ?", function (result) {
        if (result) {
            $.post(url,{id:id},function(res){
                
                console.log(res);
            });
        }
    });
};

var maisUm = function(){
    
    var input = '<div class="dd-handle col-lg-10 first" > <input type="text" name="series[]" placeholder="Series" class="form-control"> </div> ';
    $('li[class="dd-item bordered-blue"]').append(input);
    
    console.log(input);
    
}; 