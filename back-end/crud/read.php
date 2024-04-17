<?php
session_start();
include_once 'connection.php';
include_once 'models/usuario.php';

// Função para verificar as credenciais no banco de dados
function verificarCredenciaisNoBanco($email, $senha) {
    // Criar uma instância da classe Connection
    $conexao = getConnection();

    // Faz uma query no MySQL para verificar se as credenciais estão corretas
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Verifica se a consulta retornou algum resultado
    if ($resultado->num_rows > 0) {
        // Obtém a linha de resultado como um array associativo
        $dadosUsuario = $resultado->fetch_assoc();
        
        // Verifica se a senha está correta usando password_verify
        if (password_verify($senha, $dadosUsuario['senha'])) {
            $conexao->close();
            return true;
        }
    }

    $conexao->close();
    return false;
}

// Função para buscar os dados do usuário no MySQL e armazenar em um objeto
function buscarUsuarioPorEmail($email) {
    // Criar uma instância da classe Connection
    $conexao = getConnection();
    
    // Prevenir SQL Injection usando consultas preparadas
    $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
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
    }}

    function VerificaEmailNoReturnDados($email) {
        // Criar uma instância da classe Connection
        $conexao = getConnection();
        
        // Prevenir SQL Injection usando consultas preparadas
        $stmt = $conexao->prepare("SELECT COUNT(*) as total FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
    
        // Obter o total de registros com o email fornecido
        $total = $resultado->fetch_assoc()['total'];
    
        // Retorna true se houver registros, false caso contrário
        return $total > 0;
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