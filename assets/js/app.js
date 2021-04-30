document.addEventListener('DOMContentLoaded', function () { // faz com que as funções Javascript só funcionem após todo o documento html ser carregado



    // FUNÇÃO PARA ADICIONAR CAMPO DE FORMULÁRIO
    $( '#add-campo' ).click(function() {
        $('<input type="number" class="caixa-info__input input--text mgt-10" name="adicionarDocumentoProprietarioNumero[]" placeholder="Ex: 923432123" id="" required minlength="7" maxlength="10">').appendTo('#caixa-numero')
      });

    // FUNÇÃO PARA ADICIONAR UMA SEÇÃO DE DOCUMENTOS NO FORMULÁRIO

    $( '#add-documentos' ).click(function() {
        
        $('<div class="caixa-info br-25 mbg-20 mgt-20"><div class="caixa-info__titulo"><p>Informações do Documento</p></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Categoria</h3></div><div class="caixa-info__descricao  "><select class="caixa-info__input input--text" name="adicionarDocumentoCategoria[]" id=""><option value="1">Bilhete de Identidade </option><option value="3">Número de Contribuinte </option></select></div></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Identificador / Número</h3></div><div class="caixa-info__descricao  "><input  type="text" class="caixa-info__input input--text" name="adicionarDocumentoIdentificador[]" placeholder="Ex: 091BEAO1J1221" id=""  minlength="3" maxlength="20"></div></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Data de emissão </h3></div><div class="caixa-info__descricao  "><input  type="date" class="caixa-info__input input--text" id="date-input" name="adicionarDocumentoEmissao[]" /></div></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Fotos</h3></div><div class="caixa-info__descricao caixa-info__grupo-img "><label for="filetype" class="botao cancel"><img src="http://localhost/sird/assets/img/site/no-img.png" alt="" class="caixa-info__img--grande bd--grey preview-img "> </label><input id="filetype" type="file" name="adicionarDocumentoFoto1[]" class="file-chooser" hidden /><label for="filetype2" class="botao cancel"><img src="http://localhost/sird/assets/img/site/no-img.png" alt="" class="caixa-info__img--grande bd--grey preview-img2 "></label><input id="filetype2" type="file" name="adicionarDocumentoFoto2[]" class="file-chooser2" hidden /></div></div></div>').appendTo('#caixa-documentos');
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
