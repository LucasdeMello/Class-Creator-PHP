var numArray = 0;
function Adicionar()
{
    var copia = "";
    var copia = '<div class="copia">'+
                    '<div class="ajuste">'+
                    '<label for="nomeatributo">Nome do Atributo: </label>'+
                    '<input type="text" class="form-control" name="nomeatributo[]" value="">'+
                    '</div>'+
                    '<div class="ajuste">'+
                    '<label for="variavel">Nome da Variavel: </label>'+
                    '<input type="text" class="form-control" name="variavel[]">'+
                    '</div>'+
                '</div>';
    $("#getset").append(copia);

    if ($(".copia").length == 1) {
        var btnDeletar = "";
        var btnDeletar = '<input id="deletar" type="button" onclick="javasript:Fechar()" class="btn btn-danger"value="Deletar">';
        $(btnDeletar).clone().insertAfter("#adicionar");
    };
};

function Update()
{
    $("#metodo").remove();
    var metodo = "";
    var metodo = '<div id="Bmetodo">'+
        '<div class="col-md-4 metodo">'+
            '<div class="ajuste2">'+
            '<label for="NomeMetodo">Nome do Método:</label>'+
            '<input type="text" class="form-control" name="metodo['+numArray+'][metodo][]" required>'+
            '</div>'+
            '<div class="ajuste3">'+
            '<label for="Atributo">Nome do Atributo</label>'+
            '<input type="text" class="form-control atributo" name="metodo['+numArray+'][atributo][]">'+
            '</div>'+
        '</div></div>';
    var botao = "";
    var botao = 
            '<div class="ajustemetodo">'+
              '<input id="metodo2" type="button" class="btn btn-danger" value="Adicionar Metodos" onclick="javasript:AdicionarMetodo()">'+
              '<input type="button" class="btn btn-danger" value="Adicionar Atributo" onclick="javasript:AdicionarAtributo()">'+
            '</div>'+
            '<div class="ajustemetodo">'+
            '<input id="metodo" type="button" class="btn btn-danger" value="Remover Metodo" onclick="javascript:FecharMetodo()">'+
              '<input id="atributo" type="button" class="btn btn-danger" value="Remover Atributo" onclick="javascript:FecharAtributo()">'+
            '</div>';
    $("#metodos").append(metodo);
    $(botao).insertAfter("#metodos:last");
}

function AdicionarMetodo()
{
    numArray++; 
    var metodos = "";
    var metodos = '<div class="col-md-4 metodo">'+
            '<div class="ajuste2">'+
            '<label for="NomeMetodo">Nome do Método:</label>'+
            '<input type="text" class="form-control" name="metodo['+numArray+'][metodo][]" required>'+
            '</div>'+
            '<div class="ajuste3">'+
            '<label for="Atributo">Nome do Atributo</label>'+
            '<input type="text" class="form-control atributo" name="metodo['+numArray+'][atributo][]">'+
            '</div>'+
        '</div>';
    $(metodos).clone().insertAfter(".metodo:last");
}

function AdicionarAtributo()
{
    var atributo = "";
    var atributo = '<div class="ajuste3">'+
            '<label for="Atributo">Nome do Atributo</label>'+
            '<input type="text" class="form-control atributo" name="metodo['+numArray+'][atributo][]">'+
            '</div>';
    $(atributo).insertAfter(".ajuste3:last");
}

function Fechar()
{
    if($(".copia").length) {
        $(".copia").last().remove();
    };

    if($(".copia").length == 0){
        $("#deletar").remove();
    };
}

function FecharMetodo()
{

    if($(".metodo").length) {
        $(".metodo").last().remove();
    };

    if($(".metodo").length == 0){
        $("#Bmetodo").remove();
        $(".ajustemetodo").remove();
        var botao = '<input id="metodo" type="button" class="btn btn-danger" value="Adicionar Metodos" onclick="javasript:Update()">';
        $("#metodos").append(botao);
    };
    numArray--;
}

function FecharAtributo()
{
    if ($(".ajuste2").length == $(".ajuste3").length) {

    }else{
        $(".ajuste3").last().remove();
    }
}