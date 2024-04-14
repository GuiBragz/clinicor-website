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

    // Função para cadastrar um novo usuário.
    function cadastrarUsuario($email, $senha) {
        $conexao = getConnection();

        // Função verifica se o email inserido já está em uso.
        if(usuarioJaExiste($conexao, $email)) {
            // Se já estiver em uso, exibe uma mensagem de erro e redireciona para a página de cadastro.
            echo "<script>window.alert('Erro ao cadastrar usuário! Email já está em uso');</script>";
            echo "<script>window.location.href = '../cadastro.html';</script>";
            exit;
        }

        // Funcção para inserir dados na tabela usuários.
        $stmt = $conexao->prepare("INSERT INTO usuarios (email, senha, tipo, DataRegistro) VALUES (?, ?, 'funcionario', NOW())");
        // Preenche os espaços em branco (as interrogações) com os valores reais.
        $stmt->bind_param("ss", $email, $senha);

        // Executar a função SQL.
        if ($stmt->execute()) {
            echo "<script>window.alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = '../login.html';</script>";
        } else {
            echo "<script>window.alert('Ocorreu um erro, tente novamente mais tarde!');</script>";
            echo "<script>window.location.href = '../cadastro.html';</script>";
        }

        $stmt->close();
        $conexao->close();
    }

    // Verifica se o método de requisição HTTP é do tipo "POST".
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário.
        $email = $_POST["email"];
        $senha = $_POST["senha"];

        // Chama a função para cadastrar o usuário.
        cadastrarUsuario($email, $senha);
    }
?>