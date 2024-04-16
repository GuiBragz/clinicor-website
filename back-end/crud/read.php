<?php

session_start();
include_once 'connection.php';
include_once 'models/usuario.php';

// Função para verificar as credenciais no banco de dados
function verificarCredenciaisNoBanco($email, $senha) {
    // Criar uma instância da classe Connection
    $conexao = getConnection();

    // Faz uma query no MySQL para verificar se as credenciais estão corretas
    $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $email, $senha);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se a consulta retornou algum resultado
    if ($resultado->num_rows > 0) {
        // Se as credenciais estiverem corretas, retorna true
        $conexao->close();
        return true;
    } else {
        // Se as credenciais estiverem incorretas, retorna false
        $conexao->close();
        return false;
    }
}

// Função para buscar os dados do usuário no MySQL e armazenar em um objeto
function buscarUsuarioPorEmail($email) {
    // Criar uma instância da classe Connection
    $conexao = getConnection();
    
    // Prevenir SQL Injection usando consultas preparadas
    $stmt = $conexao->prepare("SELECT * FROM Usuarios WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se a consulta retornou algum resultado
    if ($resultado->num_rows > 0) {
        // Obtém a linha de resultado como um array associativo
        $dadosUsuario = $resultado->fetch_assoc();
        // Instancia um objeto Usuario com os dados obtidos
        $usuario = new Usuario(
            $dadosUsuario['UsuarioID'],
            $dadosUsuario['Email'],
            $dadosUsuario['Senha'],
            $dadosUsuario['Tipo'],
            $dadosUsuario['DataRegistro']
        );

        $conexao->close();
        return $usuario;
    } else {
        // Se não houver resultados, retorna null
        $conexao->close();
        return null;
    }
}

function buscarCodigoRecuperacao($CodigoRecuperaSenha) {
    $conexao = getConnection();

    // Prevenir SQL Injection usando consultas preparadas
    $stmt = $conexao->prepare("SELECT * FROM Usuarios WHERE CodigoRecuperaSenha = ?");
    $stmt->bind_param("s", $CodigoRecuperaSenha);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    // Verifica se a consulta retornou algum resultado
    if ($resultado->num_rows > 0) {
        return true; // Retorna true se encontrar um usuário com o código de recuperação de senha fornecido
    } else {
        return false; // Retorna false se não encontrar nenhum usuário com o código de recuperação de senha fornecido
    }
}



?>