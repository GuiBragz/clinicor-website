// Verificar se o tema foi previamente escolhido pelo usuário, caso contrário, usar tema padrão
var temaEscolhido = localStorage.getItem('temaEscolhido');
if (temaEscolhido === null) {
    temaEscolhido = 'dia'; // Ou 'noite' dependendo do tema padrão
    localStorage.setItem('temaEscolhido', temaEscolhido);
}

// Função para aplicar o tema escolhido pelo usuário
function aplicarTema(tema) {
    var body = document.body;
    var linkElement = document.getElementById('link');
    var imagemTema = document.getElementById('tema');
    var imagemNavebar = document.getElementById('navebar');
    var imagemLogo = document.getElementById('imagem');

    if (tema === 'noite') {
        body.classList.add('tema-escuro');
        linkElement.classList.add('linkEscuro');
        imagemTema.src = 'images/icon/lua tema.png';
        imagemNavebar.src = 'images/icon/barra l noite.png';
        imagemLogo.src = 'images/logo_clinicor noite.png';
    } else {
        body.classList.remove('tema-escuro');
        linkElement.classList.remove('linkEscuro');
        imagemTema.src = 'images/icon/sol tema.png';
        imagemNavebar.src = 'images/icon/barra l dia.png';
        imagemLogo.src = 'images/logo_clinicor dia.png';
    }
}

// Aplicar o tema escolhido ao carregar a página
aplicarTema(temaEscolhido);

// Função para o usuário mudar o tema
function mudarTema() {
    var temaAtual = localStorage.getItem('temaEscolhido');
    var novoTema = temaAtual === 'dia' ? 'noite' : 'dia';
    localStorage.setItem('temaEscolhido', novoTema);
    aplicarTema(novoTema);
}

// Enviar mensagem para alterar estilo quando necessário
window.parent.postMessage('alterarEstilo', '*');

