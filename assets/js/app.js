document.addEventListener('DOMContentLoaded', function () { // faz com que as funções Javascript só funcionem após todo o documento html ser carregado



    // FUNÇÃO PARA ADICIONAR CAMPO DE FORMULÁRIO
    $( '#add-campo' ).click(function() {
        $('<input type="number" class="caixa-info__input input--text mgt-10" name="adicionarDocumentoProprietarioNumero[]" placeholder="Ex: 923432123" id="" required minlength="7" maxlength="10">').appendTo('#caixa-numero')
      });

    // FUNÇÃO PARA ADICIONAR UMA SEÇÃO DE DOCUMENTOS NO FORMULÁRIO

    $( '#ad-documentos' ).click(function() {
        
        $('<div class="caixa-info br-25 mbg-20 mgt-20"><div class="caixa-info__titulo"><p>Informações do Documento</p></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Categoria</h3></div><div class="caixa-info__descricao  "><select class="caixa-info__input input--text" name="adicionarDocumentoCategoria[]" id=""><option  value="1">Bilhete de Identidade </option><option  value="3">Número de Contribuinte </option><option  value="5">Cartão Eleitoral</option><option  value="6">Cartão de Saúde</option><option  value="7">Carta de Condução</option><option  value="8">Livrete</option><option  value="9">Recenseamento Militar</option><option  value="10">Cartão Alimentar</option><option  value="11">Cartão Escolar</option><option  value="12">Cartão de Vacina</option><option  value="13">Outros</option></select></select></div></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Identificador / Número</h3></div><div class="caixa-info__descricao  "><input  type="text" class="caixa-info__input input--text" name="adicionarDocumentoIdentificador[]" placeholder="Ex: 091BEAO1J1221" id=""  minlength="3" maxlength="20"></div></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Data de emissão </h3></div><div class="caixa-info__descricao  "><input  type="date" class="caixa-info__input input--text" id="date-input" name="adicionarDocumentoEmissao[]" /></div></div><div class="caixa-info__item"><div class="caixa-info__cabecalho"><h3 >Fotos</h3></div><div class="caixa-info__descricao caixa-info__grupo-img "><label for="filetype" class="botao cancel"><img src="http://localhost/sird/assets/img/site/no-img.png" alt="" class="caixa-info__img--grande bd--grey  "> </label><input id="" type="file" name="adicionarDocumentoFotoFrente[]" class=""  /><label for="" class="botao cancel"><img src="http://localhost/sird/assets/img/site/no-img.png" alt="" class="caixa-info__img--grande bd--grey  "></label><input id="" type="file" name="adicionarDocumentoFotoTraz[]" class=""  /></div></div></div>').appendTo('#caixa-documentos');
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

    $('#selecionarComandoMunicipal').hide();
    $('#selecionarComandoProvincial').hide();
    $('#selecionarComandoNacional').hide();

    $("select").on("change", function() {
        var valor = $(this).val();   // aqui vc pega cada valor selecionado com o this
        switch (valor) {
            case 'Posto':
                $('#selecionarPostos').show();
                $('#selecionarComandoMunicipal').hide();
                $('#selecionarComandoProvincial').hide();
                $('#selecionarComandoNacional').hide();
              break;
            case 'comando_municipal':
                $('#selecionarPostos').hide();
                $('#selecionarComandoMunicipal').show();
                $('#selecionarComandoProvincial').hide();
                $('#selecionarComandoNacional').hide();
              break;
            case 'comando_provincial':
                $('#selecionarPostos').hide();
                $('#selecionarComandoMunicipal').hide();
                $('#selecionarComandoProvincial').show();
                $('#selecionarComandoNacional').hide();
              break;
            case 'comando_nacional':
                $('#selecionarPostos').hide();
                $('#selecionarComandoMunicipal').hide();
                $('#selecionarComandoProvincial').hide();
                $('#selecionarComandoNacional').show();
              break;
            default:
      
              break;
          }
    });


    
});
