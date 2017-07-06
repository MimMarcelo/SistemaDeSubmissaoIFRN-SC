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
        var dados = $(this).serialize();//CRIA UM ARRAY NO FORMATO JSON
        var href = $(this).attr("action");//PEGA O DESTINO DO FORMULÁRIO
        
        //RESPONSÁVEL POR MUDAR O CONTEÚDO DA PÁGINA SEM RECARREGÁ-LA
        $.ajax({
                type: "POST",
                url: href, //DESTINO DO FORMULÁRIO
                data: dados, //INFORMAÇÕES A SEREM PASSADAS
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
    document.getElementById('popup').style.display = "block";//ABRE A POPUP
};