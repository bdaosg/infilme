<?php
if(!isset($_SESSION)) {
    session_start();
}

if(isset($_POST["nome"])){
    $_SESSION["carrinho"][] = array("nome" => $_POST["nome"], "preco" => $_POST["preco"]);
}

if(isset($_POST["remover"])){
    unset($_SESSION["carrinho"][$_POST["remover"]]);
    $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARRINHO</title>
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
        <h1>Carrinho</h1>
        <?php
        $total = 0;

        if(isset($_SESSION["carrinho"])){
            foreach($_SESSION["carrinho"] as $indice => $filme){
                echo "<h3>".$filme["nome"]."</h3>"; 
                echo "<h3>"." R$ ".$filme["preco"]."</h3>"; 

                echo "<form method='post'>";
                echo "<input type='hidden' name='remover' value='".$indice."'>";
                echo "<button class='botao' type='submit'>Remover</button>";
                echo "</form>";
                $total += $filme["preco"];
            }
            echo "<h3>Total: R$ ".$total."</h3>";
            }else{
                echo "<p>Carrinho vazio.</p>";
        }
        ?>

        <a href="login.php" class="botao">
        Finalizar Compra
        </a>
    </div>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>

</body>
</html>