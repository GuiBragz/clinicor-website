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
    if (tipoUsuario === "paciente") {
        primeiroIframe.src = "barraUser.html";
    } else if (tipoUsuario === "normal" || tipoUsuario === null) {
        primeiroIframe.src = "barra.html";
    }
}