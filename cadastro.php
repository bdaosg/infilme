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
    <title>CADASTRO</title>
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
        <h2>Cadastro</h2>

        <form action = 'banco.php' method = 'post'>
            
            <div class="campo">
                <p>Nome completo</p>
                <input type="text" name="nome" required>
            </div>

            <div class="campo">
                <p>CPF</p>
                <input type="text" name="cpf" maxlength="11" placeholder="000.000.000-00" required>
            </div>

            <div class="campo">
                <p>CEP</p>
                <input type="text" name="cep" placeholder="00000-000" required>
            </div>

            <button class="botao" type="submit" name="B1">Cadastrar</button>

        </form>
    </div>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>
    
</body>
</html>