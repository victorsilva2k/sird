$('#add-documentos').click(function(e){
    // A função vai criar uma nova seção de criação de documentos
    e.preventDefault();


    var categorias_option;
    
    var ROOT_IMG = $('#imagem1').attr("data-src");

    $('#caixa-documentos').append('<div class="caixa-info_documentos" id="caixa-documentos"> <div class="caixa-info br-25 mbg-20"> <div class="caixa-info__titulo"> <p>Informações do Documento</p> </div> <div class="caixa-info__item"> <div class="caixa-info__cabecalho"><h3 >Categoria</h3></div> <div class="caixa-info__descricao "> <select class="caixa-info__input input--text" name="adicionarDocumentoCategoria[]" id="">' + categorias_option + '</select> </div> </div> <div class="caixa-info__item"> <div class="caixa-info__cabecalho"><h3 >Identificador / Número</h3></div> <div class="caixa-info__descricao "> <input type="text" class="caixa-info__input input--text" name="adicionarDocumentoIdentificador[]" placeholder="Ex: 091BEAO1J1221" id="" minlength="3" maxlength="20" value=" "> </div> </div> <div class="caixa-info__item"> <div class="caixa-info__cabecalho"><h3 >Data de emissão </h3></div> <div class="caixa-info__descricao "> <input type="date" class="caixa-info__input input--text" id="date-input" name="adicionarDocumentoEmissao[]" required /> </div> </div> <div class="caixa-info__item"> <div class="caixa-info__cabecalho"><h3 >Fotos</h3></div> <div class="caixa-info__descricao caixa-info__grupo-img "><label for="filetype" class="botao cancel"><img src="' + ROOT_IMG + 'site/no-img.png" alt="" class="caixa-info__img--grande bd--grey preview-img  "> </label><input id="" type="file" name="adicionarDocumentoFotoFrente[]" class="" hidden  /><label for="" class="botao cancel"><img src="' + ROOT_IMG + 'site/no-img.png" alt="" class="caixa-info__img--grande bd--grey preview-img   "></label><input id="" type="file" name="adicionarDocumentoFotoTraz[]" class="" hidden /></div> </div> </div> </div>');
    
    $.ajax({
        url: 'http://localhost/ajax_php/ajax_com_php/inserir.php',
        method: 'POST',
        dataType: 'json'
    }).done(function(result) {
        for (var i = 0; i < result.length; i++) {
            categorias_option += "<option  value=" + result[i].id_categoria +"> "+ result[i].categoria +"</option>";

        }
        

        $('#name').val('');
        $('#comment').val('');

    });



});
