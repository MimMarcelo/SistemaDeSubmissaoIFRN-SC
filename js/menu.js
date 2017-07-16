$(document).ready(function(){

    //QUANDO UMA OPÇÃO DO MENU É CLICADA
    $("nav a").click(function( e ){
            e.preventDefault();//EVITA A AÇÃO PADRÃO DA TAG, QUE NO CASO SERIA: REDIRECIONAR A PÁGINA
            
            var href = $(this).attr('href');//PEGA O ENDEREÇO DO href DA TAG
            var titulo = $(this).attr('title');//PEGA O TÍTULO DA PÁGINA NO title DA TAG
            
            //RESPONSÁVEL POR MUDAR O CONTEÚDO DA PÁGINA SEM RECARREGÁ-LA
            $.ajax({
                    url: href, //DEFINE O DESTINO
                    success: function(){
                        $('#carregaPagina').load(href+" #conteudo").fadeIn();
                                      
                        document.title = "SS IFRN-SC - "+titulo;
                        window.history.pushState({url: href}, document.title, href);
                    }
            });
    });
    window.onpopstate = function(){ 
        window.history.go(0);
    };
});