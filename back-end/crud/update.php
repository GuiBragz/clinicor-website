<?php
include_once './connection.pp';

function modificadorSenha($senhanova, $codigosenha) {
    // Criar uma instância da classe Connection
    $conexao = getConnection(); // Supondo que getConnection() seja uma função que retorna a conexão com o banco de dados
    $senhaCriptografada = password_hash($senhanova, PASSWORD_DEFAULT);
    // Faz uma query no MySQL para atualizar a senha com base no código de recuperação de senha
    $sql = "UPDATE Usuarios SET Senha = ? WHERE CodigoRecuperaSenha = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $senhaCriptografada, $codigosenha); // Vinculando ambos os parâmetros à consulta SQL
    $stmt->execute();
    
    // Verificar se a consulta foi bem-sucedida e retornar true ou false conforme necessário
    if ($stmt->affected_rows > 0) {
        return true; // Retorna true se pelo menos uma linha foi afetada (ou seja, a senha foi atualizada)
    } else {
        return false; // Retorna false se nenhum registro foi afetado (nenhuma senha foi atualizada)
    }
}


function inserirCodigoRecuperaIndb($email, $codigosenha){
    $conexao = getConnection();
    // Faz uma query no MySQL para atualizar a senha com base no código de recuperação de senha
    $sql = "UPDATE Usuarios SET CodigoRecuperaSenha = ? WHERE email = ?"; // Removido as aspas em torno do marcador de posição '?'
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $codigosenha, $email); // Vinculando o parâmetro $codigosenha e $email à consulta SQL
    $stmt->execute();
}
?>