<?php
include "cons.php";
require_once "DLL.php";

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

$consulta = "SELECT c.quantidade, p.nome, p.preco
            FROM carrinho c
            INNER JOIN produtos p ON c.produto_id = p.Id
            WHERE c.usuario_id = '".$_SESSION["usuario_id"]."'";
$resultado = banco($server, $user, $password, $db, $consulta);

if($resultado->num_rows == 0){
    header("Location: carrinho.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONFIRMAR</title>
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
                echo "<li><a href='sair.php' class='botao2'>SAIR</a></li>";
            } else {
                echo "<li><a href='login.php' class='botao'>LOGIN</a></li>";
            }
            ?>

            <li class="empurra"><a href="carrinho.php" class="botao">CARRINHO</a></li>
        </ul>
    </nav>

    <div class="container">
        <div class="form-container">

            <h2 style="text-align:center; margin-bottom:20px;">
                Finalizar Compra
            </h2>

            <!-- RESUMO ITENS -->
            <div class="resumo">
                <?php
                $total = 0;

                while($filme = $resultado->fetch_assoc()){echo "<div class='resumo-item'>";

                    echo "<span>".$filme["nome"]." (x".$filme["quantidade"].")</span>";
                    echo "<span>R$ ".number_format($filme["preco"] * $filme["quantidade"], 2, ',', '.')."</span>";
                    echo "</div>";
                    $total += $filme["preco"] * $filme["quantidade"];
                }
                ?>

                <strong>
                Total: R$ <?php echo number_format($total, 2, ',', '.'); ?>
                </strong>
            </div>

            <!-- DADOS USUÁRIO -->
            <div class="resumo">
                <p>
                <strong>Login:</strong>
                <?php echo $_SESSION["login"];?>
                </p>
            </div>

            <!-- FORMA PAGAMENTO -->
            <form method="post" action="banco.php">
                <div class="form-group">
                    <label>Forma de Pagamento:</label>
                    <select name="pagamento" required>
                        <option>Cartão de Crédito</option>
                        <option>PIX</option>
                        <option>Boleto</option>
                    </select>
                </div>

                <button type="submit" name="B7" class="btn">Concluir Compra</button>

            </form>

        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <p class="copyright">
            © 2026 INFILME - Todos os direitos reservados.
        </p>
    </footer>
</body>
