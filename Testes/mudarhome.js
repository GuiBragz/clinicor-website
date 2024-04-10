var tema = false;
var elementos = document.querySelectorAll('.texto');

window.addEventListener('message', function(event) {
    if (event.data === 'alterarEstilo') {
        // Altera o estilo da página como desejado
        
        if (tema == false) {
            document.body.style.backgroundImage = 'url(../images/home-background2.png)';
            tema = true;
            elementos.forEach(function(elemento) {
                elemento.style.color = 'white';
            });
        }
        else {
            document.body.style.backgroundImage = 'url(../images/home-background.png)';
            tema = false;
            elementos.forEach(function(elemento) {
                elemento.style.color = '#A93A2F';
            });
        }
    }
});

