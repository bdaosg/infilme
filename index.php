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
    <title>INFILME</title>
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

    <!-- Conteúdo Principal -->
    <section id = "conteudo">

        <h1>FILMES</h1>
            
        <div class = "cards">

            <!-- FILME 1 -->
            <div class="card">
                <img class="imagem" src="img\Batman O cavaleiro das trevas.jpg">
                <b class="titulo">Batman: O Cavaleiro das Trevas</b>
                <p class="preco">R$ 14,90</p>

                <p class="descricao">Agora com a ajuda do tenente Jim Gordon e do promotor público Harvey Dent, Batman tem tudo para banir o crime de Gotham City de uma vez por todas. Mas em breve, os três serão vítimas do Coringa, que pretende lançar Gotham em uma anarquia.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Batman: O Cavaleiro das Trevas">
                    <input type="hidden" name="preco" value="14.90">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 2 -->
            <div class="card">
                <img class="imagem" src="img\De volta para o futuro.jpg">
                <b class="titulo">De Volta para o Futuro</b>
                <p class="preco">R$ 12,50</p>

                <p class="descricao">Marty McFly viaja para 1955 com a máquina do tempo do cientista Dr. Brown. Ele deve garantir que seus pais se apaixonem, para não arriscar sua própria existência.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="De Volta para o Futuro">
                    <input type="hidden" name="preco" value="12.50">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 3 -->
            <div class="card">
                <img class="imagem" src="img\Devoradores de estrelas.jpeg">
                <b class="titulo">Devoradores de Estrelas</b>
                <p class="preco">R$ 9,90</p>

                <p class="descricao">Um astronauta tenta salvar a Terra enquanto está sozinho no espaço sideral.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Devoradores de Estrelas">
                    <input type="hidden" name="preco" value="9.90">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 4 -->
            <div class="card">
                <img class="imagem" src="img\filme1.webp">
                <b class="titulo">Homem-Aranha: Através do Aranhaverso</b>
                <p class="preco">R$ 16,00</p>

                <p class="descricao">Viajando pelo multiverso, Miles Morales conhece um novo time de Pessoas-Aranha, formado por heróis de diversas dimensões. Mas quando os heróis entram em conflito sobre como lidar com uma nova ameaça, Miles se vê em um impasse.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Homem-Aranha: Através do Aranhaverso">
                    <input type="hidden" name="preco" value="16.00">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form> 
            </div>

            <!-- FILME 5 -->
            <div class="card">
                <img class="imagem" src="img\Interestelar.jpg">
                <b class="titulo">Interestelar</b>
                <p class="preco">R$ 15,50</p>

                <p class="descricao">Uma equipe de exploradores viaja através de um buraco de minhoca no espaço, na tentativa de garantir a sobrevivência da humanidade.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Interestelar">
                    <input type="hidden" name="preco" value="15.50">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 6 -->
            <div class="card">
                <img class="imagem" src="img\Kill Bill.jpg">
                <b class="titulo">Kill Bill - Volume 1</b>
                <p class="preco">R$ 11,90</p>

                <p class="descricao">Depois de despertar de um coma de quatro anos, uma antiga assassina busca vingança contra o grupo de assassinos que a traiu.</p>
                
                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Kill Bill - Volume 1">
                    <input type="hidden" name="preco" value="11.90">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 7 -->
            <div class="card">
                <img class="imagem" src="img\Matrix.jpg">
                <b class="titulo">Matrix</b>
                <p class="preco">R$ 13,00</p>

                <p class="descricao">Um hacker aprende com os misteriosos rebeldes sobre a verdadeira natureza de sua realidade e seu papel na guerra contra seus controladores.</p>
                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Matrix">
                    <input type="hidden" name="preco" value="13.00">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 8 -->
            <div class="card">
                <img class="imagem" src="img\O Diabo Veste Prada 2.png">
                <b class="titulo">O Diabo Veste Prada 2</b>
                <p class="preco">R$ 10,50</p>

                <p class="descricao">Sequência de O Diabo Veste Prada (2006).</p>
                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="O Diabo Veste Prada 2">
                    <input type="hidden" name="preco" value="10.50">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 9 -->
            <div class="card">
                <img class="imagem" src="img\O Exterminador do Futuro.jpg">
                <b class="titulo">O Exterminador do Futuro</b>
                <p class="preco">R$ 12,90</p>

                <p class="descricao">Um assassino ciborgue do futuro tenta encontrar e matar Sarah Connor, uma garçonete que está destinada a ser a mãe de um homem que salvará a humanidade da extinção.</p>
                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="O Exterminador do Futuro">
                    <input type="hidden" name="preco" value="12.90">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 10 -->
            <div class="card">
                <img class="imagem" src="img\Pulp Fiction.jpg">
                <b class="titulo">Pulp Fiction: Tempo de Violência</b>
                <p class="preco">R$ 12,50</p>

                <p class="descricao">As vidas de dois assassinos da máfia, um boxeador, um gângster e sua esposa, e um par de bandidos se entrelaçam em quatro histórias de violência e redenção.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Pulp Fiction: Tempo de Violência">
                    <input type="hidden" name="preco" value="12.50">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 11 -->
            <div class="card">
                <img class="imagem" src="img\Star Wars ep V.jpg">
                <b class="titulo">Guerra nas Estrelas: O Império Contra-Ataca</b>
                <p class="preco">R$ 15,00</p>

                <p class="descricao">Depois que a Aliança Rebelde é dominada pelo Império, Luke Skywalker começa seu treinamento Jedi com Yoda, enquanto seus amigos são perseguidos por toda a galáxia por Darth Vader e pelo caçador de recompensas Boba Fett.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Guerra nas Estrelas: O Império Contra-Ataca">
                    <input type="hidden" name="preco" value="15.00">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

            <!-- FILME 12 -->
            <div class="card">
                <img class="imagem" src="img\Zootopia 2.jpeg">
                <b class="titulo">Zootopia 2</b>
                <p class="preco">R$ 13,50</p>

                <p class="descricao">A corajosa coelha policial Judy Hopps e seu amigo, a raposa Nick Wilde, unem-se novamente para solucionar um novo caso, o mais perigoso e intrincado de suas carreiras.</p>

                <form method="post" action="carrinho.php">
                    <input type="hidden" name="nome" value="Zootopia 2">
                    <input type="hidden" name="preco" value="13.50">
                    <button class="botao" type="submit">ADICIONAR AO CARRINHO</button>
                </form>
            </div>

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