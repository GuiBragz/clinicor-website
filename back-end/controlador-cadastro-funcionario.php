<?php
include_once 'crud/create.php'; // Verifique o caminho correto do arquivo
include_once 'models/funcionario.php'; // Verifique o caminho correto do arquivo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário.
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $nome = $_POST["nome"]; // Corrigido para corresponder ao nome do campo no formulário
    $cargo = $_POST["cargo"]; // Corrigido para corresponder ao nome do campo no formulário
    $setor = $_POST["setor"]; // Corrigido para corresponder ao nome do campo no formulário
    $dataContratacao = $_POST["dataContratacao"]; // Corrigido para corresponder ao nome do campo no formulário
    $salario = $_POST["salario"]; // Corrigido para corresponder ao nome do campo no formulário

    // Obtém a data do formulário e converte para o formato correto (AAAA-MM-DD)
    

    // Verifica se uma imagem foi enviada
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        // Obtém o conteúdo da imagem
        $imagem = file_get_contents($_FILES["foto"]["tmp_name"]);



        $nomeArquivo = $email . ".jpg";
    
        // Diretório para salvar as imagens
        $diretorioImagens = "../images/medicos/"; // Substitua pelo caminho do seu diretório
    
        // Construir a URL da foto
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $diretorioImagens . $nomeArquivo)) {
            // Construir a URL da foto corretamente
            
        
            // Chama a função para cadastrar o funcionário, passando a data formatada
            cadastrarFuncionario($email, $senha, $nome, $cargo, $setor, $dataContratacao, $salario);
        } else {
            echo "<script>window.alert('Falha ao salvar a imagem!');</script>";
            echo "<script>window.location.href = '../cadastro_funcionario.html';</script>";
        }
    } else {
        // Se não houver imagem enviada, define como vazio
        $imagem = '';

        // Chama a função para cadastrar o funcionário, passando a data formatada
        ;
    }
}
?>
