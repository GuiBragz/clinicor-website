document.addEventListener("DOMContentLoaded", function() {
    const botaoAlternarTema = document.getElementById("alternar-tema");
    const iconeTema = document.getElementById("icone-tema");

    // Função para definir o tema
    function definirTema(tema) {
        document.body.classList.remove("tema-claro", "tema-escuro");
        document.body.classList.add(tema);
        // Armazenar a preferência do tema em um cookie
        document.cookie = "tema=" + tema + "; expires=Fri, 31 Dec 9999 23:59:59 GMT";
    }

    // Verificar se há um tema armazenado em um cookie
    function verificarTema() {
        var temaCookie = obterCookie("tema");
        if (temaCookie === "tema-escuro") {
            definirTema("tema-escuro");
            iconeTema.classList.remove("fa-sun");
            iconeTema.classList.add("fa-moon");
        } else {
            definirTema("tema-claro");
            iconeTema.classList.remove("fa-moon");
            iconeTema.classList.add("fa-sun");
        }
    }

    // Função para obter o valor de um cookie
    function obterCookie(nome) {
        var nomeCookie = nome + "=";
        var cookies = document.cookie.split(';');
        for(var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.indexOf(nomeCookie) === 0) {
                return cookie.substring(nomeCookie.length, cookie.length);
            }
        }
        return null;
    }

    // Alterna entre os temas
    botaoAlternarTema.addEventListener("click", function() {
        const temaEscuroAtivo = document.body.classList.contains("tema-escuro");
        if (temaEscuroAtivo) {
            definirTema("tema-claro");
            iconeTema.classList.remove("fa-moon");
            iconeTema.classList.add("fa-sun");
        } else {
            definirTema("tema-escuro");
            iconeTema.classList.remove("fa-sun");
            iconeTema.classList.add("fa-moon");
        }
    });

    // Verificar o tema ao carregar a página
    verificarTema();
});

document.addEventListener("DOMContentLoaded", function() {
    // Obtém o pathname da URL atual (parte da URL após o domínio)
    var pathname = window.location.pathname;

    // Verifica qual é a página atual e adiciona a classe "ativo" ao link correspondente
    if (pathname.includes("home.html")) {
        document.getElementById("link-home").classList.add("ativo");
    } else if (pathname.includes("exames.html")) {
        document.getElementById("link-exames").classList.add("ativo");
    } else if (pathname.includes("convenios.html")) {
        document.getElementById("link-convenios").classList.add("ativo");
    } else if (pathname.includes("medicos.html")) {
        document.getElementById("link-medicos").classList.add("ativo");
    } else if (pathname.includes("especialidades.html")) {
        document.getElementById("link-especialidades").classList.add("ativo");
    } else if (pathname.includes("fale_conosco.html")) {
        document.getElementById("link-fale-conosco").classList.add("ativo");
    } else if (pathname.includes("a_clinica.html")) {
        document.getElementById("link-a-clinica").classList.add("ativo");
    }
});
