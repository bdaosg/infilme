<?php
if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION["login"])){header("Location: login.php");}
    if(!isset($_SESSION["carrinho"]) or count($_SESSION["carrinho"]) == 0){
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

                foreach($_SESSION["carrinho"] as $filme){echo "<div class='resumo-item'>";

                    echo "<span>".$filme["nome"]."</span>";
                    echo "<span>R$ ".$filme["preco"]."</span>";
                    echo "</div>";
                    $total += $filme["preco"];
                }
                ?>

                <strong>
                Total: R$ <?php echo $total; ?>
                </strong>
            </div>

            <!-- DADOS USUÁRIO -->
            <div class="resumo">
                <p>
                <strong>Nome:</strong>
                <?php echo $_SESSION["nome"];?>
                </p>

                <p>
                <strong>CPF:</strong>
                <?php echo $_SESSION["cpf"];?>
                </p>
            </div>

            <!-- FORMA PAGAMENTO -->
            <form method="post" action="salvar_venda.php">
                <div class="form-group">
                    <label>Forma de Pagamento:</label>
                    <select name="pagamento" required>
                        <option>Cartão de Crédito</option>
                        <option>PIX</option>
                        <option>Boleto</option>
                    </select>
                </div>

                <button type="submit" class="btn">Concluir Compra</button>

                <a href="carrinho.php" class="link">Voltar ao carrinho</a>

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