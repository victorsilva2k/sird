
<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<form method="POST" class="caixa-info br-25">
    <div class="caixa-info__titulo">
        <p>Editar Provincias</p>
    </div>



   
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho h5">Nome da Provincia</div>
        <div class="caixa-info__descricao  ">
        <?php foreach($viewmodel['provincia'] as $item) : extract($item);?>
            <input  type="text" class="caixa-info__input input--text" value="<?php echo $provincia?>" name="editarProvinciaNome" id="" required maxlength="55" minlength="2">
        <?php endforeach;?>    
        </div>
    </div>

            

    
    <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar Alterações</button>
    <a href="<?php echo ROOT_URL; ?>mais/index/municipio" class="center-t btn btn-secondary mb-4 ">Voltar</a>




</form>


