<?php
if(!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="styles/style.css">
</head>

<body>

<header></header>

<div class="form-box">

<h2>Cadastro Login</h2>

<form method="post" action="salvar_login.php">

<input type="text" name="login" placeholder="Login" required>
<input type="password" name="senha" placeholder="Senha" required>

<button class="botao" type="submit" name="B4">Cadastrar</button>
</form>
</div>
</body>
</html>