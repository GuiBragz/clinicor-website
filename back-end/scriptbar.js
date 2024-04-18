// Função para fazer uma requisição AJAX
function fazerRequisicao() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Atualiza o conteúdo da div com o resultado da requisição
            document.getElementById("resultado").innerHTML = this.responseText;
        }
    };
    // Faz a requisição para o arquivo PHP
    xhttp.open("GET", "alteradornavebar.php", true);
    xhttp.send();
}

// Chama a função quando a página é carregada
window.onload = fazerRequisicao;