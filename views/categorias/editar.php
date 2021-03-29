
<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<form method="POST" class="caixa-info br-25">
    <div class="caixa-info__titulo">
        <p>Editar Categorias</p>
    </div>




    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho"><h3 >Nome do Categoria</h3></div>
        <div class="caixa-info__descricao  ">
            <?php foreach($viewmodel as $item) : extract($item);?>
            <input  type="text" class="caixa-info__input input--text" value="<?php echo $categoria?>" name="editarCategoriaNome" placeholder="Ex: Cartão Eleitor" id="" required maxlength="100" minlength="2">
            <?php endforeach;?>
        </div>
    </div>

    <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar Alterações</button>



</form>


