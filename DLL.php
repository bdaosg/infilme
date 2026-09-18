<?php
Function teste_login($sessao) {
    if($sessao != "ok"){
        header("Location: index.php?erro=1");
        exit;
    }
	}

Function banco($server, $user, $password, $db, $consulta)
	{
	$banco =  new mysqli($server, $user, $password, $db);
	if ($banco->connect_error) {
            echo "Falha de conexão referência: (".$banco->connect_errno.") - ".$banco->connect_error;
				echo "<a href = 'incluir.php'> <img src = 'img/fundo/voltar.png' / width = 40 heigth= 40> </a>";
            exit();
	}
	if (!$resultado = $banco->query($consulta)) {
		        echo "Falha na consulta referência: (".$banco->errno.") - ".$banco->error;
				echo "<a href = 'incluir.php'> <img src = 'img/fundo/voltar.png' / width = 40 heigth= 40> </a>";
				exit();
	}
    $banco->close();
	return $resultado;
	}
