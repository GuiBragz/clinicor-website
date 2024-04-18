<?php
include_once '../back-end/connection.php';
include_once '../back-end/models/funcionario.php';
include_once '../back-end/crud/read.php';


$conexao = getConnection();

// Preenchendo o array de funcionários
$funcionariosArray = preencherArrayFuncionarios($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/csslistademedicos.css">
    <title>Document</title>
</head>
<body>
    <iframe src="../barra.html" width="100%" height="110px" frameborder="0" class="iframe"></iframe>
    <form action="">
        <div class="sub">
            <!-- Iterando sobre o array de funcionários utilizando foreach -->
            <?php foreach ($funcionariosArray as $funcionario): ?>
                <div class="medico">
                    <img src="../images/favicon.ico.png" alt="Foto do médico">
                    <h1 class="texto"> <?=$funcionario->getNome()?></h1>
                    <p class="subtexto"><i> <?=$funcionario->getCargo()?></i></p>
                </div>
            <?php endforeach ?>
        </div>
    </form>
    
    <img src="../images/slide_background_out.png" alt="" class="back">
    <script src="../java script/mudarlista.js"></script>
</body>
</html>