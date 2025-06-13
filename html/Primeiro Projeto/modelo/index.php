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
    <link rel="stylesheet" href="CSS/index.css">
    <title>Registro dos dados</title>
</head>
<body>

<container>
    <div>
        <h1>Dados Registrados</h1>
        <a href="inserir.php" id="inserir">Inserir dados</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Data de Nascimento</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($bd -> mostrarPessoas() as $row) {
            ?>
            <tr>
                <th><?=$row['id']?></th>
                <th><?=$row['nome']?></th>
                <th><?= $row['idade'] ?></th>
                <th><?= date('d/m/Y', strtotime( $row['data_nascimento']) ) ?></th>
                <th> <a href="atualizar.php?id=<?=$row['id']?>" id="editar">Editar</a>
                    <a href="index.php?id=<?= $row['id'] ?>" id="excluir">Excluir</a> </th>
            </tr>
            <?php
        }

        ?>
    </table>

    <?php
    $id = mysqli_real_escape_string($bd->conectar(), $_GET['id']);
    $bd -> deletarPessoa($id);
    ?>
</container>

</body>
</html>
