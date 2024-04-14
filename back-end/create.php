<?php
    // Importar o arquivo da conexão do banco de dados.
    include_once 'connection.php';

    // Função que verifica se já existe um usuário com o mesmo cpf ou email.
    function usuarioJaExiste($conexao, $cpf, $email) {
        $count = 0;

        $stmt = $conexao->prepare("SELECT COUNT(*) FROM usuarios WHERE cpf = ? OR email = ?");
        $stmt->bind_param("ss", $cpf, $email);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        return $count > 0;
    }

    // Funcção para cadastrar um novo usuário.
    function cadastrarUsuarioPaciente($nomeCompleto, $cpf, $email, $senha) {
        $conexao = getConnection();
        if (usuarioJaExiste($conexao, $cpf, $email)) {
            echo "<script>window.alert('Erro ao cadastrar usuário! Email ou CPF já existem.');</script>";
            echo "<script>window.location.href = '../cadastro.html';</script>";
            exit;
        }

        // Funcção para inserir dados na tabela usuários.
        $stmt = $conexao->prepare("INSERT INTO usuarios (nome, cpf, email, senha, tipo, DataRegistro) VALUES (?, ?, ?, ?, 'paciente', NOW())");
        // Preenche os espaços em branco (as interrogações) com os valores reais.
        $stmt->bind_param("ssss", $nomeCompleto, $cpf, $email, $senha);

        // Executar a função SQL.
        if ($stmt->execute()) {
            echo "<script>window.alert('Cadastro realizado com sucesso!');</script>";
            echo "<script>window.location.href = '../login.html';</script>";
        } else {
            echo "<script>window.alert('Ocorreu um erro tente novamente em instantes!');</script>";
            echo "<script>window.location.href = '../cadastro.html';</script>";
        }

        $stmt->close();
        $conexao->close();
    }

    // Verifica se o método de requisição HTTP é do tipo "POST".
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário.
        $nomeCompleto = $_POST["nome-completo"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        // Executa a função.
        cadastrarUsuarioPaciente($nomeCompleto, $cpf, $email, $senha);
    }
?>