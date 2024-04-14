// Verificar se o tema foi previamente escolhido pelo usuário, caso contrário, usar tema padrão
var tema = localStorage.getItem('tema') === 'escuro' ? 'escuro' : 'claro';
aplicarTema(tema); // Aplicar o tema ao carregar a página

// Função para aplicar o tema escolhido pelo usuário
function aplicarTema(temaEscolhido) {
    var elementos = document.querySelectorAll('.texto');
    var especialidades = document.querySelectorAll('.especialidades');
    var convenios = document.querySelectorAll('.convenios');
    var medicos = document.querySelectorAll('.medicos');
    var rede = document.querySelectorAll('.rede');

    if (temaEscolhido === 'escuro') {
        document.body.style.backgroundImage = 'url(images/home-background2.png)';
        elementos.forEach(function(elemento) {
            elemento.style.color = 'white';
        });
        especialidades.forEach(function(especialidade) {
            especialidade.src = 'images/icon/item 1 pbaixo home 2.png';
        });
        convenios.forEach(function(convenio) {
            convenio.src = 'images/icon/item 2 pbaixo home 2.png';
        });
        medicos.forEach(function(medico) {
            medico.src = 'images/icon/item 3 pbaixo home 2.png';
        });
        rede.forEach(function(redeItem) {
            redeItem.style.color = 'white';
        });
    } else {
        document.body.style.backgroundImage = 'url(images/home-background.png)';
        elementos.forEach(function(elemento) {
            elemento.style.color = '#A93A2F';
        });
        especialidades.forEach(function(especialidade) {
            especialidade.src = 'images/icon/item 1 pbaixo home.png';
        });
        convenios.forEach(function(convenio) {
            convenio.src = 'images/icon/item 2 pbaixo home.png';
        });
        medicos.forEach(function(medico) {
            medico.src = 'images/icon/item 3 pbaixo home.png';
        });
        rede.forEach(function(redeItem) {
            redeItem.style.color = '#A93A2F';
        });
    }
}

// Adicionar evento para alterar o estilo quando necessário
window.addEventListener('message', function(event) {
    if (event.data === 'alterarEstilo') {
        // Alternar o tema
        tema = tema === 'escuro' ? 'claro' : 'escuro';
        // Armazenar o estado do tema no localStorage
        localStorage.setItem('tema', tema);
        // Aplicar o tema escolhido
        aplicarTema(tema);
    }
});


