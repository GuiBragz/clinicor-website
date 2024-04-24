<?php
// Incluindo os arquivos necessários
include_once 'crud/read.php';
include_once 'connection.php';
include_once 'models/usuario.php';

// Função para alterar a barra de navegação
function alteradornavebar() {
    // Verifica se a sessão está ativa e se o email do usuário está definido na sessão
    if (isset($_SESSION['usuario_email'])) {
        // Email da sessão
        $email = $_SESSION['usuario_email'];

        
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
        } else {
            
            echo '<iframe src="barra.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';

            // Se não houver resultados, retorna null
            $conexao->close();
            return null;
        }

        // Verifica o tipo do usuário e carrega a barra de navegação apropriada
        if ($usuario) {
            $tipo = $usuario->getTipo(); // Supondo que a função para obter o tipo seja getTipo()

            // Carrega a barra de navegação de acordo com o tipo de usuário
            if ($tipo == "paciente") {
                echo '<iframe src="barra_user.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            } elseif ($tipo == "funcionario") {
                echo '<iframe src="barraFuncionario.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            } elseif ($tipo == "adm") {
                echo '<iframe src="barra_admoverpower.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            } elseif ($tipo == null) {
                echo '<iframe src="barra.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
            }
        } else {
            
            echo '<iframe src="barra.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
        }
    } else {
    
        // Se a sessão não estiver ativa, carrega uma barra de navegação padrão
        echo '<iframe src="barra.html" width="100%" height="110px" frameborder="0" class="iframe" id="navebar"></iframe>';
    }
}

?>
