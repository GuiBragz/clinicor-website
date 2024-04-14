<?php
    include_once 'connection.php';
    include_once 'models/usuario.php';

    // Função para verificar as credenciais no banco de dados
    function verificarCredenciaisNoBanco($email, $senha) {
        // Criar uma instância da classe Connection
        $conexao = getConnection();

        // Faz uma query no MySQL para verificar se as credenciais estão corretas
        $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $resultado = $conexao->query($sql);

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
            $dadosUsuario['Nome'],
            $dadosUsuario['CPF'],
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

    // Função para realizar o login
    function login($email, $senha){

        // Se as credenciais estiverem corretas, busca o usuário e redireciona para a página home
        if(verificarCredenciaisNoBanco($email, $senha)){
            $usuario = buscarUsuarioPorEmail($email);
            echo "<script>window.alert('Login realizado com sucesso!');</script>";
            echo "<script>window.location.href = '../home.html';</script>";
            
            
            


            // Se as credenciais estiverem incorretas, exibe mensagem de erro e redireciona para a página de login
            }else{
                echo "<script>window.alert('Email ou senha incorretos!');</script>";
                echo "<script>window.location.href = '../login.html';</script>";
                
                
            } 
        }
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtém os dados do formulário
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        
        // Executa a função
        login($email, $senha);
        

    }
?>