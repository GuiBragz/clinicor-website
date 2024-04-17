<?php
include_once 'crud/read.php';
include_once 'models/usuario.php';
include_once 'crud/update.php';
include_once 'connection.php';

// Incluir o arquivo do PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; 

//Função para gerar um codigo aleatorio
    function geradorCodigoEmail(){
    
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $codigo = '';
    
        for ($i = 0; $i < 8; $i++) {
            $codigo .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }
    
        return $codigo;
    }


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
        
        $mail->CharSet = 'UTF-8';
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
    $codigoaleatorio = geradorCodigoEmail();

    if(VerificaEmailNoReturnDados($email)){

    inserirCodigoRecuperaIndb($email, $codigoaleatorio );

    // se o formulario foi submetido via post ele cama função enviar email e mostra um pop-up dizendo que o email foi enviado com sucesso
    if (enviarEmail($email, 'Recuperação de senha', '
    <!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Emailt</title>
            <style>
                body {
                    height: 200px; /* Altura do container */
                    font-family: Arial, Helvetica, sans-serif;
                }
                h1 {
                    color: #FEA625;
                }
                h4 {
                    color: #a93a2f;
                }
            </style>
    </head>
    <body>
        <h1><b>Olá, recebemos sua solicitação de nova senha!</b></h1>
        <h2><i>Aqui está seu código: ' . $codigoaleatorio . '  </i></h2> <br>
        <br>
        <br>
        <h2><i>Por favor, clique no link a seguir para redefinir sua senha: <a href="http://localhost/inter3-copia/cadastro_nova_senha.html">Clique Aqui</a></i></h2> <br>
        <h4>Caso tenha alguma dúvida ou precise de assistência, <br> não hesite em entrar em contato conosco. <br> Estamos sempre prontos para ajudar.</h4>
        
        <h4>Obrigado por escolher a <B>CLINICOR</B>. <br> Estamos ansiosos para proporcionar a melhor <br> experiência possível para você.</h4>
        <h4>Tenha um ótimo dia!</h4>
        <br>
        <h4>Atenciosamente, <br>
        <b><i>EQUIPE CLINICOR</i></b></h4>
    </body>
    </html>')) 
    
    {
        echo "<script>window.alert('Email de recuperação enviado com sucesso!');</script>";
        echo "<script>window.location.href = '../index.html';</script>";
    // se o formulario não for enviado ele mostra um pop-up dizendo que não foi possivel enviar o email e o redireciona novamente para pagina de recuperar senha
    } else {
        echo "<script>window.alert('Erro ao tentar enviar email, tente novamente em instanteees!');</script>";
        echo "<script>window.location.href = '../cadastro_recuperar_senha.html';</script>";
    }
} else {
    // Se o formulário não foi submetido via POST, redireciona para a página de cadastro_recuperar_senha.php
    echo "<script>window.alert('Email não cadastrado!');</script>";
    echo "<script>window.location.href = '../cadastro_recuperar_senha.html';</script>";
}
}    echo "<script>window.alert('Erro ao tentar enviar email, tente novamente em instanteas!');</script>";
    echo "<script>window.location.href = '../cadastro_recuperar_senha.html';</script>";
?>