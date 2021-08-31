<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="POST" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Adicionar Municípios</p>
        </div>


    

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho h5">Nome do Município</div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="adicionarMunicipioNome"  id="" required maxlength="150" minlength="2">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho h5">Província</div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="adicionarMunicipioProvincia">
                            <?php foreach($viewmodel as $item) : extract($item);?>
                                <option  value="<?php echo $id_provincia?>"><?php echo $provincia?></option>
                            <?php endforeach;?>

                    </select>
                </div>
            </div>

            <button type="submit" name="submit" value="Adicionar" class="caixa-info__botao  btn btn-success mgt-10 ">Adicionar</button>

           

    </form>


