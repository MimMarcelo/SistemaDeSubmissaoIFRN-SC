function popup(){
    
    // FUNÇÕES PARA FECHAR A POPUP
    
    // QUANDO O USUÁRIO CLICAR NO 'X' DA POPUP
    if(document.getElementById('fecharPopup') !== null){
        document.getElementById('fecharPopup').onclick = function() {
            document.getElementById('popup').style.display = "none";
        };
    }
    
    // QUANDO O USUÁRIO CLICA FORA DA POPUP
    window.onclick = function(event) {
        if (event.target === document.getElementById('popup')) {
            document.getElementById('popup').style.display = "none";
        }
    };
    
    //QUANDO O USUÁRIO APERTA 'ESC' NO TECLADO
    $(document).keyup(function(e) {
        if (e.keyCode === 27) { // escape key maps to keycode `27`
           document.getElementById('popup').style.display = "none";
       }
    });
    
}