<?php
require("../infraetrutura/Banco_dados.php");

$bd = new Banco_dados()
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar uma pessoa</title>
    <link rel="stylesheet" href="CSS/atualizar.css">
</head>
<body>
<div id="principal">
    <form method="post">
        <label>Nome: </label>
        <input type="text" name="nome" placeholder="Digite seu nome">
        <label>Data de nascimento: </label>
        <input type="date" name="data">
        <div class="botoes">
            <a href="index.php">Voltar</a>
            <button type="submit">Enviar</button>
        </div>
    </form>
</div>
<section> a </section>

<?php
$id = mysqli_escape_string($bd -> conectar(), $_GET['id']);
$nome = mysqli_escape_string($bd -> conectar(), $_POST['nome']);
$data = mysqli_escape_string($bd -> conectar(), $_POST['data']);

echo $bd -> atualizarPessoa($id, $nome, $data);
?>

</body>
</html>