var testa = false;
var teste = false;
var testi = false;
var testo = false;
var testu = false;

function mudarTema(temas) {
    window.parent.postMessage('alterarEstilo', '*');


    var body = document.body;
    body.classList.toggle("tema-escuro");

    var elemento = document.getElementById('link');
    elemento.classList.toggle('linkEscuro');

    var imagem = document.getElementById('imagem');
    if (teste == false) {
        imagem.src = 'images/logo_clinicor noite.png';
        teste = true;
    }
    else {
        imagem.src = 'images/logo_clinicor dia.png';
        teste = false;
    }


    var imagem = document.getElementById('tema');
    if (testa == false) {
        imagem.src = 'images/icon/lua tema.png';
        testa = true;
    }
    else {
        imagem.src = 'images/icon/sol tema.png';
        testa = false;
    }

    

    var imagem = document.getElementById('navebar');
    if (testi == false) {
        imagem.src = 'images/icon/barra l noite.png';
        testi = true;
    }
    else {
        imagem.src = 'images/icon/barra l dia.png';
        testi = false;
    }

    testo = !testo;
}

function mudarImagem () {
    

    if (testo == false) {
        var navebar = document.getElementById('navebar').src = 'images/icon/barra l noite.png';
    }
    else {
        var navebar = document.getElementById('navebar').src = 'images/icon/barra l dia.png';
    }
}

function restaurarImagem () {
    if (testo == true) {
        var navebar = document.getElementById('navebar').src = 'images/icon/barra l noite.png';
    }
    else {
        var navebar = document.getElementById('navebar').src = 'images/icon/barra l dia.png';
    }
}