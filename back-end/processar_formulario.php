<?php
// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    // Processa os dados conforme necessário
    // Por exemplo, você pode salvar os dados em um banco de dados ou enviar um e-mail de confirmação
    // Aqui estamos apenas imprimindo os dados para fins de demonstração
    echo "Nome: " . $nome . "<br>";
    echo "E-mail: " . $email . "<br>";
    // Adicione aqui o restante do processamento dos dados
}
?>
