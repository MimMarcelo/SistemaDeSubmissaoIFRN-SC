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
function abrePopup(titulo, mensagem){
    
    $("#conteudoPopup").html("");// LIMPA QUAISQUER MENSAGENS QUE JÁ ESTEJAM NA POPUP
    
    p = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p.innerHTML = mensagem;//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p);//ADICIONA O <p> NA POPUP
    
    $("#tituloPopup").html(titulo);//ATRIBUI O TÍTULO DA POPUP
    $("#popup").css("display", "block");//ABRE A POPUP
};