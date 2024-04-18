function obterTipoUsuario() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'entregadortipo.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var tipoUsuario = xhr.responseText;
            mostrarNavbar(tipoUsuario);
        }
    };
    xhr.send();
}

// Chama a função para obter o tipo de usuário
obterTipoUsuario();

// Função para mostrar a barra de navegação apropriada com base no tipo de usuário
function mostrarNavbar(tipoUsuario) {
    var primeiroIframe = document.getElementById('navebar'); // Seleciona o iframe pelo ID
    if (tipoUsuario === "NULL") {
        primeiroIframe.src = "../barra.html";
    } else if (tipoUsuario === "usuario" || tipoUsuario === null) {
        primeiroIframe.src = "../barra_user.html";
    } else if (tipoUsuario === "funcionario") {
        primeiroIframe.src = "../barraFuncionario.html";
    }
}
