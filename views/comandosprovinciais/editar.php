

<form method="post" class="caixa-info br-25">
    <div class="caixa-info__titulo">
        <p>Editar Comando Provincial</p>
    </div>
    <?php foreach($viewmodel["comando_provincial"] as $item) : extract($item);?>
        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
            <div class="caixa-info__descricao"><p >Comando Provincial de <?php echo $nome_cp?></p></div>
        </div>

        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Província</h3></div>
            <div class="caixa-info__descricao  ">
                <select class="caixa-info__input input--text" name="editarComandoPProvincia">
                    <option selected="selected"  value="<?php echo $id_provincia?>"><?php echo $provincia?></option>
                    <?php foreach($viewmodel["provincias"] as $item) : extract($item);?>
                        <option  value="<?php echo $id_provincia?>"><?php echo $provincia?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Munícipio</h3></div>
            <div class="caixa-info__descricao  ">
                <select class="caixa-info__input input--text" name="editarComandoPMunicipio">
                    <option selected="selected"  value="<?php echo $id_municipio?>"><?php echo $municipio?></option>
                    <?php foreach($viewmodel["municipios"] as $item) : extract($item);?>
                        <option  value="<?php echo $id_municipio?>"><?php echo $municipio?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
            <div class="caixa-info__descricao  ">
                <select class="caixa-info__input input--text" name="editarComandoPDistrito">
                    <option selected="selected"  value="<?php echo $id_bairro?>"><?php echo $distrito?></option>
                    <?php foreach($viewmodel["distritos"] as $item) : extract($item);?>
                        <option  value="<?php echo $id_distrito?>"><?php echo $distrito?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
            <div class="caixa-info__descricao  ">
                <select class="caixa-info__input input--text" name="editarComandoPBairro" id="">
                    <option selected="selected"  value="<?php echo $id_bairro?>"><?php echo $bairro?></option>
                    <?php foreach($viewmodel["bairros"] as $item) : extract($item);?>
                        <option  value="<?php echo $id_bairro?>"><?php echo $bairro?></option>
                    <?php endforeach;?>
                </select>

            </div>
        </div>
        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
            <div class="caixa-info__descricao  ">
                <input  type="text" class="caixa-info__input input--text" placeholder="<?php echo $rua?>" name="editarComandoPRua" minlength="1" maxlength="39" value="<?php echo $rua?>" id="">
            </div>
        </div>
        <div class="caixa-info__item">
            <div class="caixa-info__cabecalho"><h3 >Terminal</h3></div>
            <div class="caixa-info__descricao  ">
                <input  type="text" class="caixa-info__input input--text"  name="editarComandoPTerminal" maxlength="20" minlength="6" value="<?php echo $terminal?>" id="">
            </div>
        </div>
        <button type="submit" name="submit" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar alterações</button>
        <a href="<?php echo ROOT_URL; ?>comandonacional/" class="caixa-info__botao  btn btn-secondary mgt-10 ">Voltar</a>


    <?php endforeach;?>


</form>


