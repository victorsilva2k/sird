<style>
    .comando-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<div class="bairros content-div br-25 mgb-20">
    <?php foreach($viewmodel['comando_provincial'] as $item) : extract($item);?>
        <div class="content-div__cima">

            <h1 class="titulo--normal content-div__titulo">Comando Provincial de <?php echo $nome_cp?></h1>
        </div>



        <div class="content-div__baixo">
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p >Comando Municipal de <?php echo $municipio?></p></div>
            </div>
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

        </div>
    <?php endforeach;?>


</div>

    <?php if($_SESSION['usuario_local']['tipo_local'] === "comando_municipal"): ?>
    <a href="<?php echo ROOT_URL?>comando/editar" class="  btn btn-success mgt-10 ">Editar</a>
    <?php endif;?>
