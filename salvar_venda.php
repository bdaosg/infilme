<?php
if(!isset($_SESSION)) {
    session_start();
}

include "cons.php";
require_once "DLL.php";

$total = 0;
$compras = "";

foreach($_SESSION["carrinho"] as $filme) {

    $total += $filme["preco"];

    $compras .= $filme["nome"] . ", ";
}

$compras = rtrim($compras, ", ");

$nome = $_SESSION["login"];
$pagamento = $_POST["pagamento"];

$consulta = "INSERT INTO vendas (nome_usuario, compras, valor_final, pagamento)
             VALUES ('$nome', '$compras', '$total', '$pagamento')";

banco($server, $user, $password, $db, $consulta);

$consulta = "SELECT protocolo FROM vendas ORDER BY protocolo DESC LIMIT 1";

$resultado = banco($server, $user, $password, $db, $consulta);

$linha = $resultado->fetch_assoc();

$_SESSION["protocolo"] = $linha["protocolo"];

unset($_SESSION["carrinho"]);

header("Location: sucesso.php");
exit();
?>