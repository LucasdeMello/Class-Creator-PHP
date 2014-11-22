<!DOCTYPE html>
<html>
    <head>
        <title>Criador de Classes Automatico</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="js/java.js"></script>
    </head>

    <body>
        <h1>Criador de Classes Automatico</h1>

        <form action="" method="POST">
            <div class="ajuste1">
                <label for="classe">Nome da Classe: </label>
                <input type="text" class="form-control" name="classname" required>
            </div>

            <h2>GET SET</h2>

            <div id="getset"></div>

            <div class="enviar">
                <input id="adicionar" type="button" class="btn btn-danger" value="Adicionar" onclick="javasript:Adicionar()">
            </div>

            <h2>Métodos</h2>

            <div id="metodos">
                <input id="metodo" type="button" class="btn btn-danger" value="Adicionar Metodos" onclick="javasript:Update()">
            </div>
            <input id="enviar" type="submit" class="btn btn-danger" name="enviar" value="enviar">
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
            $strMetodo = "";

            //Recebendo valores do formulario
            $classname = $_POST["classname"];

            if (isset($_POST["nomeatributo"])) {
                $atributo = $_POST["nomeatributo"];
            }

            if (isset($_POST["variavel"])) {
                $variavel = $_POST["variavel"];
            }

            if (isset($_POST["metodo"])) {
                $metodo = $_POST["metodo"];
            }
            
            $classname2 = $classname . '.php';
            
            //Verificando se o arquivo existe
            if(file_exists($classname2)){
                //Pegando o conteudo do arquivo
                $strFile = file_get_contents($classname2);
                //Recebendo os valores da VARIAVEL e as separando
                if (isset($_POST["variavel"])) {
                    $strvar = '$' . implode(", $", $variavel).',';
                }
            }else{
                //Fazendo a estrutura do arquivo
                $strFile .= '<?php'."\r\n";
                $strFile .= "class $classname{\r\n";
                $strFile .= "    \n\r";
                $strFile .= '    public function __construct($'.implode(", $", $variavel).'){' . "\r\n";
                $strFile .= "    }". "\r\n";
                $strFile .= "\r\n    //SET GET\r\n";
                $strFile .= "    //Metodos\r\n";
                $strFile .= "}";
            }
            
            //Retirando os valores das variaveis e as estruturando
            if (isset($_POST["nomeatributo"]))
            {
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
                $strFile = preg_replace("/(public function __construct\(.*\{)/i", "$1 $strcons", $strFile);
                $strFile = preg_replace("/(public function __construct\()/i", "$1 $strvar", $strFile);
                $strFile = preg_replace("/(\/\/SET GET)/i", "$1 $strcomp", $strFile);
            }

            if (isset($_POST["metodo"])) 
            {
                foreach ($metodo as $key => $value) 
                {
                    foreach ($value["metodo"] as $key1 => $value1) 
                    {
                        $strMetodo .= "\r\n"."    public function ". $value1."($".implode(", $", $value["atributo"])."){\r\n";
                        $strMetodo .= "\r\n";
                        $strMetodo .= "    }\r\n";
                    }
                }
                $strFile = preg_replace("/(\/\/Metodos)/i", "$1 $strMetodo", $strFile);
            }


            //Definindo o local onde os dados serao escritos
            $strFile = preg_replace("/(class +.*\{)/i", "$1 $strPrivates", $strFile);
            
            //Escrevendo os dados
            file_put_contents($classname2, $strFile);
        }
    ?>
    </body>
</html>