/**
 * CARREGA A FUNÇÃO DA POPUP QUANDO AS PÁGINAS SÃO (RE)CARREGADAS
 */
$(document).ready(function () {
    popup();
});
/**
 * CARREGA A FUNÇÃO DA POPUP QUANDO HÁ REQUISIÇÕES AJAX
 */
$(document).ajaxComplete(function () {
    popup();
});
/**
 * CONFIGURAÇÕES PARA FECHAR A POPUP
 * @returns NENHUM
 */
function popup() {

    // QUANDO O USUÁRIO CLICAR NO 'X' DA POPUP
    $('#popup .fechar').each(function (i, e) {
        $(e)[0].onclick = function () {
            $('#popup').css("display", "none");
        };
    });

    // QUANDO O USUÁRIO CLICA FORA DA POPUP
    window.onclick = function (event) {
        if (event.target === $('#popup')[0]) {
            $('#popup').css("display", "none");
        }
    };

    //QUANDO O USUÁRIO APERTA 'ESC' NO TECLADO
    $(document).keyup(function (e) {
        if (e.keyCode === 27) { // A TECLA ESC É REPRESENTADA PELO NÚMERO 27
            if ($('#popup')[0]) {
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
function abrePopup(titulo, mensagem) {

    $("#conteudoPopup").html("");// LIMPA QUAISQUER MENSAGENS QUE JÁ ESTEJAM NA POPUP

    p = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p.innerHTML = mensagem;//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p);//ADICIONA O <p> NA POPUP

    $("#tituloPopup").html(titulo);//ATRIBUI O TÍTULO DA POPUP
    $("#popup").css("display", "block");//ABRE A POPUP
}
;
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
function abrePopupForm(titulo, botao, action, valores, campos) {

    $("#conteudoPopup").html("");// LIMPA QUALQUER CONTEÚDO QUE JÁ ESTEJA NA POPUP

    //CRIA E CONFIGURA UM ELEMENTO <form>
    form = document.createElement("form");
    form.setAttribute("method", "post");
    form.setAttribute("action", action);

    //CRIA E CONFIGURA OS CAMPOS DO FORMULÁRIO
    for (var campo in campos) {

        if (campos[campo][1] !== "") {
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
}
;
/**
 * ABRE UMA POPUP DE FORMULÁRIO DE CONFIRMAÇÃO, 
 * ATENÇÃO PARA QUE O ARRAY DE 'valores' E O DE 'campos' POSSUAM AS MESMAS CHAVES
 * @param {type} texto TEXTO DESCRITIVO DA AÇÃO A SER REALIZADA
 * @param {type} action PÁGINA PHP DESTINO DO FORM
 * @param {type} id ID A SER ENVIADO À PÁGINA PHP
 * @param {type} descricao TEXTO A SER ENVIADO À PÁGINA PHP
 * @returns {undefined}
 */
function abrePopupConfirm(texto, action, id, descricao) {

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
}
;

function confirmaAvaliador(ckb) {
    if ($(ckb).is(':checked')) {
        $('#candidatoAAvaliador').prop('checked', false);
        termosParaAvaliador(ckb)
    }
    mostrarCampoInvisivel('#candidatoAAvaliador');

}
function termosParaAvaliador(ckb) {
    $("#conteudoPopup").html("");// LIMPA QUALQUER CONTEÚDO QUE JÁ ESTEJA NA POPUP

    $("#tituloPopup").html("Confirmações para ser avaliador");//ATRIBUI O TÍTULO DA POPUP
    subtitulo = document.createElement("h3");
    subtitulo.innerHTML = "Termo de Aceite para ser Avaliador de Trabalhos/Artigos Científicos, tecnológicos e de Inovação";
    $("#conteudoPopup").append(subtitulo);

    p = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p.innerHTML = "Para fazer parte do banco de avaliadores desta plataforma, você deve concordar com o seguinte termo de compromisso.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p);//ADICIONA O <p> NA POPUP

    p1 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p1.innerHTML = "<br>Comprometo-me a:";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p1);//ADICIONA O <p> NA POPUP

    p2 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p2.innerHTML = "<br>1. Não utilizar as informações confidenciais a que tiver acesso para gerar benefício próprio exclusivo e/ou unilateral, presente ou futuro, ou para o uso de terceiros.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p2);//ADICIONA O <p> NA POPUP

    p3 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p3.innerHTML = "2. Não efetuar nenhuma gravação ou cópia da documentação, a não ser que ela torne-se pública.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p3);//ADICIONA O <p> NA POPUP

    p4 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p4.innerHTML = "3. Não me apropriar de material confidencial e/ou sigiloso de tecnologia que venha a ser disponibilizado.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p4);//ADICIONA O <p> NA POPUP

    p5 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p5.innerHTML = "4. Aceitar ou recusar os trabalhos, a mim atribuídos, em até 48 horas.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p5);//ADICIONA O <p> NA POPUP

    p6 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p6.innerHTML = "5. Avaliar os trabalhos, a mim enviados, em até 5 dias corridos.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p6);//ADICIONA O <p> NA POPUP
    
    
    p7 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p7.innerHTML = "<br>Observações:";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p7);//ADICIONA O <p> NA POPUP

    p8 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p8.innerHTML = "<br>1. O seu aceite como avaliador o insere de forma positiva no banco de avaliadores. A regularidade e atendimento dos prazos o classificará positivamente neste banco.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p8);//ADICIONA O <p> NA POPUP

    p9 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p9.innerHTML = "2. Caso aceite fazer parte do banco de avaliadores, poderá ser convidado a avaliar trabalhos/artigos de qualquer evento dentro do sistema.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p9);//ADICIONA O <p> NA POPUP

    p0 = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
    p0.innerHTML = "3. Apenas serão encaminhados trabalhos que estejam relacionados com sua(s) área(s) de escolha. Os certificados serão emitidos por participação no evento listando os trabalhos/artigos avaliados conforme cada caso.";//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
    $("#conteudoPopup").append(p0);//ADICIONA O <p> NA POPUP

    ckbLiEAceito = document.createElement('input');
    $(ckbLiEAceito).attr('type', 'checkbox');
    $(ckbLiEAceito).attr('id', 'ckbLiEAceito');
    $(ckbLiEAceito).click(function(){
        if($(this).is(':checked')) {
            $('#btnConfrimaSerAvaliador').prop('disabled', false);
        }
        else{
            $('#btnConfrimaSerAvaliador').prop('disabled', true);
        }
    });
    $("#conteudoPopup").append(ckbLiEAceito);
    
    labelLiEAceito = document.createElement('label');
    labelLiEAceito.innerHTML = "Li e aceito os termos de compromisso";
    $(labelLiEAceito).attr('for', 'ckbLiEAceito');
    $("#conteudoPopup").append(labelLiEAceito);
    //CRIA BOTÕES DE CONFIRMAÇÃO
    //CONFIRMAÇÃO
    inputConfirm = document.createElement("input");
    inputConfirm.setAttribute("type", "submit");
    inputConfirm.setAttribute("value", "Confirmar");
    inputConfirm.setAttribute("id", "btnConfrimaSerAvaliador");
    inputConfirm.setAttribute("onclick", "aceitarTermosParaAvaliador();");
    $(inputConfirm).prop('disabled', true);
    $("#conteudoPopup").append(inputConfirm);
    //CANCELAR
    inputCancelar = document.createElement("input");
    inputCancelar.setAttribute("type", "button");
    inputCancelar.setAttribute("value", "Cancelar");
    inputCancelar.setAttribute("class", "fecharPopup");
    inputCancelar.setAttribute("onclick", "$('#popup').css('display', 'none');");
    $("#conteudoPopup").append(inputCancelar);

    popup();//IMPORTANTE PARA PERMITIR O EVENTO DO BOTÃO 'CANCELAR'
    $("#popup").css("display", "block");//ABRE A POPUP
}
function aceitarTermosParaAvaliador() {
    $('#popup').css("display", "none");
    $('#candidatoAAvaliador').prop('checked', true);
    mostrarCampoInvisivel('#candidatoAAvaliador');
}