
<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<form method="POST" class="caixa-info br-25">
    <div class="caixa-info__titulo">
        <p>Editar Distritos</p>
    </div>



   
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho"><h3 >Nome do Distrito</h3></div>
        <div class="caixa-info__descricao  ">
        <?php foreach($viewmodel['distrito'] as $item) : extract($item);?>
            <input  type="text" class="caixa-info__input input--text" value="<?php echo $distrito?>" name="editarDistritoNome" placeholder="Ex: Mundo Verde" id="" required maxlength="55" minlength="2">
            
        </div>
    </div>
        <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Munícipio</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="editarDistritoMunicipio">
                            <option selected="selected"  value="<?php echo $id_municipio?>"><?php echo $municipio?></option>
                                <?php foreach($viewmodel["municipio"] as $item) : extract($item);?>
                                    <option  value="<?php echo $id_municipio?>"><?php echo $municipio?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
            </div>
            

    <?php endforeach;?>
    <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar Alterações</button>
    <a href="<?php echo ROOT_URL; ?>mais/index/distrito" class="center-t btn btn-secondary mb-4 ">Voltar</a>




</form>


