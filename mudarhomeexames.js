// Verifica se já existe um valor salvo para tema no localStorage
var tema = localStorage.getItem('tema') === 'true';

var elementos = document.querySelectorAll('.texto');
var especialidades = document.querySelectorAll('.especialidades');
var convenios = document.querySelectorAll('.convenios');
var medicos = document.querySelectorAll('.medicos');
var rede = document.querySelectorAll('.rede');
var rodap = document.querySelectorAll('.deadsec');
var espec = document.querySelectorAll('.espec');
var link = document.querySelectorAll('.lin');
var black = document.querySelectorAll('.black');
var iframe = document.querySelector('.iframe');
var body = document.querySelector('body'); // Adicionado para selecionar o elemento body

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

window.addEventListener('message', function(event) {
    if (event.data === 'alterarMenu' && iframe.offsetHeight === 110) {
        // Altera a altura do iframe para 210px
        iframe.style.height = '310px';
    } else {
        iframe.style.height = '110px';
    }
});

function atualizarTema() {
    if (tema) {
        // Adiciona a classe tema-escuro ao body quando o tema escuro é ativado
        body.classList.add('tema-escuro');
    } else {
        // Remove a classe tema-escuro do body quando o tema claro é ativado
        body.classList.remove('tema-escuro');
    }
}
