<?php
if(!isset($_SESSION)) {
    session_start();
}

$arquivo = "login/".$_POST["login"].".dat";

if(file_exists($arquivo)){

    $arq = fopen($arquivo,"r");
    $cpf = trim(fgets($arq));
    $senha = trim(fgets($arq));
    fclose($arq);

    if($senha == md5($_POST["senha"])){

        $_SESSION["login"] = $_POST["login"];
        $_SESSION["cpf"] = $cpf;
        $arq2 = fopen("usuarios/".$cpf.".dat","r");
        $_SESSION["nome"] = trim(fgets($arq2));
        fclose($arq2); header("Location: confirmar.php");

    }else{

        $_SESSION["erro"] = "Senha incorreta.";
        header("Location: login.php");
    }

}else{

    $_SESSION["erro"] = "Usuário não encontrado.";
    header("Location: login.php");
}
?>