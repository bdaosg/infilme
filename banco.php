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

    $consulta = "SELECT c.quantidade, p.nome, p.preco
                FROM carrinho c
                INNER JOIN produtos p ON c.produto_id = p.Id
                WHERE c.usuario_id = '".$_SESSION["usuario_id"]."'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($resultado->num_rows == 0){
        header("Location: carrinho.php");
        exit();
    }

    while($filme = $resultado->fetch_assoc()){

        $total += $filme["preco"] * $filme["quantidade"];
        $compras .= $filme["nome"]." (x".$filme["quantidade"]."), ";
    }

    $compras = rtrim($compras,", ");

    $consulta = "INSERT INTO vendas 
    (usuario_id, compras, pagamento, total)
    VALUES (
        '".$_SESSION["usuario_id"]."',
        '$compras',
        '$pagamento',
        '$total'
    )";

    banco($server,$user,$password,$db,$consulta);

    # Pegar o último protocolo gerado
    $consulta = "SELECT protocolo FROM vendas ORDER BY protocolo DESC LIMIT 1";
    $resultado = banco($server,$user,$password,$db,$consulta);
    $linha = $resultado->fetch_assoc();

    $_SESSION["protocolo"] = $linha["protocolo"];

    # Limpar o carrinho do usuário
    $consulta = "DELETE FROM carrinho WHERE usuario_id = '".$_SESSION["usuario_id"]."'";
    banco($server,$user,$password,$db,$consulta);

    header("Location: sucesso.php");
    exit();
}

# Adicionar ao carrinho
if(isset($B8)){

    if(!isset($_SESSION["usuario_id"])){
        header("Location: login.php");
        exit();
    }

    # Ver se o produto já está no carrinho
    $consulta = "SELECT Id FROM carrinho WHERE usuario_id = '".$_SESSION["usuario_id"]."' AND produto_id = '$produto_id'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($linha = $resultado->fetch_assoc()){
        $consulta = "UPDATE carrinho SET quantidade = quantidade + 1 WHERE Id = '".$linha["Id"]."'";
    } else {
        $consulta = "INSERT INTO carrinho (Id, usuario_id, produto_id, quantidade) VALUES (NULL, '".$_SESSION["usuario_id"]."', '$produto_id', 1)";
    }
    banco($server, $user, $password, $db, $consulta);

    header("Location: index.php");
    exit();
}
?>
