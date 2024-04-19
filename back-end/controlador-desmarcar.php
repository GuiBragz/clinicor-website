<?php

include_once 'connection.php';
// Conecta ao banco de dados
$conexao = getConnection();
// Verifica a conexão
if ($conexao->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conexao->connect_error);
}

// Query para buscar todas as consultas
$sql = "SELECT ConsultaID FROM Consultas";
$resultado = $conexao->query($sql);

// Verifica se há consultas
if ($resultado->num_rows > 0) {
    // Itera sobre as consultas
    while ($row = $resultado->fetch_assoc()) {
        $consulta_id = $row['ConsultaID'];
        // Gera o link de desmarcação para cada consulta
        echo '<a href="back-end/controlador-desmarcar.php?consulta_id=' . $consulta_id . '" class="button">DESMARCAR CONSULTA #' . $consulta_id . '</a><br>';
    }
} else {
    echo "Não há consultas agendadas.";
}

// Fecha a conexão com o banco de dados
$conexao->close();
?>