$(document).ready(function () { // faz com que as funções Javascript só funcionem após todo o documento html ser carregado


    // FUNÇÃO PARA O MENU 
    $('#abrir-menu').click(function(){
        $('.barra-lateral').animate({
            display: 'flex',
            opacity: 1
            
        });
        $('.modal').css('display', 'block');


    });
    $('.fechar-menu').click(function(){
        $('.modal').css('display', 'none');

        $('.barra-lateral').animate({
            width: "0%",
            opacity: 0,
        })
    });

    
});
