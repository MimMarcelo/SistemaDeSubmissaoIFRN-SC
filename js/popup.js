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
/**
 * CONFIGURAÇÕES PARA FECHAR A POPUP
 * @returns NENHUM
 */
function popup(){
    
    // QUANDO O USUÁRIO CLICAR NO 'X' DA POPUP
    $('#popup .fechar').each(function(i, e){
        $(e)[0].onclick = function(){
            $('#popup').css("display", "none");
        };
    });
    
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
/**
 * ABRE UMA POPUP DE MENSAGEM PARA O USUÁRIO
 * @param {String} titulo Título da popup
 * @param {String} mensagem Texto que será exibido ao usuário
 * @returns NENHUM
 */
function abrePopup(titulo, mensagem){
    
    $("#conteudoPopup").html("");// LIMPA QUAISQUER MENSAGENS QUE JÁ ESTEJAM NA POPUP
    
    p = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p.innerHTML = mensagem;//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p);//ADICIONA O <p> NA POPUP
    
    $("#tituloPopup").html(titulo);//ATRIBUI O TÍTULO DA POPUP
    $("#popup").css("display", "block");//ABRE A POPUP
};
/**
 * ABRE UMA POPUP DE FORMULÁRIO, 
 * ATENÇÃO PARA QUE O ARRAY DE 'valores' E O DE 'campos' POSSUAM AS MESMAS CHAVES
 * @param {String} titulo TÍTULO DA POPUP
 * @param {String} botao TEXTO QUE APARECE NO BOTÃO 'SUBMIT'
 * @param {String} action PÁGINA PHP DESTINO DO FORM
 * @param {array(String)} valores VALORES DOS CAMPOS DO FORMULÁRIO CASO PRECISEM ESTAR PREENCHIDOS
 * @param {array(array(String)} campos [[TIPO_DO_INPUT], [TEXTO_DO_LABEL]] - CADA POSIÇÃO É UM ARRAY DE DUAS STRINGS, SENDO A PRIMEIRA O TIPO DO INPUT A SER CRIADO, E A SEGUNDA O TEXTO DESCRITIVO DO LABEL
 * @returns NENHUM
 */
function abrePopupForm(titulo, botao, action, valores, campos){
    
    $("#conteudoPopup").html("");// LIMPA QUALQUER CONTEÚDO QUE JÁ ESTEJA NA POPUP
    
    //CRIA E CONFIGURA UM ELEMENTO <form>
    form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", action);
    
    //CRIA E CONFIGURA OS CAMPOS DO FORMULÁRIO
    for(var campo in campos){
        
        if(campos[campo][1] !== ""){
            label = document.createElement("label");
            label.setAttribute("for", campo);
            label.innerHTML = campos[campo][1];
            form.append(label);
        }
        inputId = document.createElement("input");
        inputId.setAttribute("type", campos[campo][0]);
        inputId.setAttribute("value", valores[campo]);
        inputId.setAttribute("name", campo);
        inputId.setAttribute("id", campo);
        form.append(inputId);
    }
    
    //CRIA BOTÃO DE SUBMISSÃO
    inputId = document.createElement("input");
    inputId.setAttribute("type", "submit");
    inputId.setAttribute("value", botao);
    form.append(inputId);
    
    $("#conteudoPopup").append(form);//ADICIONA O <form> NA POPUP
    formularios();//IMPORTANTE PARA PERMANECER NA MESMA PÁGINA, JÁ QUE O FORMULÁRIO É CRIADO APÓS O CARREGAR DA PÁGINA
    $("#tituloPopup").html(titulo);//ATRIBUI O TÍTULO DA POPUP
    $("#popup").css("display", "block");//ABRE A POPUP
};
/**
 * ABRE UMA POPUP DE FORMULÁRIO DE CONFIRMAÇÃO, 
 * ATENÇÃO PARA QUE O ARRAY DE 'valores' E O DE 'campos' POSSUAM AS MESMAS CHAVES
 * @param {type} texto TEXTO DESCRITIVO DA AÇÃO A SER REALIZADA
 * @param {type} action PÁGINA PHP DESTINO DO FORM
 * @param {type} id ID A SER ENVIADO À PÁGINA PHP
 * @param {type} descricao TEXTO A SER ENVIADO À PÁGINA PHP
 * @returns {undefined}
 */
function abrePopupConfirm(texto, action, id, descricao){
    
    $("#conteudoPopup").html("");// LIMPA QUALQUER CONTEÚDO QUE JÁ ESTEJA NA POPUP
    
    //CRIA E CONFIGURA UM ELEMENTO <form>
    form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", action);
    
    //CRIA E CONFIGURA OS CAMPOS DO FORMULÁRIO
    //ID
    inputId = document.createElement("input");
    inputId.setAttribute("type", "hidden");
    inputId.setAttribute("value", id);
    inputId.setAttribute("name", "pId");
    form.append(inputId);    
    //DESCRICÃO
    inputDesc = document.createElement("input");
    inputDesc.setAttribute("type", "hidden");
    inputDesc.setAttribute("value", descricao);
    inputDesc.setAttribute("name", "pDesc");
    form.append(inputDesc);
    //TEXTO DESCRITIVO DA AÇÃO
    label = document.createElement("label");
    label.innerHTML = texto;
    form.append(label);
    
    //CRIA BOTÕES DE CONFIRMAÇÃO
    //CONFIRMAÇÃO
    inputConfirm = document.createElement("input");
    inputConfirm.setAttribute("type", "submit");
    inputConfirm.setAttribute("value", "Confirmar");
    form.append(inputConfirm);
    //CANCELAR
    inputCancelar = document.createElement("input");
    inputCancelar.setAttribute("type", "button");
    inputCancelar.setAttribute("value", "Cancelar");
    inputCancelar.setAttribute("class", "fecharPopup");
    form.append(inputCancelar);
    
    $("#conteudoPopup").append(form);//ADICIONA O <form> NA POPUP
    popup();//IMPORTANTE PARA PERMITIR O EVENTO DO BOTÃO 'CANCELAR'
    formularios();//IMPORTANTE PARA PERMANECER NA MESMA PÁGINA, JÁ QUE O FORMULÁRIO É CRIADO APÓS O CARREGAR DA PÁGINA
    $("#tituloPopup").html("Confirmação");//ATRIBUI O TÍTULO DA POPUP
    $("#popup").css("display", "block");//ABRE A POPUP
};
