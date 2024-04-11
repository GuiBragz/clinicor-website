var tema = false;
var elementos = document.querySelectorAll('.texto');
var especialidades = document.querySelectorAll('.especialidades');
var convenios = document.querySelectorAll('.convenios');
var medicos = document.querySelectorAll('.medicos');
var rede = document.querySelectorAll('.rede');

window.addEventListener('message', function(event) {
    if (event.data === 'alterarEstilo') {
        // Altera o estilo da página como desejado

        if (tema == false) {
            document.body.style.backgroundImage = 'url(../images/home-background2.png)';
            tema = true;

            elementos.forEach(function(elemento) {
                elemento.style.color = 'white';
            });

            especialidades.forEach(function(especialidade) {
                especialidade.src = '../images/icon/item 1 pbaixo home 2.png';
            });

            convenios.forEach(function(convenios) {
                convenios.src = '../images/icon/item 2 pbaixo home 2.png';
            });

            medicos.forEach(function(medicos) {
                medicos.src = '../images/icon/item 3 pbaixo home 2.png';
            });

            rede.forEach(function(rede) {
                rede.style.color = 'white';
            });

        }
        else {
            document.body.style.backgroundImage = 'url(../images/home-background.png)';
            tema = false;
            elementos.forEach(function(elemento) {
                elemento.style.color = '#A93A2F';
            });

            especialidades.forEach(function(especialidade) {
                especialidade.src = '../images/icon/item 1 pbaixo home.png';
            });

            convenios.forEach(function(convenios) {
                convenios.src = '../images/icon/item 2 pbaixo home.png';
            });

            medicos.forEach(function(medicos) {
                medicos.src = '../images/icon/item 3 pbaixo home.png';
            });

            rede.forEach(function(rede) {
                rede.style.color = '#A93A2F';
            });
        }
    }
});


