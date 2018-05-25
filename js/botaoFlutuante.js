/**
 * CARREGA A FUNÇÃO DO BOTÃO FLUTUANTE QUANDO AS PÁGINAS SÃO (RE)CARREGADAS
 */
$(document).ready(function(){
    exibirOpcoes();
});
/**
 * CARREGA A FUNÇÃO DO BOTÃO FLUTUANTE QUANDO HÁ REQUISIÇÕES AJAX
 */
$(document).ajaxComplete(function(){
    exibirOpcoes();
});
/**
 * CONFIGURAÇÕES PARA ABRIR/FECHAR AS OPÇÕES DO BOTÃO FLUTUANTE
 * @returns NENHUM
 */
function exibirOpcoes(){
    
    // QUANDO O USUÁRIO CLICAR NO BOTÃO FLUTUANTE
    $('#btnFlutuante').each(function(i, e){
        $(e)[0].onclick = function(){            
            $('#btnFlutuante > .opcoesFlutuantes').css("visibility", $('#btnFlutuante > .opcoesFlutuantes').css("visibility")==="visible"?"hidden":"visible");
        };
    });
    
    // QUANDO O USUÁRIO CLICA FORA DO BOTÃO FLUTUANTE
    window.onclick = function(event) {
        if (event.target !== $('#btnFlutuante')[0]) {
            $('.opcoesFlutuantes').css("visibility", "hidden");
        }
    };
    
    //QUANDO O USUÁRIO APERTA 'ESC' NO TECLADO
    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // A TECLA ESC É REPRESENTADA PELO NÚMERO 27
            if($('.opcoesFlutuantes')[0]){
                $('.opcoesFlutuantes').css("visibility", "hidden");
            }
       }
    });
    
}