
      
    <style>
    .agentes_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="post" enctype="multipart/form-data" class="caixa-info br-25">

            <div class="caixa-info__titulo">
                <p>Alterar palavra passe</p>
            </div>

           
                 

                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Palavra Passe Antiga</h3></div>
                    <div class="caixa-info__descricao">
                    <input  type="text" class="caixa-info__input input--text" name="editarPasswordAntiga" value=""  required minlength="12" maxlength="100">
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Nova Palavra Passe</h3></div>
                    <div class="caixa-info__descricao">
                        <input  type="text" class="caixa-info__input input--text" name="editarPassword" value=""  required minlength="12" maxlength="100">
                    </div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Confirmar Palavra Passe</h3></div>
                    <div class="caixa-info__descricao">
                        <input  type="text" class="caixa-info__input input--text" name="editarConfirmarPassword" value=""  required minlength="12" maxlength="100">
                    </div>
                </div>









            <button type="submit" name="submit" value="Editar" class="caixa-info__botao  btn btn-success mgt-10 ">Alterar Palavra Passe</button>
            <a href="<?php echo ROOT_URL; ?>inicio/agente" class="  btn btn-secondary mgt-10 ">Voltar</a>

           

    </form>

