
      
    <form method="post" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Informações do Comando Municipal</p>
        </div>
            <?php foreach($viewmodel["comando_municipal"] as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p >Comando Municipal de <?php echo $municipio?></p></div>
            </div>

                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
                    <div class="caixa-info__descricao  ">
                        <select class="caixa-info__input input--text" name="editarComandoDistrito">
                            <?php foreach($viewmodel["distritos"] as $item) : extract($item);?>
                                <option  value="<?php echo $id_distrito?>"><?php echo $distrito?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
                    <div class="caixa-info__descricao  ">
                        <select class="caixa-info__input input--text" name="editarComandoBairro" id="">
                            <?php foreach($viewmodel["bairros"] as $item) : extract($item);?>
                                <option  value="<?php echo $id_bairro?>"><?php echo $bairro?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" placeholder="<?php echo $rua?>" name="editarComandoRua" minlength="1" maxlength="39" value="<?php echo $rua?>" id="">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Terminal</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" placeholder="<?php echo $terminal?>" name="editarComandoTerminal" maxlength="20" minlength="6" value="<?php echo $rua?>" id="">
                </div>
            </div>
            <button type="submit" name="submit" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar alterações</button>
            <?php endforeach;?>
           

    </form>


