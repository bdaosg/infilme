<?php
if(!isset($_SESSION)) {
    session_start();
}

$_SESSION["cpf"] = $_POST["cpf"];

$arq = fopen("usuarios/".$_POST["cpf"].".dat","w");

fwrite($arq,$_POST["nome"]."\n");
fwrite($arq,$_POST["cpf"]."\n");
fwrite($arq,$_POST["endereco"]."\n");
fwrite($arq,$_POST["bairro"]."\n");
fwrite($arq,$_POST["cidade"]."\n");
fwrite($arq,$_POST["estado"]."\n");
fwrite($arq,$_POST["cep"]."\n");
fclose($arq);

header("Location: cadastro2.php");

?>