<!DOCTYPE html>
<html>
    <head>
        <title>Criador de Classes Automatico</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/java.js"></script>
    </head>

    <body>
        <h1>Criador de Classes Automatico</h1>

        <h2>GET SET</h2>
        <form action="" method="POST">
            <div class="form">
                <div class="ajuste">
                <label for="nomeatributo">Nome do Atributo: </label>
                <input type="text" class="form-control" name="nomeatributo[]" value="">
                </div>
                <div class="ajuste">
                <label for="variavel">Nome da Variavel: </label>
                <input type="text" class="form-control" name="variavel[]">
                </div>
                <div class="ajuste">
                <label for="classe">Nome da Classe: </label>
                <input type="text" class="form-control" name="classname">
                </div>
            </div>
            <div id="oculto"></div>
            <div id="enviar">
                <input type="submit" class="btn btn-danger" name="enviar" value="enviar">
                <input id="adicionar" type="button" class="btn btn-danger" value="Adicionar" onclick="javasript:Adicionar()">
            </div>

            <div id="oculto1"></div>
        </form>
        <?php
        if (isset($_POST["enviar"]))
        {
            //Variaveis
            $strFile = "";
            $strvar = "";
            $strPrivates = "";
            $strcons = "";
            $strcomp = "";

            //Recebendo valores do formulario
            $classname = $_POST["classname"];
            $atributo = $_POST["nomeatributo"];
            $variavel = $_POST["variavel"];
            $classname2 = $classname . '.php';
            
            //Verificando se o arquivo existe
            if(file_exists($classname2)){
                //Pegando o conteudo do arquivo
                $strFile = file_get_contents($classname2);
                //Recebendo os valores da VARIAVEL e as separando
                $strvar = '$' . implode(", $", $variavel).',';
            }else{
                //Fazendo a estrutura do arquivo
                $strFile .= '<?php'."\r\n";
                $strFile .= "class $classname{\r\n";
                $strFile .= "    \n\r";
                $strFile .= '    public function __construct($'.implode(", $", $variavel).'){' . "\r\n";
                $strFile .= "    }". "\r\n";
                $strFile .= "\r\n    //SET GET";
                $strFile .= "}";
            }
            
            //Retirando os valores das variaveis e as estruturando
            foreach ($atributo as $key => $value) 
            {
                $strPrivates .= "\r\n    private $$value;";
                $strcons.= "\r\n        " . '$this->set' . $value .'($' . $variavel[$key] . ');';
                $strcomp .= "\r\n" . '    public function set'.$value.'($'. $variavel[$key] . '){'."\r\n";
                $strcomp .= "        " . '$this->' . $value . ' = $' . $variavel[$key].';'."\r\n";
                $strcomp .= '    }'."\r\n";
                $strcomp .= "\r\n".'    public function get'.$value.'(){'."\r\n";
                $strcomp .= '        return $this->'.$value.';'."\r\n";
                $strcomp .= '    }'."\r\n";
            }

            //Definindo o local onde os dados serao escritos
            $strFile = preg_replace("/(class +.*\{)/i", "$1 $strPrivates", $strFile);
            $strFile = preg_replace("/(public function __construct\(.*\{)/i", "$1 $strcons", $strFile);
            $strFile = preg_replace("/(public function __construct\()/i", "$1 $strvar", $strFile);
            $strFile = preg_replace("/(\/\/SET GET)/i", "$1 $strcomp", $strFile);

            //Escrevendo os dados
            file_put_contents($classname2, $strFile);
        }
    ?>
    </body>
</html>