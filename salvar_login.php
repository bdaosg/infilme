<?php
if(!isset($_SESSION)) {
    session_start();
}

$arq = fopen("login/".$_POST["login"].".dat", "w");

fwrite($arq, $_SESSION["cpf"]."\n");
fwrite($arq, md5($_POST["senha"]));
fclose($arq);

header("Location: login.php");

?>