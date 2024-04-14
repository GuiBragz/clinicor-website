<?php
    class Usuario {
        // Atributos.
        private $usuarioid;

        private $email;
        private $senha;
        private $tipo;
        private $dataRegistro;

        // Método construtor.
        public function __construct($usuarioid, $email, $senha, $tipo, $dataRegistro) {
            $this->usuarioid = $usuarioid;

            $this->email = $email;
            $this->senha = $senha;
            $this->tipo = $tipo;
            // Convertendo a data de registro para um objeto DateTime.
            $this->dataRegistro = new DateTime($dataRegistro);
        }

        // Getters.
        public function getusuarioid(){
            return $this->usuarioid;
        }





        public function getEmail() {
            return $this->email;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getDataRegistro() {
            return $this->dataRegistro;
        }

        // Setters.
        public function setusuarioid($usuarioid) {
        $this->usuarioid = $usuarioid;
        }




        public function setEmail($email) {
            $this->email = $email;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function setDataRegistro($dataRegistro) {
            $this->dataRegistro = new DateTime($dataRegistro);
        }

        // Método para exibir informações do usuário.
        public function exibirInfo() {
            echo "Usuarioid: ". $this->usuarioid . "<br>";
            echo "Email: " . $this->email . "<br>";
            echo "Tipo: " . $this->tipo . "<br>";
        
            // Use $this->dataRegistro para acessar a data de registro e chamar o método format().
            echo "Data de Registro: " . $this->dataRegistro->format('d/m/Y') . "<br>";
        }
    }
?>