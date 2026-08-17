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
    <title>SUCESSO</title>
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
        <div>
            <h2>Aluguel Confirmado!</h2>
            <p>Parabéns! Seu filme já está disponível para assistir.</p>
            
            <div class="resumo">
                <p><strong>Protocolo:</strong> #<?php echo $_SESSION["protocolo"];?></p>
            </div>

            <a href="index.php" class="botao">Voltar para a Vitrine</a>
        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>

</body>
</html>