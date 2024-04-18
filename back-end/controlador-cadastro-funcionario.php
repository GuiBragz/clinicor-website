<?php
include_once 'crud/create.php';
include_once 'models/funcionario.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário.
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nome = $_POST["Nome"]; // Corrigindo aqui para corresponder ao nome do campo no formulário
    $cargo = $_POST["Cargo"]; // Corrigindo aqui para corresponder ao nome do campo no formulário
    $setor = $_POST["Setor"]; // Corrigindo aqui para corresponder ao nome do campo no formulário
    $dataContratacao = $_POST["contrato"]; // Corrigindo aqui para corresponder ao nome do campo no formulário
    $salario = $_POST["salario"]; // Corrigindo aqui para corresponder ao nome do campo no formulário
    
    // Verifica se uma imagem foi enviada
    if (isset($_FILES["Enviar Foto"]) && $_FILES["Enviar Foto"]["error"] == 0) { // Corrigindo aqui para corresponder ao nome do campo no formulário
        // Obtém o conteúdo da imagem
        $imagem = file_get_contents($_FILES["Enviar Foto"]["tmp_name"]); // Corrigindo aqui para corresponder ao nome do campo no formulário
    } else {
        // Se não houver imagem enviada, define como vazio
        $imagem = '';
    }

    // Chama a função para cadastrar o funcionário, passando o nome do arquivo da imagem
    cadastrarFuncionario($email, $senha, $nome, $cargo, $setor, $dataContratacao, $salario, $imagem);
}
?>

