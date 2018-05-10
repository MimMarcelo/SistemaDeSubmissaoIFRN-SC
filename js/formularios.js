/**
 * CARREGA AS FUNÇÕES DOS FORMULÁRIOS QUANDO AS PÁGINAS SÃO (RE)CARREGADAS
 */
$(document).ready(function(){
    formularios();
    focaLabel();
    habilitaCalendarios();
    habilitaCpf();
    mostraNomeInputFile();
    camposObrigatorios();
    confirmarSenha();
});
/**
 * CARREGA AS FUNÇÕES DOS FORMULÁRIOS QUANDO HÁ REQUISIÇÕES AJAX
 */
$(document).ajaxComplete(function(){
    formularios(); 
    focaLabel();
    habilitaCalendarios();
    habilitaCpf();
    mostraNomeInputFile();
    camposObrigatorios();
    confirmarSenha();
});
/**
 * CONFIGURA OS FORMULÁRIOS PARA TRABALHAR DE FORMA ASSÍNCRONA
 * @returns NENHUM
 */
function formularios(){

    /**
     * QUANDO É FEITO O SUBMIT DO FORMULÁRIO
     * unbind() É RESPONSÁVEL POR DESEMPILHAR QUAISQUER SUBMITs QUE ESTEJAM EM ESPERA,
     *          EVITANDO QUE O FORMULÁRIO SEJA ENVIADO MAIS DE UMA VEZ A CADA CLIQUE
     * submit() É O MÉTODO DE SUBMISSÃO DOS FORMULÁRIOS, AQUI SENDO SOBRESCRITO
     */
    $("form").unbind('submit').submit(function(e){
        var href = $(this).attr("action");//PEGA O DESTINO DO FORMULÁRIO
//        var dados = paraJson($(this).serializeArray());
//        console.log(dados);
        
        //RESPONSÁVEL POR MUDAR O CONTEÚDO DA PÁGINA SEM RECARREGÁ-LA
        $.ajax({
            type: "POST",
            url: href, //DESTINO DO FORMULÁRIO
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($(this)[0]), // DADOS A SEREM ENVIADOS PARA O .PHP
            //data: dados,
            success: function(data){
                console.log(data);
        
                if(EhJSON(data)){ //SE NA RESPOSTA VIER UM JSON
                    var o = JSON.parse(data);//CONVERTE OS DADOS EM JSON
                    if(o.redirecionar){
                        //window.location.replace(o.redirecionar);
                        window.location.href = o.redirecionar;
                    }
                    if(o.redirecionarConteudo){
                        $("#carregaPagina").hide().load(o.redirecionarConteudo+" #conteudo").fadeIn(1000);
                        
                        window.history.pushState({url: o.redirecionarConteudo}, "SS IFRN-SC - "+o.titulo, o.redirecionarConteudo);
                        return;
                    }
                    listaMensagens(o);

                    //RECARREGA A div#atualizavel DA PÁGINA
                    $("#atualizavel").hide().load(window.location.href+" #atualizavel").fadeIn(1000);
                }
                else if(data.toString().indexOf("Fatal error") !== -1){//Erros do Sistema 
                    /*
                     * PRECISA MELHORAR
                     */
                    abrePopup("Erro do Sistema", data.toString().substring(data.toString().indexOf(":")+2));
                }
                else{
                    //ATUALIZA A div#atualizavel DA PÁGINA COM OS DADOS RECEBIDOS
                    $("#atualizavel").hide().html(data).fadeIn(1000);
                }
            }
        });
        
        //IMPEDE QUE O FORMULÁRIO CONCLUA O REDIRECIONAMENTO PADRÃO
        return false;
        
    });
};
function paraJson(formulario){
    var json = "{";
    for(var tx in formulario){
        if(tx > 0) json += ",";
        json += "'"+formulario[tx].name+"': '"+formulario[tx].value+"' ";
    }
    json += "}";
    return JSON.stringify(json);
}
/**
 * VERIFICA SE O PARÂMETRO INFORMADO É UM OBJETO JSON [TRUE], OU NÃO [FALSE]
 * @param {Objeto} data CONTEÚDO IMPRESSO PELA PÁGINA .PHP
 * @returns SE JSON [TRUE], OU NÃO [FALSE]
 */
function EhJSON(data){
    try {
        var o = JSON.parse(data);// TENTA FAZER A CONVERSÃO
        if (o && typeof o === "object" && o !== null)//SE A CONVERSÃO TIVER DADO CERTO
            return true;
    }
    catch (e) {//EM CASO DE ERROS NA CONVERSÃO, NÃO É JSON
        return false;
    }
    return false;
};
/**
 * RECEBE UM OBJETO JSON COM TÍTULO E UM ARRAY DE MENSAGENS PARA SEREM EXIBIDOS EM POPUP
 * @param {JSON} json COM TÍTULO E UM ARRAY DE MENSAGENS
 * @returns NENHUM
 */
function listaMensagens(json){
    
    $("#conteudoPopup").html("");// LIMPA QUAISQUER MENSAGENS QUE JÁ ESTEJAM NA POPUP
    
    for(var msg in json.mensagem){//PERCORRE A LISTA DE MENSAGENS QUE ESTÃO NO JSON
        
        p = document.createElement("p");//CRIA UM ELEMENTO <p> PARA CADA MENSAGEM DO JSON
        p.innerHTML = json.mensagem[msg];//INSERE A MENSAGEM DO JSON NO <p> RECÉM CRIADO
        $("#conteudoPopup").append(p);//ADICIONA O <p> NA POPUP
    }
    
    $("#tituloPopup").html(json.titulo);//ATRIBUI O TÍTULO DA POPUP
    $("#popup").css("display", "block");//ABRE A POPUP
};
/**
 * INSERE ASTERISCO NOS CAMPOS OBRIGATÓRIOS
 * @returns NENHUM
 */
function camposObrigatorios(){
    $('input,textarea,select').each(function(i, e){
        if($(e).attr('required') === 'required'){
            if($(e).attr('type') === 'file'){ //O CAMPO INPUT[FILE] FAKE
                e = $(e).next();
            }
            if($(e).next().html() !== "*"){
                $(e).after("<span>*</span>");
            }
        }
    });
}
/**
 * DEFINE COMPORTAMENTO DE FOCO, QUANDO UM RADIOBUTTON OU CHECKBOX É SELECIONADO
 * @returns NENHUM
 */
function focaLabel(){
    corDeEntrada = "#BBC";
    corDeSaida = "#EEE";
    $('input[type="radio"], input[type="checkbox"]').each(function(i, input){
        $(input).parent().hover(
            function(){
                $(this).css("border-color", corDeEntrada);
            },
            function(){
                $(this).css("border-color", corDeSaida);
            });
    });
    $('input[type="radio"], input[type="checkbox"]').focus(function(){
            $(this).parent().css("border-color", corDeEntrada);
    });
    $('input[type="radio"], input[type="checkbox"]').focusout(function(){
            $(this).parent().css("border-color", corDeSaida);
    });
}
function adicionarAreaAtuacao(botao, lista){
    var label = document.createElement('label');
    var btnRemover = document.createElement('input');
    $(btnRemover).attr('type', 'button');
    $(btnRemover).attr('onclick', 'removerAreaAtuacao(this);')
    
    var select = document.createElement('select');
    $(select).attr('name', 'pAreaAtuacao[]');
    $(select).html($(lista).children().clone());
    
    $(label).append(select);
    $(label).append(btnRemover);
    
    $(label).insertBefore(botao);
}

function removerAreaAtuacao(este){
    $(este).parent().remove();
}

/**
 * FAZ COM QUE OS CAMPOS COM A CLASSE .calendario APRESENTEM UM CALENDÁRIO PARA PREENCHIMENTO
 * @returns NENHUM
 */
function habilitaCalendarios(){
    $(".calendario").each(function(i, input){
        $(input).mask("99/99/9999");
        $(input).datepicker({
            showButtonPanel:true,
            minDate: 0
        });
    });
}
/**
 * DEFINE A DATA MÍNIMA EM CAMPOS DE CALENDÁRIO (PERÍODO)
 * @param {this} de É ENVIADA A PALAVRA RESERVADA 'this'
 * @param {#ID_campo_data_fim} ate É ENVIADO O '#' + ID_DO_CAMPO_DA_DATA_FIM
 * @returns {undefined}
 */
function dataLimite(de, ate){
    $(ate).datepicker("option", "minDate", $(de).datepicker('getDate'));
}
/**
 * FAZ COM QUE OS CAMPOS COM A CLASSE .cpf APRESENTEM UMA MÁSCARA PARA PREENCHIMENTO
 * @returns NENHUM
 */
function habilitaCpf(){
    $(".cpf").each(function(i, input){
        $(input).mask("999.999.999-99");
        $(input).val("");
        $(input).keydown(function (e) {
            // Permite: "backspace" "delete" "tab" "escape" "enter" "-" "."
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 116, 189, 190]) !== -1 ||
                 // Permite: "Ctrl+A" "Command+A"
                (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
                 // Permite: "home" "end" "left" "right" "down" "up"
                (e.keyCode >= 35 && e.keyCode <= 40) ||
                // Permite: "F5" "Ctrl+F5"
                (e.keyCode === 116) ||
                // Permite: "Ctrl+V"
                (e.keyCode === 86 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Permite: "Ctrl+C"
                (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                // Permite: "Ctrl+X"
                (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true))) {
                     // SE FOR QUALQUER DESSES, NADA ACONTECE
                     return;
            }
            // GARANTE QUE É UM NÚMERO, E EVITA O keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
    });
}
/**
 * ATUALIZA O VALOR NO CAMPO INPUT[FILE] FAKE
 * @returns NENHUM
 */
function mostraNomeInputFile(){
    $("input[type='file']").each(function(i, input){
        btn = "<span>Selecione</span>";
        label = "<label for='"+$(input).attr("id")+"' class='inputFile'>"+btn+"</label>";
        if($(input).attr("class") === "upImagem"){
            label = label+"<img src='img/iconSemFoto.gif' alt='"+$(input).attr("placeholder")+"'>";
        }
        
        if($(input).next().attr("for") !== $(input).attr("id")){
            $(input).after(label); //NECESSÁRIO NA HORA DA CRIAÇÃO DO ELEMENTO
        }
        $(input).change(function(){
            $(this).next().text("");
            txt = $(this)[0].value.toString();
            if(txt.length > 16){
                txt = "..." + txt.substr(txt.length-16);
            }
            $(this).next().append(btn+txt);
            
            if($(this).attr("class") === "upImagem"){
                carregarImagem(this);
            }
        });
        
        /* NECESSÁRIO POIS O COMBINADOR CSS "+" NÃO ESTÁ FUNCIONANDO DE ACORDO NO FIREFOX */
        $(input).next().hover(
            function(){
                if($(this).css("background-color") !== "rgb(204, 204, 255)"){//O VALOR PADRÃO ARMAZENADO É EM RGB
                    $(this).css("background-color", "#EEF");
                }
            },
            function(){
                if($(this).css("background-color") !== "rgb(204, 204, 255)"){
                    $(this).css("background-color", "#FFF");
                }
            });
        $(input).focus(function(){
            $(this).next().css("background-color", "#CCF");
        });
        $(input).focusout(function(){
            $(this).next().css("background-color", "#FFF");
        });
    });
}
function carregarImagem(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        var imagem = $(input).next().next();
//        console.log("1 - "+$(input).next().next().attr("src"));
//        console.log("2 - "+$("#imgImagem").attr('src'));
        if($(input).attr('required') === 'required'){
            imagem = imagem.next();
        }
        
        reader.onload = function (e) {
            imagem.attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);

    }
}

function confirmarSenha(){
    $(".confirmarSenha").each(function(i, input){
        $(input).keyup(function (e) {
            var label = $(input).prev();
            var senha = $(input).prev().prev().prev().val();
//            console.log(senha);
//            console.log($(this).val());
            if(senha === $(this).val()){
                //console.log(label.html());
                //console.log(label.html().indexOf("<span>"));
                if(label.html().indexOf("<span>") !== -1){
                    label.html(label.html().substring(0, label.html().indexOf("<span>")));
                }
            }
            else{
                //console.log(label.html());
                if(label.html().indexOf("<span>") === -1){
                    label.append("<span>(Não confere)</span>");
                }
            }
        });
    });
}