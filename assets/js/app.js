document.addEventListener('DOMContentLoaded', function () { // faz com que as funções Javascript só funcionem após todo o documento html ser carregado



    // FUNÇÃO PARA ADICIONAR CAMPO DE FORMULÁRIO
    $( '#add-campo' ).click(function() {
        appendTo()
      });
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

    // Função para esconder a opção de postos em permitir.php

    $('#selecionarComando').hide();

    $("select").on("change", function() {
        var valor = $(this).val();   // aqui vc pega cada valor selecionado com o this
        switch (valor) {
            case 'Posto':
                $('#selecionarComando').hide();
                $('#selecionarPostos').show();
              break;
            case 'Comando':
                $('#selecionarComando').show();
                $('#selecionarPostos').hide();
              break;
            default:
                $('#selecionarComando').hide();
                $('#selecionarPostos').show();
              break;
          }
    });

    
    

    $('#posto_check').select(function () {
        $('#selecionarComando').hide();
        $('#selecionarPostos').show();

    });
    $('#comando_check').click(function () {
        $('#selecionarComando').show();
        $('#selecionarPostos').hide();
        
        
    });

    
});
