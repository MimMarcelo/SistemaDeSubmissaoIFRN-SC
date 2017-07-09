/**
 * CARREGA A FUNÇÃO DA POPUP QUANDO AS PÁGINAS SÃO (RE)CARREGADAS
 */
$(document).ready(function(){
    popup();
});
/**
 * CARREGA A FUNÇÃO DA POPUP QUANDO HÁ REQUISIÇÕES AJAX
 */
$(document).ajaxComplete(function(){
    popup();
});
function popup(){
    
    // FUNÇÕES PARA FECHAR A POPUP
    
    // QUANDO O USUÁRIO CLICAR NO 'X' DA POPUP
    if($('#fecharPopup')[0]){
        $('#fecharPopup')[0].onclick = function() {
            $('#popup').css("display", "none");
        };
    }
    
    // QUANDO O USUÁRIO CLICA FORA DA POPUP
    window.onclick = function(event) {
        if (event.target === $('#popup')[0]) {
            $('#popup').css("display", "none");
        }
    };
    
    //QUANDO O USUÁRIO APERTA 'ESC' NO TECLADO
    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // A TECLA ESC É REPRESENTADA PELO NÚMERO 27
            if($('#popup')[0]){
                $('#popup').css("display", "none");
            }
       }
    });
    
}