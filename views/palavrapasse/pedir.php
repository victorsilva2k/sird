
<style>
    .cabecalho--top, .barra-lateral {
        display: none;
    }

</style>
<form method="POST" class="caixa-info br-25">
    <div class="caixa-info__titulo">
        <p>Recuperar Palavra-passe</p>
    </div>

    <input type="hidden" name="ComandoMunicipalEliminado" value="<?php echo $this->param?>">

    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho"><h3 >Inserir NIP</h3></div>
        <div class="caixa-info__descricao  ">
            <input  type="text" class="caixa-info__input input--text" name="PedirPasseNIP" placeholder="Ex: 8716" id="" required maxlength="10" minlength="3">
        </div>
    </div>


    <button type="submit" name="submit" value="Confirmar" class="caixa-info__botao  btn btn-success mgt-10 ">Solicitar</button>

           




