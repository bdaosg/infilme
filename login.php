<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
    <!-- Banner -->
    <header></header>

    <!-- Navbar -->
    <nav>
        <ul class="navbar">
            <li><a href="index.php" class="botao">INÍCIO</a></li>
            <li class="empurra"><a href="carrinho.php" class="botao">CARRINHO</a></li>
        </ul>
    </nav>

    
    <div class="form-box">
        <h2>LOGIN</h2>

        <?php
        if(isset($_SESSION["erro"])){
            echo "<p style='color:red'>";
            echo $_SESSION["erro"];
            echo "</p>";

            unset($_SESSION["erro"]);
        }
        ?>

        <form method="post" accept=""action="processa_login.php">
            <input type="text" name="login" placeholder="Usuário">
            <input type="password" name="senha" placeholder="Senha">

            <button class="botao" type="submit">Entrar</button>
        </form>

        <a href="cadastro.php" class="botao-cadastro">Cadastrar-se</a>
    </div>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>
    
</body>
</html>