
<style>
    .navegacao-lateral__item:nth-child(2) {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="POST" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Adicionar Posto</p>
        </div>


    
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Tipo de Posto</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarPostoTipo" id="">
                        <option id="1" value="1">Esquadra</option>
                        <option value="2">Posto</option>
                        <option value="3">Destacamento Policial</option>
                    </select>
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome </h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarPostoNome" placeholder="Ex: Mundo Verde" id="" required maxlength="55" minlength="2">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarPostoDistrito">
                    <?php foreach($viewmodel['distritos'] as $item) : extract($item);?>
                                <option  value="<?php echo $id_distrito?>"><?php echo $distrito?></option>
                            <?php endforeach;?>

                    </select>
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarPostoBairro" id="">
                        <?php foreach($viewmodel['bairros'] as $item) : extract($item);?>
                        <option  value="<?php echo $id_bairro?>"><?php echo $bairro?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarPostoRua" placeholder="Ex: 1" required maxlength="39">
                </div>
            </div>

            <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Adicionar</button>

           

    </form>


