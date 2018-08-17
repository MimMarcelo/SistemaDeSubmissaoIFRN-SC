$(document).ready(function () {
    //QUANDO UMA OPÇÃO DO MENU É CLICADA
    $("li>a").click(function (e) {
        if ($(this).attr('target') === "_blank") {
            return;
        }
        e.preventDefault();//EVITA A AÇÃO PADRÃO DA TAG, QUE NO CASO SERIA: REDIRECIONAR A PÁGINA

        var href = $(this).attr('href');//PEGA O ENDEREÇO DO href DA TAG
        var titulo = $(this).attr('title');//PEGA O TÍTULO DA PÁGINA NO title DA TAG

        //RESPONSÁVEL POR MUDAR O CONTEÚDO DA PÁGINA SEM RECARREGÁ-LA
        $.ajax({
            url: href, //DEFINE O DESTINO
            success: function () {
                $('#carregaPagina').load(href + " #conteudo").fadeIn();

                document.title = "SS IFRN-SC - " + titulo;
                window.history.pushState({url: href}, document.title, href);
            }
        });
    });
    window.onpopstate = function () {
        window.history.go(0);
    };
    
});
function abreMenu() {
    var nav = document.getElementsByTagName("nav")[0];
    if (nav.className === "menuAberto") {
        nav.className = "";
    } else {
        nav.className = "menuAberto";
    }
    window.onclick = function (event) {
        if (event.target === $('nav')[0]) {
            $('nav')[0].className = "";
        }
    };

    //QUANDO O USUÁRIO APERTA 'ESC' NO TECLADO
    $(document).keyup(function (e) {
        if (e.keyCode === 27) { // A TECLA ESC É REPRESENTADA PELO NÚMERO 27
            if ($('nav')[0]) {
                $('nav')[0].className = "";
            }
        }
    });

}