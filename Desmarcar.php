<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CLINICOR - Fale Conosco</title>
    <link rel="stylesheet" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            width: 1200px;
            height: auto;
            border-radius: 8px;
            margin: 0 auto; /* centraliza horizontalmente */
            margin-top: 50px;
            margin-bottom: 30px;
            text-align: center; /* centraliza o conteúdo interno */
            padding: 30px; /* espaço interno */
        }
        .consulta{
            flex-direction: column;
            background-color: rgba(204, 204, 204, 0.5);
            width: 500px;
            height: 600px;
            margin: 20px;
            border-radius: 8px;
            border: 2px solid #616161
        }
        .nome{
            margin-top: 70px;
            margin-bottom: 40px;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 20px;
            font-weight: bold;
        }
        .infos{
            font-family: Arial, Helvetica, sans-serif;
            text-align: left;
            margin-left: 30px;
        }
        .button{
            font-family: Arial, Helvetica, sans-serif;
            background-color: #A93A2F;;
            padding: 20px;
            border-radius: 8px;
            color: black;
            text-decoration: none;
            font-weight: bold;
            position: absolute;
            margin-top: 310px;
            margin-left: 80px;

        }
    </style>
</head>
<body>
    <iframe src="barra.html" width="100%" height="110px" frameborder="0" class="iframe"></iframe>

<div class="container">
    <?php
    include_once './back-end/connection.php';

    function gerarLinksDesmarcarConsultas() {
        // Inicie ou recupere a sessão
        session_start();

        // Verifique se o usuário está logado
        if (!isset($_SESSION['usuario_email'])) {
            // Se não estiver logado, redirecione para a página de login ou faça qualquer outra ação necessária
            header("Location: Login.html");
            exit();
        }

        // Conecte ao banco de dados
        $conexao = getConnection();

        // ID do usuário logado
        if (isset($_SESSION['usuario_email'])) {
            $usuario_id = $_SESSION['usuario_email'];

            // Query para buscar o ID do funcionário associado ao usuário logado
            $sql_funcionario = "SELECT FuncionarioID FROM Funcionarios WHERE UsuarioID = $usuario_id";
            $resultado_funcionario = $conexao->query($sql_funcionario);

            // Verifique se encontrou o funcionário
            if ($resultado_funcionario->num_rows > 0) {
                // Obtenha o ID do funcionário
                $row_funcionario = $resultado_funcionario->fetch_assoc();
                $funcionario_id = $row_funcionario['FuncionarioID'];

                // Query para buscar as consultas associadas ao funcionário
                $sql_consultas = "SELECT ConsultaID FROM Consultas WHERE FuncionarioID = $funcionario_id";
                $resultado_consultas = $conexao->query($sql_consultas);

                // Verifique se há consultas
                if ($resultado_consultas->num_rows > 0) {
                    // Itera sobre as consultas e gera os links de desmarcação
                    while ($row_consulta = $resultado_consultas->fetch_assoc()) {
                        $consulta_id = $row_consulta['ConsultaID'];
                        // Gera o link de desmarcação para cada consulta
                        echo '<div class="consulta">';
                        echo '<p class="nome">Nome completo paciente</p>';
                        echo '<p class="infos">Data e hora: </p>';
                        echo '<p class="infos">Médico: </p>';
                        echo '<a href="back-end/controlador-desmarcar.php?consulta_id=' . $consulta_id . '" class="button">DESMARCAR CONSULTA #' . $consulta_id . '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "Não há consultas agendadas para este funcionário.";
                }
            } else {
                echo "Usuário não possui funcionário associado.";
            }
        } else {
            echo "ID do usuário não definido.";
        }

        // Fecha a conexão com o banco de dados
        $conexao->close();
    }

    gerarLinksDesmarcarConsultas();
    ?>
</div>

</body>
</html>
