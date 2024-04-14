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
            //Função para cadastrar um novo usuário funcionario.
            function cadastrarUsuarioFuncionario($nomeCompleto, $cpf, $email, $senha) {
                $conexao = getConnection();

                //função verifica se o email ou cpf inseridos ja estão em usso
                if(usuarioJaExiste($conexao, $cpf, $email)){

                // Se ja estiver em usso ele avisa com um pop-up e encaminha novamente para pagina de cadastro de funcionario
                echo "<script>window.alert('Erro ao cadastrar funcionario! Email ou CPF já estão em uso');</script>";
                echo "<script>window.location.href = '######';</script>";
                exit;
                }
                // Funcção para inserir dados na tabela usuários.
                $stmt = $conexao->prepare("INSERT INTO usuarios (nome, cpf, email, senha, tipo, DataRegistro) VALUES (?, ?, ?, ?, 'funcionario', NOW())");
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


    // Funcção para cadastrar um novo usuário paciente.
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
        // Verifica se o formulário foi submetido a partir da página de cadastro
        if (isset($_POST["pagina_origem"]) && $_POST["pagina_origem"] === "cadastro") {
            // Obtém os dados do formulário
            $nomeCompleto = $_POST["nome-completo"];
            $cpf = $_POST["cpf"];
            $email = $_POST["email"];
            $senha = $_POST["senha"];
            // Executa a função para cadastrar o usuário como paciente
            cadastrarUsuarioPaciente($nomeCompleto, $cpf, $email, $senha);
        }
        // Verifica se o formulário foi submetido a partir da página de funcionário
        elseif (isset($_POST["pagina_origem"]) && $_POST["pagina_origem"] === "funcionario") {
            // Lida com o formulário da página de funcionário
            // Adicione o código aqui para lidar com o formulário da página de funcionário
        }
    }
?>