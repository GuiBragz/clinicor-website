<?php
    // Função para estabelecer conexão com o banco de dados.
    function getConnection() {
        $server = 'localhost';
        $username = 'root';
        $password = '3838jaum';
        $dbname = 'clinicordb';

        // Conectar com o banco de dados.
        $conexao = new mysqli($server, $username, $password, $dbname);

        // Verificar se há erros na conexão
        if ($conexao->connect_error) {
            die("Conexão falhou: " . $conexao->connect_error);
        }

        return $conexao;
    }
?>