<?php
include "cons.php";
require_once "DLL.php";
extract($_POST);

if(!isset($_SESSION)){
    session_start();
}

# Cadastrar
if(isset($B1)){
    # Dados do usuário
    $consulta = "INSERT INTO usuarios (Id, nome, cpf, cep)
                VALUES (NULL, '$nome', '$cpf', '$cep')";
    banco($server, $user, $password, $db, $consulta);

    # Pegar o Id criado
    $consulta = "SELECT Id FROM usuarios WHERE cpf = '$cpf'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    $linha = $resultado->fetch_assoc();
    $id = $linha['Id'];

    # Dados do login
    $login_senha = md5($login_senha);

    $consulta = "INSERT INTO login_usuario (usuario_id, conta, senha) VALUES ('$id', '$login_user', '$login_senha')";
    banco($server, $user, $password, $db, $consulta);

    header("Location: login.php");
    exit();

}

# Login
if(isset($B5)){
    $senha = md5($senha);

    $consulta = "SELECT * FROM login_usuario WHERE conta = '$login' and senha = '$senha'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($linha = $resultado->fetch_assoc()){
        $_SESSION["login"] = $linha['conta'];
        $_SESSION["usuario_id"] = $linha['usuario_id'];

        header("Location: index.php");
        exit();
    } else {
        $_SESSION["erro"] = "Usuário ou senha incorreto";
        header("Location: login.php");
        exit();
    }
}

# Salvar venda
if(isset($B7)){

    $total = 0;
    $compras = "";

    if(empty($_SESSION["carrinho"])){
        header("Location: carrinho.php");
        exit();
    }

    foreach($_SESSION["carrinho"] as $filme){

        $total += $filme["preco"];
        $compras .= $filme["nome"].", ";
    }

    $compras = rtrim($compras,", ");

    $consulta = "INSERT INTO vendas VALUES (NULL, '".$_SESSION["usuario_id"]."', '".$_SESSION["login"]."', '$compras', '$total', '$pagamento')";

    banco($server,$user,$password,$db,$consulta);

    // Pegar o último protocolo gerado
    $consulta = "SELECT protocolo FROM vendas ORDER BY protocolo DESC LIMIT 1";
    $resultado = banco($server,$user,$password,$db,$consulta);
    $linha = $resultado->fetch_assoc();

    $_SESSION["protocolo"] = $linha["protocolo"];

    unset($_SESSION["carrinho"]);

    header("Location: sucesso.php");
    exit();
}

# Adicionar ao carrinho
if(isset($B8)){

    $_SESSION["carrinho"][] = array(
        "nome"=>$nome,
        "preco"=>$preco
    );

    header("Location: index.php");
    exit();
}
?>
