
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

    <form method="POST" class="">
        <div class="caixa-info br-25 mgb-20">
            <div class="caixa-info__titulo">
                <p>Informações do proprietário</p>
            </div>


    

            <div class="caixa-info__item">

                <div class="caixa-info__cabecalho"><h3 >Nome Completo</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentosProprietarioNome" placeholder="Ex: João Paulo da Silva" id="" required minlength="3">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Número</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentosProprietarioNumero" placeholder="Ex: 923432123" id="" required minlength="3">
                </div>
            </div>



            <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-primary mgt-10 ">Adicionar Número</button>
            

           

        </div>

        <div class="caixa-info br-25 mgb-20">
            <div class="caixa-info__titulo">
                <p>Informações do entregador</p>
            </div>


    

            <div class="caixa-info__item">

                <div class="caixa-info__cabecalho"><h3 >Nome Completo</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentosProprietarioNome" placeholder="Ex: Miguel Santos" id="" required minlength="3">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Número</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentosProprietarioNumero" placeholder="Ex: 923432123" id="" required minlength="3">
                </div>
            </div>

        </div>



        <div class="caixa-info br-25 mbg-20">
            <div class="caixa-info__titulo">
                <p>Informações do Documento</p>
            </div>


    
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Categoria</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarPostoTipo" id="">
                        <option id="1" value="1">Bilhete de identidade</option>
                        <option value="2">Posto</option>
                        <option value="3">Destacamento Policial</option>
                    </select>
                </div>
                
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Identificador / Número</h3></div>

                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDocumentosProprietarioNome" placeholder="Ex: 091BEAO1J1221" id="" required minlength="3">
                </div>
                
            </div>

                

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Data de emissão </h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="date" class="caixa-info__input input--text" id="date-input" name="cadastroDataNascimento" />
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Fotos</h3></div>
                <div class="caixa-info__descricao caixa-info__grupo-img ">
                    <label for="filetype" class="botao cancel">
                            <img src="<?php echo ROOT_IMG; ?>documentos/20210408_134700.jpg" alt="" class="caixa-info__img--grande bd--grey preview-img ">                                    
                    </label>
                    <input id="filetype" type="file" name="cadastroFoto" class="file-chooser" hidden />
                    <label for="filetype" class="botao cancel">
                            <img src="<?php echo ROOT_IMG; ?>documentos/20210408_134711.jpg" alt="" class="caixa-info__img--grande bd--grey preview-img ">                                    
                    </label>
                    
                </div>
            </div>


            <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-primary mgt-10 ">Adicionar Documento</button>


           
            <script>
                        const $ = document.querySelector.bind(document);
                        const previewImg = $('.preview-img');
                        const fileChooser = $('.file-chooser');

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
                    </script>
        </div>
        <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Publicar Documentos</button>
        <a href="<?php echo ROOT_URL; ?>documentos" class="center-t btn btn-secondary mb-4 ">Voltar</a>

    </form>


