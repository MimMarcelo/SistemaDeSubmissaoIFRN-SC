/**
 * CARREGA AS FUNÇÕES DOS FORMULÁRIOS QUANDO AS PÁGINAS SÃO (RE)CARREGADAS
 */
$(document).ready(function(){
    formularios();
    focaLabel();
    habilitaCalendarios();
    mostraNomeInputFile();
    camposObrigatorios();
});
/**
 * CARREGA AS FUNÇÕES DOS FORMULÁRIOS QUANDO HÁ REQUISIÇÕES AJAX
 */
$(document).ajaxComplete(function(){
    formularios(); 
    focaLabel();
    habilitaCalendarios();
    mostraNomeInputFile();
    camposObrigatorios();
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
        
        //RESPONSÁVEL POR MUDAR O CONTEÚDO DA PÁGINA SEM RECARREGÁ-LA
        $.ajax({
            type: "POST",
            url: href, //DESTINO DO FORMULÁRIO
            processData: false,
            contentType: false,
            cache: false,
            data: new FormData($(this)[0]), // DADOS A SEREM ENVIADOS PARA O .PHP
            success: function(data){

                if(EhJSON(data)){ //SE NA RESPOSTA VIER UM JSON

                    var o = JSON.parse(data);//CONVERTE OS DADOS EM JSON
                    listaMensagens(o);

                    //RECARREGA A div#atualizavel DA PÁGINA
                    $("#atualizavel").hide().load(window.location.href+" #atualizavel").fadeIn(1000);
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
/**
 * FAZ COM QUE OS CAMPOS COM A CLASSE .calendario APRESENTEM UM CALENDÁRIO PARA PREENCHIMENTO
 * @returns NENHUM
 */
function habilitaCalendarios(){
    $(".calendario").each(function(i, input){
        $(input).mask("99/99/9999");
        $(input).datepicker({
            showButtonPanel:true
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
        
        if($(input).next().attr("for") !== $(input).attr("id")){
            $(input).after(label); //NECESSÁRIO NA HORA DA CRIAÇÃO DO ELEMENTO
        }
        $(input).change(function(){
            //alert($(this)[0].value);
            $(this).next().text("");
            txt = $(this)[0].value.toString();
            if(txt.length > 20){
                txt = "..." + txt.substr(txt.length-20);
            }
            $(this).next().append(btn+txt);
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