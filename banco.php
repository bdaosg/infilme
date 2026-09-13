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
    $consulta = "INSERT INTO usuarios (Id, nome, cpf, cep) VALUES (NULL, '$nome', '$cpf', '$cep')";
    banco($server, $user, $password, $db, $consulta);

    # Pegar o id do usuário cadastrado
    $consulta = "SELECT Id FROM usuarios WHERE cpf = '$cpf'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    $linha = $resultado->fetch_assoc();
    $id = $linha['Id'];

    # Dados do login
    $login_senha = md5($login_senha);
    $consulta = "INSERT INTO login_usuario (Id, conta, senha) VALUES (NULL, '$login_user', '$login_senha')";
    banco($server, $user, $password, $db, $consulta);

    header("Location: login.php");
    exit();

}

# Exibir
if(isset($B2)){
    $consulta = "SELECT * FROM usuarios WHERE Nome = '$nome'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    $linha = $resultado->fetch_assoc();
    echo $linha['Id']."</br>";
    echo $linha['Nome']."</br>";
    echo $linha['insta']."</br>";  
}

# Listar tudo
if(isset($B3)){
    $consulta = "SELECT * FROM usuarios order by Nome";
    $resultado = banco($server, $user, $password, $db, $consulta);
    while($linha = $resultado->fetch_assoc()){
        echo $linha['Id']."  ";
        echo $linha['Nome']."  ";
        echo $linha['insta']."</br>";
    }
}

# Selecionar
if(isset($B4)){
    $consulta = "SELECT * FROM usuarios WHERE Nome = '$nome'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    echo "<select name = 'opcao'>";
    while($linha = $resultado->fetch_assoc()){
        echo"<option value=".$linha['Id'].">".$linha['Id']." ".$linha['Nome']."</option>";
}
echo "</select>";
}

# Login
if(isset($B5)){
    $senha = md5($senha);

    $consulta = "SELECT * FROM login_usuario WHERE conta = '$login' and senha = '$senha'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    If ($linha = $resultado->fetch_assoc()){
        $_SESSION["login"] = $linha['conta'];
        header("Location: confirmar.php");
        exit();
    } else {
        $_SESSION["erro"] = "Usuário ou senha incorreto";
        header("Location: login.php");
        exit();
}
}

# Excluir
if(isset($B6)){
    $consulta = "DELETE FROM usuarios WHERE Nome = '$nome' and cpf = '$cpf'";
    banco($server, $user, $password, $db, $consulta);
    exit();
}
?>