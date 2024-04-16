<?php
include_once 'back-end/crud/read.php';
include_once 'back-end/models/usuario.php';

// Incluir o arquivo do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

// Função para enviar e-mail
function enviarEmail($destinatario, $assunto, $corpo) {
    // Instanciar o objeto do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor usado pra enviar email no caso SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Endereço do servidor SMTP
        $mail->SMTPAuth   = true;
        $mail->Username   = 'clinicor458@gmail.com'; // Email usado como remtente
        $mail->Password   = 'oqyg uvot bexf iboc'; // Senha do seu email remetente
        $mail->SMTPSecure = 'ssl'; // Determina o portocolo de segurança usado no envio do email
        $mail->Port       = 465;

        // Configurações do e-mail
        $mail->setFrom('clinicor458@gmail.com', 'Clinicor');
        $mail->addAddress($destinatario, $destinatario);
        $mail->addReplyTo('clinicor458@gmail.com', 'Clinicor');

        // Conteúdo do e-mail
        $mail->isHTML(true); // Definir como e-mail HTML
        $mail->Subject = $assunto;
        $mail->Body    = $corpo;
        $mail->AltBody = 'Use o link a seguir para redefinir a senha: http://localhost/inter3-copia/cadastro_nova_senha.html';

        // Enviar e-mail
        $mail->send();
        return true; // Retorna true se o e-mail for enviado com sucesso
    } catch (Exception $e) {
        return false; // Retorna false se houver um erro ao enviar o e-mail
    }
}

// Verifica se o formulário foi submetido via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém o e-mail do formulário
    $email = $_POST["email"];

    // se o formulario foi submetido via post ele cama função enviar email e mostra um pop-up dizendo que o email foi enviado com sucesso
    if (enviarEmail($email, 'Recuperação de senha', 'Por favor, clique no link a seguir para redefinir sua senha: <a href="http://localhost/inter3-copia/cadastro_nova_senha.html">Clique aqui</a>')) {
        echo "<script>window.alert('Email de recuperação enviado com sucesso!');</script>";
        echo "<script>window.location.href = '../home.html';</script>";
    // se o formulario não for enviado ele mostra um pop-up dizendo que não foi possivel enviar o email e o redireciona novamente para pagina de recuperar senha
    } else {
        echo "<script>window.alert('Erro ao tentar enviar email, tente novamente em instantes!');</script>";
        echo "<script>window.location.href = '../cadastro_recuperar_senha.html';</script>";
    }
} else {
    // Se o formulário não foi submetido via POST, redireciona para a página de cadastro_recuperar_senha.php
    echo "<script>window.alert('Erro ao tentar enviar email, tente novamente em instantes!');</script>";
    echo "<script>window.location.href = '../cadastro_recuperar_senha.html';</script>";
}
?>