<?php
include "cons.php";
require_once "DLL.php";

if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFILME</title>
    <link rel="stylesheet" href="styles/style.css">

</head>
<body>
    <!-- Banner -->
    <header></header>

    <!-- Navbar -->
    <nav>
        <ul class="navbar">

            <?php
            if (isset($_SESSION["login"])) {
                echo "<li><span> " . $_SESSION["login"] . "</span></li>";
                echo "<li><a href='sair.php' class='botao1'>SAIR</a></li>";

                if ($_SESSION["login"] == "admin") {
                    echo "<li><a href='admin.php' class='botao'>ADMIN</a></li>";
                }
            } else {
                echo "<li><a href='login.php' class='botao'>LOGIN</a></li>";
            }
            ?>

            <li class="empurra"><a href="carrinho.php" class="botao">CARRINHO</a></li>
        </ul>
    </nav>

    <!-- Conteúdo Principal -->
    <section id = "conteudo">

        <h1>FILMES</h1>
            
        <div class = "cards">

            <?php
            $consulta = "SELECT * FROM produtos ORDER BY Id";
            $resultado = banco($server, $user, $password, $db, $consulta);

            while($filme = $resultado->fetch_assoc()){
                echo "<div class='card'>";
                echo "<img class='imagem' src='img/".$filme["imagem"]."'>";
                echo "<b class='titulo'>".$filme["nome"]."</b>";
                echo "<p class='preco'>R$ ".number_format($filme["preco"], 2, ',', '.')."</p>";
                echo "<p class='descricao'>".$filme["descricao"]."</p>";

                echo "<form method='post' action='banco.php'>";
                echo "<input type='hidden' name='produto_id' value='".$filme["Id"]."'>";
                echo "<button class='botao' type='submit' name='B8'>ADICIONAR AO CARRINHO</button>";
                echo "</form>";
                echo "</div>";
            }
            ?>

        </div>

    </section>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>
</body>
</html>
