
      
    <style>
    .agentes_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="post" enctype="multipart/form-data" class="caixa-info br-25">

            <div class="caixa-info__titulo">
                <p>Informações do Comando Municipal</p>
            </div>

            <?php foreach($viewmodel as $item) : extract($item);?>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Foto</h3></div>
                    <div class="caixa-info__descricao">
                                            <label for="filetype" class="botao cancel">
                    <div class=" mgb-10">
                        <img src="<?php echo ROOT_IMG; ?>agentes/<?php echo $foto?>" alt="" class="caixa-info__foto-usuario caixa-info__img img--perfil preview-img">
                    </div>
                    
                        
                    </label>
                    <input id="filetype" type="file" value="<?php echo $foto?>" name="editarAgenteFoto" class="file-chooser" hidden />
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                    <div class="caixa-info__descricao">
                    <input  type="text" class="caixa-info__input input--text" name="editarAgenteNome" value="<?php echo $nome?>"  required minlength="3" maxlength="100">
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Sobrenome</h3></div>
                    <div class="caixa-info__descricao">
                        <input  type="text" class="caixa-info__input input--text" name="editarAgenteSobrenome" value="<?php echo "$sobrenome"?>"  required minlength="3" maxlength="100">
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Data de Nascimento</h3></div>
                    <div class="caixa-info__descricao">
                        <input  type="date" class="caixa-info__input input--text" id="date-input" name="editarAgenteDataNascimento" required />
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Gênero</h3></div>
                    <div class="caixa-info__descricao">
                    <select class="caixa-info__input input--text" name="editarAgenteGenero" id="">
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                    </div>
                </div>



            <?php endforeach;?>



            <button type="submit" name="submit" value="Editar" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar alterações</button>
            <a href="<?php echo ROOT_URL; ?>agentes/perfil" class="  btn btn-secondary mgt-10 ">Voltar</a>

           

    </form>

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
                </script>
