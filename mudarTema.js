// Verificar se o tema foi previamente escolhido pelo usuário, caso contrário, usar tema padrão
var temaEscolhido = localStorage.getItem('temaEscolhido');
if (temaEscolhido === null) {
    temaEscolhido = 'dia'; // Ou 'noite' dependendo do tema padrão
    localStorage.setItem('temaEscolhido', temaEscolhido);
} else {
    aplicarTema(temaEscolhido); // Aplicar o tema ao carregar a página se já foi escolhido
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

// Função para o usuário mudar o tema e enviar a mensagem para alterar o estilo
function mudarTema() {
    var temaAtual = localStorage.getItem('temaEscolhido');
    var novoTema = temaAtual === 'dia' ? 'noite' : 'dia';
    localStorage.setItem('temaEscolhido', novoTema);
    aplicarTema(novoTema);

    // Enviar a mensagem para o elemento pai
    window.parent.postMessage('alterarEstilo', '*');
}