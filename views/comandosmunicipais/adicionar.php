
<style>
    .comando_m_link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="POST" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Adicionar Comando Municipal</p>
        </div>


            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Munícipio</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarComandoMMunicipio">
                            <?php foreach($viewmodel['municipios'] as $item) : extract($item);?>
                                <option  value="<?php echo $id_municipio?>"><?php echo $municipio?></option>
                            <?php endforeach;?>

                    </select>
                </div>
            </div>

        <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarComandoMDistrito">
                            <?php foreach($viewmodel['distritos'] as $item) : extract($item);?>
                                <option  value="<?php echo $id_distrito?>"><?php echo $distrito?></option>
                            <?php endforeach;?>

                    </select>
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarComandoMBairro" id="">
                        <?php foreach($viewmodel['bairros'] as $item) : extract($item);?>
                        <option  value="<?php echo $id_bairro?>"><?php echo $bairro?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarComandoMRua" placeholder="Ex: 1" required maxlength="39">
                </div>
            </div>
            <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Terminal</h3></div>
                    <div class="caixa-info__descricao  ">
                        <input  type="text" class="caixa-info__input input--text" name="adicionarComandoMTerminal" placeholder="Ex: 923772617" required maxlength="11">
                    </div>
            </div>

            <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Adicionar</button>
            <a href="<?php echo ROOT_URL; ?>comandosprovinciais/" class="caixa-info__botao  btn btn-secondary mgt-10 ">Voltar</a>
           

    </form>


