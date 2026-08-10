<?php
if(!isset($_SESSION)) {
    session_start();
}
$id = mt_rand(1, 100000000);
$arq = fopen("vendas/".$id.".dat","w");

$total = 0;

foreach($_SESSION["carrinho"]as $filme){

$total += $filme["preco"];

fwrite($arq, $filme["nome"]."\n");}
fwrite($arq, $_SESSION["nome"]."\n");
fwrite($arq, $_POST["pagamento"]."\n");fwrite($arq, $total."\n");
fclose($arq);

$_SESSION["protocolo"] = $id;

unset($_SESSION["carrinho"]);

header("Location: sucesso.php");
?>