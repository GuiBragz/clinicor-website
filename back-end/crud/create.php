<?php
    // Importar o arquivo da conexão do banco de dados.
    include_once 'connection.php';

    // Função que verifica se já existe um usuário com o mesmo email.
    function usuarioJaExiste($conexao, $email) {
        $count = 0;

        $stmt = $conexao->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        return $count > 0;
    }
    function funcionarioJaExiste($conexao, $nome, $foto, $cargo, $setor, $dataContratacao, $salario) {
        $count = 0;
    
        // Preparar a consulta SQL
        $stmt = $conexao->prepare("SELECT COUNT(*) FROM funcionario WHERE nome = ? AND foto = ? AND cargo = ? AND setor = ? AND dataContratacao = ? AND salario = ?");
        $stmt->bind_param("ssssss", $nome, $foto, $cargo, $setor, $dataContratacao, $salario);
        
        // Executar a consulta
        $stmt->execute();
        
        // Buscar o resultado da contagem
        $stmt->fetch();
        
        // Fechar a consulta
        $stmt->close();
        
        // Retornar true se a contagem for maior que 0, caso contrário, retornar false
        return $count > 0;
    }

    function cadastrarUsuario($email, $senha) {
        $conexao = getConnection();
    
        // Verifica se o email já está em uso
        if(usuarioJaExiste($conexao, $email)) {
            echo "<script>window.alert('Erro ao cadastrar usuário! Email já está em uso');</script>";
            echo "<script>window.location.href = '../cadastro_user.html';</script>";
            exit;
        }
    
        // Criptografa a senha antes de salvar no banco de dados
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    
        // Insere os dados na tabela usuários
        $stmt = $conexao->prepare("INSERT INTO usuarios (email, senha, tipo, DataRegistro) VALUES (?, ?, 'paciente', NOW())");
        $stmt->bind_param("ss", $email, $senhaCriptografada);
    
        // Executa a função SQL
        if ($stmt->execute()) {
            echo "<script>window.alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = '../login.html';</script>";
        } else {
            echo "<script>window.alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
            echo "<script>window.location.href = '../cadastro_user.html';</script>";
        }
    
        $stmt->close();
        $conexao->close();
    }

    function cadastrarFuncionario($email, $senha, $nome, $foto, $cargo, $setor, $dataContratacao, $salario) {
        // Criar uma instância da classe Connection
        $conexao = getConnection();
        
        // Criptografar a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
        
        // Verificar se o usuário ou funcionário já existe
        if(usuarioJaExiste($conexao, $email) || funcionarioJaExiste($conexao, $nome, $foto, $cargo, $setor, $dataContratacao, $salario)) {
            echo "<script>window.alert('Dados já em uso!');</script>";
            echo "<script>window.location.href = '../cadastro_user.html';</script>";
            exit;
        }
    
        // Tentar executar as consultas SQL
        try {
            // Preparar e executar a primeira consulta SQL para inserir na tabela 'usuarios'
            $stmt1 = $conexao->prepare("INSERT INTO Usuarios (Email, Senha, Tipo, DataRegistro) VALUES (?, ?, 'funcionario', NOW())");
            $stmt1->bind_param("ss", $email, $senhaCriptografada);
            $stmt1->execute();
            
            // Obter o ID do usuário inserido
            $usuarioID = $stmt1->insert_id;
            
            // Preparar e executar a segunda consulta SQL para inserir na tabela 'funcionario'
            $stmt2 = $conexao->prepare("INSERT INTO Funcionarios (foto, Nome, Cargo, Setor, DataContratacao, Salario, UsuarioID) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt2->bind_param("ssssssi", $foto, $nome, $cargo, $setor, $dataContratacao, $salario, $usuarioID);
            $stmt2->execute();
            
            // Verificar se ambas as consultas foram bem-sucedidas
            if ($stmt1->affected_rows > 0 && $stmt2->affected_rows > 0) {
                // Redirecionar o usuário para a página de login após o cadastro bem-sucedido
                echo "<script>window.alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>window.location.href = '../login.html';</script>";
            } else {
                // Se alguma das inserções falhar, lançar uma exceção
                throw new Exception("Erro ao cadastrar funcionário.");
            }
        } catch (Exception $e) {
            // Se ocorrer um erro, mostrar uma mensagem de erro e redirecionar o usuário para a página de cadastro novamente
            echo "<script>alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
            echo "<script>window.location.href = '../cadastro_user.html';</script>";
        }
    }
    

    function cadastraPaciente($email, $nome, $dataNascimento, $genero, $endereco, $numeroTelefone, $planoSaudeID){
        // Criar uma instância da classe Connection
        $conexao = getConnection();
        
        // Verificar se o usuário ou funcionário já existe
        if(usuarioJaExiste(pacienteJaExiste($conexao, $nome, $foto, $cargo, $setor, $dataContratacao, $salario))) {
            echo "<script>window.alert('Dados já em uso!');</script>";
            echo "<script>window.location.href = '../cadastro_user.html';</script>";
            exit;
        }else{
    
        // Tentar executar as consultas SQL
        try {
            // Preparar e executar a primeira consulta SQL para inserir na tabela 'usuarios'
            $stmt1 = $conexao->prepare("INSERT INTO pacientes (Email, Senha, Tipo, DataRegistro) VALUES (?, ?, 'funcionario', NOW())");
            $stmt1->bind_param("ss", $email, $senhaCriptografada);
            $stmt1->execute();
            
            // Obter o ID do usuário inserido
            $usuarioID = $stmt1->insert_id;
            
            
            // Verificar se ambas as consultas foram bem-sucedidas
            if ($stmt1->affected_rows > 0) {
                // Redirecionar o usuário para a página de login após o cadastro bem-sucedido
                echo "<script>window.alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>window.location.href = '../login.html';</script>";
            } else {
                // Se alguma das inserções falhar, lançar uma exceção
                throw new Exception("Erro ao cadastrar funcionário.");
            }
        } catch (Exception $e) {
            // Se ocorrer um erro, mostrar uma mensagem de erro e redirecionar o usuário para a página de cadastro novamente
            echo "<script>alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
            echo "<script>window.location.href = '../cadastro_user.html';</script>";
        }}




    }






?>