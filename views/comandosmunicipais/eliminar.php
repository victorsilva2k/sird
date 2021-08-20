
<style>
    .comando_m_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="POST" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Escolher Comando Municipal para mover ficheiros e agentes</p>
        </div>

            <input type="hidden" name="ComandoMunicipalEliminado" value="<?php echo $this->param?>">

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Local</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="ComandoMunicipalEscolhido" id="">
                        <?php foreach($viewmodel as $item) : extract($item);?>
                        <option value="<?php echo $id_cm?>">Comando Municipal de <?php echo $municipio?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>


            <button type="submit" name="submit" value="Confirmar" class="caixa-info__botao  btn btn-success mgt-10 ">Confirmar</button>

           




