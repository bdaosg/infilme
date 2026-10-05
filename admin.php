<?php
include "cons.php";

if (!isset($_SESSION)) {
    session_start();
}

$msg = "";
$erro = "";

if (($_SESSION["login"] ?? "") !== "admin") {
    $_SESSION["erro"] = "Faça login como admin para acessar essa página.";
    header("Location: login.php");
    exit();
}
$logado = true;

$filmes = [];
if ($logado) {
    $db_conn = new mysqli($server, $user, $password, $db);
    $db_conn->set_charset("utf8mb4");
    if ($db_conn->connect_error) {
        die("Falha de conexão: " . $db_conn->connect_error);
    }

    function salvar_imagem($campo)
    {
        if (!isset($_FILES[$campo]) || $_FILES[$campo]["error"] === UPLOAD_ERR_NO_FILE) {
            return "";
        }
        if ($_FILES[$campo]["error"] !== UPLOAD_ERR_OK) {
            return null;
        }
        $ext = strtolower(pathinfo($_FILES[$campo]["name"], PATHINFO_EXTENSION));
        if (!in_array($ext, ["jpg", "jpeg", "png", "webp", "gif"], true)) {
            return null;
        }
        if (@getimagesize($_FILES[$campo]["tmp_name"]) === false) {
            return null;
        }
        $base = preg_replace('/[^A-Za-z0-9_-]/', '_', pathinfo($_FILES[$campo]["name"], PATHINFO_FILENAME));
        $nome = $base . "_" . time() . "." . $ext;
        if (!move_uploaded_file($_FILES[$campo]["tmp_name"], __DIR__ . "/img/" . $nome)) {
            return null;
        }
        return $nome;
    }

    function preco_valido($txt)
    {
        $txt = str_replace(",", ".", trim($txt));
        return is_numeric($txt) && $txt >= 0 ? number_format((float)$txt, 2, ".", "") : null;
    }

    if (isset($_POST["salvar"])) {
        $id = (int)$_POST["id"];
        $nome = trim($_POST["nome"]);
        $desc = trim($_POST["descricao"]);
        $preco = preco_valido($_POST["preco"]);
        $img = salvar_imagem("imagem");

        if ($nome === "" || $preco === null) {
            $erro = "Informe um nome e um preço válido.";
        } elseif ($img === null) {
            $erro = "Imagem inválida (use jpg, png, webp ou gif).";
        } else {
            if ($img !== "") {
                $st = $db_conn->prepare("UPDATE produtos SET nome=?, descricao=?, preco=?, imagem=? WHERE Id=?");
                $st->bind_param("ssssi", $nome, $desc, $preco, $img, $id);
            } else {
                $st = $db_conn->prepare("UPDATE produtos SET nome=?, descricao=?, preco=? WHERE Id=?");
                $st->bind_param("sssi", $nome, $desc, $preco, $id);
            }
            $st->execute();
            $msg = "Filme atualizado!";
        }
    }

    if (isset($_POST["adicionar"])) {
        $nome = trim($_POST["nome"]);
        $desc = trim($_POST["descricao"]);
        $preco = preco_valido($_POST["preco"]);
        $img = salvar_imagem("imagem");

        if ($nome === "" || $preco === null) {
            $erro = "Informe um nome e um preço válido.";
        } elseif ($img === null || $img === "") {
            $erro = "Envie uma imagem válida (jpg, png, webp ou gif).";
        } else {
            $st = $db_conn->prepare("INSERT INTO produtos (Id, nome, descricao, preco, imagem) VALUES (NULL, ?, ?, ?, ?)");
            $st->bind_param("ssss", $nome, $desc, $preco, $img);
            $st->execute();
            $msg = "Filme adicionado!";
        }
    }

    if (isset($_POST["excluir"])) {
        $id = (int)$_POST["id"];
        $st = $db_conn->prepare("DELETE FROM carrinho WHERE produto_id=?");
        $st->bind_param("i", $id);
        $st->execute();
        $st = $db_conn->prepare("DELETE FROM produtos WHERE Id=?");
        $st->bind_param("i", $id);
        $st->execute();
        $msg = "Filme excluído.";
    }

    $res = $db_conn->query("SELECT * FROM produtos ORDER BY Id");
    while ($f = $res->fetch_assoc()) {
        $filmes[] = $f;
    }
}

function h($s) { return htmlspecialchars((string)$s, ENT_QUOTES, "UTF-8"); }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN - INFILME</title>
    <link rel="stylesheet" href="styles/style.css">
    <style>
        .admin-wrap { max-width: 1000px; margin: 0 auto; padding: 20px; }
        .admin-item { display: flex; gap: 20px; background: #171717; border-radius: 10px; padding: 15px; margin-bottom: 20px; }
        .admin-item .thumb { width: 140px; flex-shrink: 0; }
        .admin-item .thumb img { width: 100%; height: 200px; object-fit: cover; border-radius: 8px; }
        .admin-item form.dados { flex: 1; }
        .admin-item label { color: #ccc; font-size: 14px; margin-top: 8px; }
        .admin-item textarea { width: 100%; min-height: 80px; padding: 10px; border: none; border-radius: 5px; background: #333; color: #fff; font-family: Arial, sans-serif; font-size: 14px; box-sizing: border-box; resize: vertical; }
        .acoes { display: flex; gap: 10px; margin-top: 12px; }
        .acoes .botao { padding: 8px 16px; }
        .botao-excluir { background: #444; }
        .msg-ok { background: #1e4620; color: #b9f6ca; padding: 10px 15px; border-radius: 6px; margin-bottom: 15px; }
        .msg-erro { background: #5a1a1a; color: #ffb4b4; padding: 10px 15px; border-radius: 6px; margin-bottom: 15px; }
        .novo { border: 2px dashed #e50914; }
        @media (max-width: 650px) { .admin-item { flex-direction: column; } .admin-item .thumb { width: 100%; } .admin-item .thumb img { height: 260px; } }
    </style>
</head>
<body>
    <header></header>

    <nav>
        <ul class="navbar">
            <li><a href="index.php" class="botao">INÍCIO</a></li>
            <?php if ($logado): ?>
                <li class="empurra"><a href="sair.php" class="botao">SAIR</a></li>
            <?php endif; ?>
        </ul>
    </nav>

<?php if ($logado): ?>

    <div class="admin-wrap">
        <h1>GERENCIAR FILMES</h1>

        <?php if ($msg): ?><div class="msg-ok"><?= h($msg) ?></div><?php endif; ?>
        <?php if ($erro): ?><div class="msg-erro"><?= h($erro) ?></div><?php endif; ?>

        <!-- Adicionar novo filme -->
        <div class="admin-item novo">
            <form class="dados" method="post" enctype="multipart/form-data" action="admin.php">
                <h3 style="margin-top:0">Adicionar novo filme</h3>
                <label>Nome</label>
                <input type="text" name="nome" required>
                <label>Preço (R$)</label>
                <input type="text" name="preco" placeholder="29,90" required>
                <label>Descrição</label>
                <textarea name="descricao"></textarea>
                <label>Imagem</label>
                <input type="file" name="imagem" accept="image/*" required>
                <div class="acoes">
                    <button class="botao" type="submit" name="adicionar">ADICIONAR</button>
                </div>
            </form>
        </div>

        <!-- Lista de filmes -->
        <?php foreach ($filmes as $f): ?>
            <div class="admin-item">
                <div class="thumb"><img src="img/<?= h($f["imagem"]) ?>" alt=""></div>

                <form class="dados" method="post" enctype="multipart/form-data" action="admin.php">
                    <input type="hidden" name="id" value="<?= (int)$f["Id"] ?>">

                    <label>Nome</label>
                    <input type="text" name="nome" value="<?= h($f["nome"]) ?>" required>

                    <label>Preço (R$)</label>
                    <input type="text" name="preco" value="<?= h(number_format((float)$f["preco"], 2, ",", "")) ?>" required>

                    <label>Descrição</label>
                    <textarea name="descricao"><?= h($f["descricao"]) ?></textarea>

                    <label>Trocar imagem (opcional)</label>
                    <input type="file" name="imagem" accept="image/*">

                    <div class="acoes">
                        <button class="botao" type="submit" name="salvar">SALVAR</button>
                        <button class="botao botao-excluir" type="submit" name="excluir"
                                formnovalidate
                                onclick="return confirm('Excluir o filme &quot;<?= h(addslashes($f["nome"])) ?>&quot;?')">EXCLUIR</button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>

    <footer>
        <p class="copyright">© 2026 INFILME - Todos os direitos reservados.</p>
    </footer>
</body>
</html>
