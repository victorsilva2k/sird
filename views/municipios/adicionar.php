
<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="POST" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Adicionar Distritos</p>
        </div>


    

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome do Distrito</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarDistritoNome"  id="" required maxlength="150" minlength="2">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Munícipio</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarDistritoMunicipio">
                            <?php foreach($viewmodel as $item) : extract($item);?>
                                <option  value="<?php echo $id_municipio?>"><?php echo $municipio?></option>
                            <?php endforeach;?>

                    </select>
                </div>
            </div>

            <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Adicionar</button>

           

    </form>


