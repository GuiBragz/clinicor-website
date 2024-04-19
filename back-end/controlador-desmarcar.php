<?php
// Inicie ou recupere a sessão
session_start();

// Verifique se o usuário está logado
if (!isset($_SESSION['usuario_email'])) {
    // Se não estiver logado, redirecione para a página de login ou faça qualquer outra ação necessária
    header("Location: pagina_de_login.php");
    exit();
}

// Conecte ao banco de dados
$conexao = new mysqli("localhost", "usuario", "senha", "clinicordb");

// Verifique a conexão
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

// ID do usuário logado
$usuario_id = $_SESSION['usuario_email'];

// Query para buscar o ID do funcionário associado ao usuário logado
$sql_funcionario = "SELECT FuncionarioID FROM Funcionarios WHERE usuario_email = $usuario_id";
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
        // Itera sobre as consultas
        while ($row_consulta = $resultado_consultas->fetch_assoc()) {
            $consulta_id = $row_consulta['ConsultaID'];
            // Gera o link de desmarcação para cada consulta
            echo '<a href="back-end/controlador-desmarcar.php?consulta_id=' . $consulta_id . '" class="button">DESMARCAR CONSULTA #' . $consulta_id . '</a><br>';
        }
    } else {
        echo "Não há consultas agendadas para este funcionário.";
    }
} else {
    echo "Usuário não possui funcionário associado.";
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>
