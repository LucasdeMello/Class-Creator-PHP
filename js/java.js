var numSG = 0;
var numNovo = 0;
var numAtributo = 0;
$(document).readyfunction()
{
    function Adicionar()
    {
        numSG++;
        var copia = "";
        var copia = '<div class="copia copia'+numSG+'">'+'<div class="ajuste"><label for="nomeatributo">Nome do Atributo: </label><input type="text" class="form-control" name="nomeatributo[]" value=""></div><div class="ajuste"><label for="variavel">Nome da Variavel: </label><input type="text" class="form-control" name="variavel[]"></div></div>';
        $(copia).clone().insertBefore("#oculto");

        if (numSG == 1) {
            var deletar = "";
            var deletar = '<input id="deletar" type="button" onclick="javasript:Fechar()" class="btn btn-danger"value="Deletar">';
            $(deletar).clone().insertAfter("#adicionar");
        };
    }

    function Update()
    {
        $("#metodo").remove();
        var metodo = "";
        var metodo = '<h2>Métodos</h2><div class="metodo'+numNovo+'"><label for="NomeMetodo">Nome do Método:</label><input type="text" class="form-control" name="metodo[]"><label for="Atributo">Nome do Atributo</label><input type="text" class="form-control atributo'+numNovo+'" name="atributometodo[]"></div><div class="ajustemetodo"><input id="metodo" type="button" class="btn btn-danger" value="Adicionar Metodos" onclick="javasript:AdicionarMetodo()"><input type="button" class="btn btn-danger" value="Adicionar Atributo" onclick="javasript:AdicionarAtributo()"></div>';
        $(metodo).clone().insertBefore("#oculto1");
    }

    function AdicionarMetodo()
    {
        numNovo++;
        var metodos = "";
        var metodos = '<div class="metodo'+numNovo+'"><label for="NomeMetodo">Nome do Método:</label><input type="text" class="form-control" name="metodo[][]"><label for="Atributo">Nome do Atributo</label><input type="text" class="form-control atributo'+numNovo+'" name="atributometodo[]"></div>';
        $(metodos).clone().insertBefore(".ajustemetodo");
    }

    function AdicionarAtributo()
    {
        numAtributo++;
        var atributo = "";
        var atributo = '<label for="Atributo">Nome do Atributo</label><input type="text" class="form-control atributo'+numAtributo+'" name="atributometodo[]">';
        $(atributo).clone().insertAfter(".atributo"+numNovo);
    }
};

function Fechar()
{
    if (".copia"+numSG) {
        $(".copia"+numSG).remove();
        numSG--;
    }else{
        $(".copia"+numSG).remove();
    };  

    if (numSG == 0) {
        $("#deletar").remove();
    };
}