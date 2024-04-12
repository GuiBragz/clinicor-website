<?php
    // Função para estabelecer conexão com o banco de dados.
    function getConnection() {
        $server = 'localhost';
        $username = 'root';
        $password = '3838jaum';
        $bdname = 'clinicordb';

        // Conectar com o banco de dados.
        $conexao = mysqli_connect($server, $username, $password, $bdname);

        // Se a conexão for verdadeira, irá conectar com o banco de dados. Caso contrário, irá mostra um erro de conexão.
        if (!$conexao) {
            die("Conexao falhou: " . mysqli_connect_error());
        } else {
            echo "Conexão com o banco de dados estabelecida. <br>";
            return $conexao;
        }
    }
?>