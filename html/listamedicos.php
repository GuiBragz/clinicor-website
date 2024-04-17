<?php
include_once './back-end/connection.php';
include_once './back-end/models/funcionario.php';
include_once './back-end/crud/read.php';

$funcionariosArray = preencherArrayFuncionarios($conn);
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
        <?php
            while ($dado = mysqli_fetch_array($resultadomed)) {
            echo '<div class="medico">
                    <img src="../images/favicon.ico.png" alt="Foto do médico">
                    <h1 class="texto">'. $dado["Email"] . '</h1>
                    <p class="subtexto"><i>'. $dado["Tipo"] .'</i></p>
                </div>';
            }
        ?>
        </div>
        </form>
    
    <img src="../images/slide_background_out.png" alt="" class="back">
    <script src="../java script/mudarlista.js"></script>
</body>
</html>