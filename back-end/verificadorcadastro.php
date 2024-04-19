<?php
include_once './crud/read.php';

    // Verifica se a sessão está ativa e se o email do usuário está definido na sessão




if(verificarSeUsuarioTemPaciente()){

header("location:MarcarConsulta.html");
}else{
    echo "<script>window.alert('Prencha seus dados para que possa marcar uma consulta ou exame!');</script>";
    echo "<script>window.location.href = '../cadastro_paciente.html';</script>";
}


?>