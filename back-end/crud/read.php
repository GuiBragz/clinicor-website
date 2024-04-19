<?php
    session_start();

    


    // Função para verificar as credenciais no banco de dados
    function verificarCredenciaisNoBanco($email, $senha) {
        // Criar uma instância da classe Connection
        include_once './back-end/connection.php';
        include_once './back-end/models/usuario.php';
        include_once './back-end/models/funcionario.php';
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
        include_once './back-end/connection.php';
        include_once './back-end/models/usuario.php';
        include_once './back-end/models/funcionario.php';



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
            include_once './back-end/connection.php';
            include_once './back-end/models/usuario.php';
            include_once './back-end/models/funcionario.php';


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
                include_once './back-end/connection.php';
                include_once './back-end/models/usuario.php';
                include_once './back-end/models/funcionario.php';


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

            
    // Função para preencher um array com os dados da tabela Funcionarios
    function preencherArrayFuncionarios($conn) {
        

        include_once '../back-end/connection.php';
        include_once '../back-end/models/usuario.php';
        include_once '../back-end/models/funcionario.php';
        // Array para armazenar os funcionários
        $funcionarios = array();
        // Obtendo a conexão com o banco de dados
        $conexao = getConnection();

        // Query SQL para selecionar todos os funcionários da tabela Funcionarios
        $sql = "SELECT * FROM Funcionarios WHERE cargo = 'Medico'";
        // Executar a query
        $result = $conexao->query($sql);

        // Verificar se há resultados e preencher o array com os dados
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Criar um objeto Funcionario com os dados do funcionário
                $funcionario = new Funcionario(
                    $row['FuncionarioID'],
                    $row['Nome'],
                    $row['Cargo'],
                    $row['Setor'],
                    $row['DataContratacao'],
                    $row['Salario'],
                    $row['UsuarioID']
                );
                // Adicionar o funcionário ao array
                $funcionarios[] = $funcionario;
            }
        }

        // Retornar o array de funcionários preenchido
        return $funcionarios;
    }

    function verificarSeUsuarioTemPaciente() {
        include_once '../back-end/connection.php';
        include_once '../back-end/models/usuario.php';
        include_once '../back-end/models/funcionario.php';
    
        // Verifica se a sessão está ativa
        if (isset($_SESSION['usuario_email'])) {
            // Obtém o email da sessão
            $conexao = getConnection();
            $email = $_SESSION['usuario_email'];
    
            $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            // Verifica se a consulta retornou algum resultado
            if ($resultado->num_rows > 0) {
                // Obtém a linha de resultado como um array associativo
                $dadosUsuario = $resultado->fetch_assoc();
                // Obtém o ID do usuário
                $userid = $dadosUsuario['UsuarioID'];
    
                // Criar uma instância da classe Connection
                
                
                // Prevenir SQL Injection usando consultas preparadas
                $stmt = $conexao->prepare("SELECT COUNT(*) as total FROM pacientes WHERE usuarioid = ?");
                $stmt->bind_param("i", $userid); // Corrigido para "i" para um inteiro
                $stmt->execute();
                $resultado = $stmt->get_result();
            
                // Obter o total de registros com o usuarioid fornecido
                $total = $resultado->fetch_assoc()['total'];
            
                // Retorna true se houver registros, false caso contrário
                return $total > 0;
            } else {
                // Se o usuário não for encontrado, retorna false
                return false;
            }
        } else {
            // Se a sessão não estiver ativa, retorna false
            return false;
        }
    }
?>