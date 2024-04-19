<?php
    // Importar o arquivo da conexão do banco de dados.
    include_once 'connection.php';
    include_once 'crud/read.php';

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
    function funcionarioJaExiste($conexao, $nome, $cargo, $setor, $dataContratacao, $salario) {
        $count = 0;
    
        // Preparar a consulta SQL
        $stmt = $conexao->prepare("SELECT COUNT(*) FROM funcionario WHERE nome = ? AND cargo = ? AND setor = ? AND dataContratacao = ? AND salario = ?");
        $stmt->bind_param("ssssss", $nome, $cargo, $setor, $dataContratacao, $salario);
        
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

    function cadastrarFuncionario($email, $senha, $nome, $cargo, $setor, $dataContratacao, $salario) {
        // Criar uma instância da classe Connection
        $conexao = getConnection();
    
        // Criptografar a senha
        $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);
    
        // Verificar se o usuário já existe
        if (usuarioJaExiste($conexao, $email)) {
            echo "<script>window.alert('Email já em uso!');</script>";
            echo "<script>window.location.href = '../cadastro_funcionario.html';</script>";
            exit;
        }
    
        // Preparar e executar a consulta SQL para inserir na tabela 'usuarios'
        $stmt1 = $conexao->prepare("INSERT INTO Usuarios (Email, Senha, Tipo, DataRegistro) VALUES (?, ?, 'funcionario', NOW())");
        $stmt1->bind_param("ss", $email, $senhaCriptografada);
        $stmt1->execute();
    
        // Obter o ID do usuário inserido
        $usuarioID = $stmt1->insert_id;
    
        // Preparar e executar a consulta SQL para inserir na tabela 'funcionarios'
        $stmt2 = $conexao->prepare("INSERT INTO Funcionarios (Nome, Cargo, Setor, DataContratacao, Salario, UsuarioID) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("sssssi", $nome, $cargo, $setor, $dataContratacao, $salario, $usuarioID);
        $stmt2->execute();
    
        // Verificar se ambas as consultas foram bem-sucedidas
        if ($stmt1->affected_rows > 0 && $stmt2->affected_rows > 0) {
            // Redirecionar o usuário para a página de login após o cadastro bem-sucedido
            echo "<script>window.alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = '../login.html';</script>";
        } else {
            echo "<script>window.alert('Erro ao cadastrar funcionário!');</script>";
            echo "<script>window.location.href = '../login.html';</script>";
        }
    }
    
    
    
    
    
    

    function cadastraPaciente($nome, $dataNascimento, $genero, $endereco, $numeroTelefone, $planoSaudeNome, $planoSaudeCobertura) {
        // Criar uma instância da classe Connection
        $conexao = getConnection();
        $usuarioID = null; // Inicializar a variável $usuarioID
        
        // Verificar se o usuário está logado
        if (isset($_SESSION['usuario_email'])) {
            $email = $_SESSION['usuario_email'];
            $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();
    
            // Verifica se a consulta retornou algum resultado
            if ($resultado->num_rows > 0) {
                // Obtém a linha de resultado como um array associativo
                $dadosUsuario = $resultado->fetch_assoc();
                // Obtem o ID do usuário
                $usuarioID = $dadosUsuario['UsuarioID'];
            } else {
                // Se o usuário não estiver logado, exibir mensagem de erro e redirecionar
                echo "<script>window.alert('Erro: Usuário não encontrado.');</script>";
                echo "<script>window.location.href = '../cadastro_paciente.html';</script>";
                exit(); // Importante adicionar exit() após o redirecionamento
            }
        } else {
            // Se a sessão do usuário não estiver ativa, exibir mensagem de erro e redirecionar
            echo "<script>window.alert('Erro: Sessão do usuário não encontrada.');</script>";
            echo "<script>window.location.href = '../cadastro_paciente.html';</script>";
            exit(); // Importante adicionar exit() após o redirecionamento
        }
        
        // Tentar executar a consulta SQL
        
            // Inserir o paciente na tabela 'Pacientes'
            $stmtPaciente = $conexao->prepare("INSERT INTO Pacientes (Nome, DataNascimento, Genero, Endereco, NumeroTelefone, UsuarioID) VALUES (?, ?, ?, ?, ?, ?)");
            $stmtPaciente->bind_param("sssssi", $nome, $dataNascimento, $genero, $endereco, $numeroTelefone, $usuarioID);
            $stmtPaciente->execute();
    
            // Verificar se a inserção foi bem-sucedida
            if ($stmtPaciente->affected_rows > 0) {
                // Inserir o plano de saúde na tabela 'PlanosSaude'
                $stmtPlanoSaude = $conexao->prepare("INSERT INTO PlanosSaude (NomePlano, Cobertura, UsuarioID) VALUES (?, ?, ?)");
                $stmtPlanoSaude->bind_param("ssi", $planoSaudeNome, $planoSaudeCobertura, $usuarioID);
                $stmtPlanoSaude->execute();
    
                // Verificar se a consulta foi bem-sucedida
                if ($stmtPlanoSaude->affected_rows > 0) {
                    // Se tudo estiver bem, retornar true
                    return true;
                } else {
                    // Se houver um erro ao inserir o plano de saúde, exibir mensagem de erro e redirecionar
                    echo "<script>window.alert('Erro ao inserir plano de saúde.');</script>";
                    echo "<script>window.location.href = '../cadastro_paciente.html';</script>";
                    exit(); // Importante adicionar exit() após o redirecionamento
                }
            } else {
                // Se houver um erro ao inserir o paciente, exibir mensagem de erro e redirecionar
                echo "<script>window.alert('Erro ao inserir paciente.');</script>";
                echo "<script>window.location.href = '../cadastro_paciente.html';</script>";
                exit(); // Importante adicionar exit() após o redirecionamento
            }
    }



?>