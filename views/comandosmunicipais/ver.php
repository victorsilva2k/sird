<style>
    .comando-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<div class="bairros content-div br-25 mgb-20">
    <?php foreach($viewmodel as $item) : extract($item);?>
        <div class="content-div__cima">

            <h1 class="titulo--normal content-div__titulo">Comando Municipal de <?php echo $municipio?></h1>
        </div>



        <div class="content-div__baixo">

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Província</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $provincia?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Endereço</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo "$municipio, $distrito, $bairro, $rua"?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Terminal</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $terminal?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Data de Criação</h3></div>
                <div class="caixa-info__descricao"><p><?php echo $this->tratarData($data_criacao, true)?></p></div>
            </div>
        </div>
    <?php endforeach;?>


</div>

<?php if(Controller::verificarLugar(3)): ?>
    <a href="<?php echo ROOT_URL?>comandosmunicipais/editar/<?php echo $id_cm?>" class="  btn btn-success mgt-10 ">Editar</a>
<?php endif;?>
