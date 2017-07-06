function formularios(){

    //QUANDO UMA OPÇÃO DO MENU É CLICADA
    $("form").unbind('submit').submit(function(e){
        var dados = $(this).serialize();//CRIA UM ARRAY NO FORMATO JSON
        var href = $(this).attr("action");//PEGA O DESTINO DO FORMULÁRIO
        //console.log(dados);
//        console.log(href);
        //console.log(this);
        
        //RESPONSÁVEL POR MUDAR O CONTEÚDO DA PÁGINA SEM RECARREGÁ-LA
        $.ajax({
                type: "POST",
                url: href, //DESTINO DO FORMULÁRIO
                data: dados, //INFORMAÇÕES A SEREM PASSADAS
                success: function(data){
                    //console.log(data);
                    if(EhJSON(data)){
                        var o = JSON.parse(data);
                        listaMensagens(o);
                        //console.log(o);
                        
                        $("#atualizavel").hide().load(window.location.href+" #atualizavel").fadeIn(1000);
                    }
                    else{
                        $("#atualizavel").hide().html(data).fadeIn(1000);
                    }
                }
        });
        return false;
        
    });
};
function EhJSON(data){
    try {
        var o = JSON.parse(data);
        if (o && typeof o === "object" && o !== null) return true;
    }
    catch (e) { }
    return false;
};
function listaMensagens(json){
    
    $("#mensagem").html("");
    for(msg in json.mensagem){
        p = document.createElement("p");
        p.innerHTML = json.mensagem[msg];
        $("#mensagem").append(p);
        //console.log(p);
    }
};