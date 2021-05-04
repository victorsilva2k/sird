
<style>
    #documentos_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
    .navegacao-lateral__botao, .pesquisa-form__botao--normal {
        display: none !important;
    }
</style>
    <h1 class="titulo--normal">Publicar Documento</h1>

    <form method="POST" enctype="multipart/form-data" class="">
        <div class="caixa-info br-25 mgb-20">
        <!-- Informações do proprietário -->
            <div class="caixa-info__titulo">
                <p>Informações do proprietário</p>
            </div>


    

            <div class="caixa-info__item">

                <div class="caixa-info__cabecalho"><h3 >Nome Completo</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentoProprietarioNome" placeholder="Ex: João Paulo da Silva" id="" required minlength="3" maxlength="300">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Número</h3></div>
                <div class="caixa-info__descricao  " id="caixa-numero">
                    <input  type="number" class="caixa-info__input input--text" name="adicionarDocumentoProprietarioNumero[]" placeholder="Ex: 923432123" id="" required minlength="9" maxlength="12">
                    
                </div>
            </div>



            <a class="caixa-info__botao  btn btn-primary mgt-10 " id="add-campo">Adicionar Número</a>
            

           

        </div>

        <!-- Informações do entregador -->

        <div class="caixa-info br-25 mgb-20">
            <div class="caixa-info__titulo">
                <p>Informações do entregador</p>
            </div>


    

            <div class="caixa-info__item">

                <div class="caixa-info__cabecalho"><h3 >Nome Completo</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentoEntregadorNome" placeholder="Ex: Miguel Santos" id="" required minlength="3" maxlength="300">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Número</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="number" class="caixa-info__input input--text" name="adicionarDocumentoEntregadorNumero" placeholder="Ex: 923432123" id="" requiredminlength="9" maxlength="12">
                </div>
            </div>

        </div>

        <!-- Informações do Documento -->

        <div class="caixa-info_documentos" id="caixa-documentos">
            <div class="caixa-info br-25 mbg-20">
                <div class="caixa-info__titulo">
                    <p>Informações do Documento</p>
                </div>


        
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Categoria</h3></div>
                    <div class="caixa-info__descricao  ">
                        <select class="caixa-info__input input--text" name="adicionarDocumentoCategoria[]" id="">
                        <?php foreach($viewmodel as $item) : extract($item);?>
                            <option  value="<?php echo $id_categoria_documento?>"><?php echo $categoria?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Identificador / Número</h3></div>

                    <div class="caixa-info__descricao  ">
                        <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentoIdentificador[]" placeholder="Ex: 091BEAO1J1221" id=""  minlength="3" maxlength="20">
                    </div>
                    
                </div>

                    

                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Data de emissão </h3></div>
                    <div class="caixa-info__descricao  ">
                        <input  type="date" class="caixa-info__input input--text" id="date-input" name="adicionarDocumentoEmissao[]" />
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Fotos</h3></div>
                    <div class="caixa-info__descricao caixa-info__grupo-img ">
                        <label for="filetype" class="botao cancel">
                                <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="" class="caixa-info__img--grande bd--grey preview-img ">                                    
                        </label>
                        <input id="filetype" type="file" name="adicionarDocumentoFotoFrente[]" class="file-chooser" hidden />
                        <label for="filetype2" class="botao cancel">
                                <img src="<?php echo ROOT_IMG; ?>site/no-img.png" alt="" class="caixa-info__img--grande bd--grey preview-img2 ">                                    
                        </label>
                        <input id="filetype2" type="file" name="adicionarDocumentoFotoTraz[]" class="file-chooser2" hidden />
                    </div>
                </div>
                <script>
                            const $a = document.querySelector.bind(document);
                            const previewImg = $a('.preview-img');
                            const fileChooser = $a('.file-chooser');

                            fileChooser.onchange = e => {
                                const fileToUpload = e.target.files.item(0);
                                const reader = new FileReader();

                                // evento disparado quando o reader terminar de ler 
                                reader.onload = e => previewImg.src = e.target.result;

                                // solicita ao reader que leia o arquivo 
                                // transformando-o para DataURL. 
                                // Isso disparará o evento reader.onload.
                                reader.readAsDataURL(fileToUpload);
                            };

                            const previewImg2 = $a('.preview-img2');
                            const fileChooser2 = $a('.file-chooser2');

                            fileChooser2.onchange = e => {
                                const fileToUpload2 = e.target.files.item(0);
                                const reader2 = new FileReader();

                                // evento disparado quando o reader terminar de ler 
                                reader2.onload = e => previewImg2.src = e.target.result;

                                // solicita ao reader que leia o arquivo 
                                // transformando-o para DataURL. 
                                // Isso disparará o evento reader.onload.
                                reader2.readAsDataURL(fileToUpload2);
                            };
                        </script>



            
               
            
            
            </div>
        </div>
        <a  class="  btn btn-primary mgt-10 " id="add-documentos">Adicionar Documento</a>
        <br>
        <div class="btn-grupo mgt-10">
        <button type="submit" name="submit" value="Adicionar" type="submit" name="submit" value="Adicionar" class="  btn btn-success ">Publicar Documentos</button>
        <a href="<?php echo ROOT_URL; ?>documentos" class="  btn btn-secondary mb-4 ">Voltar</a>
        </div>

    </form>
 


