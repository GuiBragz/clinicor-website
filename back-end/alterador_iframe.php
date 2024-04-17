


<link rel="stylesheet" href="../cssbarra.css">

<?php
// esse arquvio deveria determina a navebar dependendo do usuario porem não esta sendo usado 

include_once "read.php";
include_once "models/usuario.php";



// Função para determinar o conteúdo do iframe com base no tipo de usuário
function determinarURLConteudo($tipoUsuario) {
    // Dependendo do tipo de usuário, defina o conteúdo do iframe
    $conteudo = '';
    if ($tipoUsuario === 'paciente') {
        $conteudo = file_get_contents('../barra_user.html');
    } elseif ($tipoUsuario === 'funcionario') {
        $conteudo = file_get_contents('../barra_funcionario.html');
    } else {
        // Caso padrão ou tratamento de erros
        $conteudo = file_get_contents('/barra_padrao.html');
    }

    // Retorna o conteúdo do arquivo
    return $conteudo;
}

// Verifica se o usuário está autenticado
if(isset($_SESSION['usuario_email'])) { 
    $email = $_SESSION['usuario_email'];
    $tipoUsuario = buscarUsuarioPorEmail($email)->getTipo();

    // Obtém o conteúdo do iframe com base no tipo de usuário
    $iframeConteudo = determinarURLConteudo($tipoUsuario);

    // Substitui o conteúdo do iframe pelo conteúdo obtido
    echo $iframeConteudo;
} else {
    // Se o usuário não estiver autenticado, exibe uma mensagem de erro
    echo "Usuário não autenticado."; 
}
?>