// Verifica se já existe um valor salvo para tema no localStorage
var tema = localStorage.getItem('tema') === 'true';

var especialidades_texto = document.querySelectorAll('.especialidade_boby');
var h1 = document.querySelectorAll('.titulo_');

// Função para atualizar o tema da página
function atualizarTema() {
    if (tema) {
        document.body.style.backgroundImage = 'url(../images/home-background2.png)';
        especialidades_texto.forEach(function(especialidades_texto) {
            especialidades_texto.style.color = 'white';
        });

        h1.forEach(function(h1) {
            h1.style.color = 'white';
        });
        
    } else {
        document.body.style.backgroundImage = 'url(../images/home-background.png)';
        especialidades_texto.forEach(function(especialidades_texto) {
            especialidades_texto.style.color = 'black';
        });

        h1.forEach(function(h1) {
            h1.style.color = 'black';
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