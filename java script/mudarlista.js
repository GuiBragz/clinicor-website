// Verifica se já existe um valor salvo para tema no localStorage
var tema = localStorage.getItem('tema') === 'true';

var elementos = document.querySelectorAll('.texto');
var subelementos = document.querySelectorAll('.subtexto');
var espec = document.querySelectorAll('.medico');

// Função para atualizar o tema da página
function atualizarTema() {
    if (tema) {
        document.body.style.backgroundImage = 'url(../images/home-background2.png)';
        elementos.forEach(function(elemento) {
            elemento.style.color = 'white';
        });
        subelementos.forEach(function(subelemento) {
            subelemento.style.color = '#FEA625';
        });
        espec.forEach(function(espec) {
            espec.style.backgroundColor = 'rgba(0, 0, 0, 0.3)';
        });

    } else {
        document.body.style.backgroundImage = 'url(../images/home-background.png)';
        elementos.forEach(function(elemento) {
            elemento.style.color = '#A93A2F';
        });
        subelementos.forEach(function(subelemento) {
            subelemento.style.color = 'black';
        });
        espec.forEach(function(espec) {
            espec.style.backgroundColor = 'rgba(255, 255, 255, 0.3)';
        });
    }
}

// Chamada inicial para atualizar o tema ao carregar a página
atualizarTema();

window.addEventListener('message', function(event) {
    if (event.data === 'alterarEstilo') {
        // Altera o estilo da página como desejado
        tema = !tema; // Inverte o valor de tema
        localStorage.setItem('tema', tema); // Salva o valor de tema no localStorage
        atualizarTema(); // Atualiza o tema da página conforme o novo valor de tema
    }
});


