<?php
include "cons.php";
require_once "DLL.php";

if(!isset($_SESSION)) {
    session_start();
}

if(isset($_POST["remover"]) and isset($_SESSION["usuario_id"])){
    $consulta = "DELETE FROM carrinho WHERE Id = '".$_POST["remover"]."' AND usuario_id = '".$_SESSION["usuario_id"]."'";
    banco($server, $user, $password, $db, $consulta);
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

            <?php
            if (isset($_SESSION["login"])) {
                echo "<li><span> " . $_SESSION["login"] . "</span></li>";
                echo "<li><a href='sair.php' class='botao1'>SAIR</a></li>";
            } else {
                echo "<li><a href='login.php' class='botao'>LOGIN</a></li>";
            }
            ?>
            
        </ul>
    </nav>

    <div class="form-box">
        <h1>Carrinho</h1>
        <?php
        $total = 0;

        if(isset($_SESSION["usuario_id"])){
            $consulta = "SELECT c.Id, c.quantidade, p.nome, p.preco
                        FROM carrinho c
                        INNER JOIN produtos p ON c.produto_id = p.Id
                        WHERE c.usuario_id = '".$_SESSION["usuario_id"]."'";
            $resultado = banco($server, $user, $password, $db, $consulta);

            if($resultado->num_rows > 0){
                while($filme = $resultado->fetch_assoc()){
                    echo "<h3>".$filme["nome"]."</h3>"; 
                    echo "<h3>"." R$ ".number_format($filme["preco"], 2, ',', '.')."</h3>"; 
                    echo "<h3>Quantidade: ".$filme["quantidade"]."</h3>"; 

                    echo "<form method='post'>";
                    echo "<input type='hidden' name='remover' value='".$filme["Id"]."'>";
                    echo "<button class='botao' type='submit'>Remover</button>";
                    echo "</form>";
                    $total += $filme["preco"] * $filme["quantidade"];
                }
                echo "<h3>Total: R$ ".number_format($total, 2, ',', '.')."</h3>";
            }else{
                echo "<p>Carrinho vazio.</p>";
            }
        }else{
            echo "<p>Faça login para ver seu carrinho.</p>";
        }
        ?>

        <a href="confirmar.php" class="botao">Finalizar Compra</a>
    </div>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>

</body>
</html>