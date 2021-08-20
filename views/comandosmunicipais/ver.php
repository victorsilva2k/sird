<style>
    .comando_m_link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<?php foreach($viewmodel['comando_municipal'] as $item) : extract($item);?>
    <div class="bairros content-div br-25 mgb-20">
        <div class="content-div__cima">

            <h1 class="titulo--normal content-div__titulo">Comando Municipal de <?php echo $municipio?><?php if($estado_actividade == 2): echo " (Eliminado)"?> <?php endif;?></h1>
        </div>



        <div class="content-div__baixo">

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3>Província</h3></div>
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


    </div>


<?php endforeach;?>

<a href="<?php echo ROOT_URL; ?>comandosmunicipais/registros/<?php echo $id_cm?>" class="center-t btn btn-primary  ">Ver mais</a>
<?php if($estado_actividade == 1):?>
<a href="<?php echo ROOT_URL?>comandosmunicipais/editar/<?php echo $id_cm?>" class="  btn btn-success mgt-10 ">Editar</a>
<?php endif;?>
<?php if(Controller::verificarLugar(3, true)): ?>
    <a href="<?php echo ROOT_URL; ?>comandosprovinciais/" class="caixa-info__botao  btn btn-secondary mgt-10 ">Voltar</a>

<?php endif;?>
<?php if(Controller::verificarLugar(4)): ?>
    <a href="<?php echo ROOT_URL; ?>comandonacional/" class="caixa-info__botao  btn btn-secondary mgt-10 ">Voltar</a>
<?php endif;?>

<?php if($estado_actividade == 1):?>

<div class="documentos-recentes">

    <h1 class="titulo--normal">Postos</h1>

    <table class="tabela tabela-striped">
        <thead>
        <tr>

            <th scope="col">Posto</th>
            <th scope="col">Distrito</th>
            <th scope="col">Bairro</th>
            <th scope="col">Estado</th>
            <th scope="col">Ações</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($viewmodel['postos'] as $item) : extract($item);?>

            <tr>
                <td><?php
                    if ($tipo == 1) {
                        $tipo_extenso = "Esquadra";
                    }
                    elseif ($tipo == 2) {
                        $tipo_extenso = "Posto";
                    }
                    elseif ($tipo == 3) {
                        $tipo_extenso = "Destacamento Policial";
                    }

                    echo "$tipo_extenso $nome"
                    ?>

                </td>
                <td><?php echo $distrito?></td>
                <td><?php echo $bairro?></td>
                <td>
                    <?php
                    switch ($estado_actividade) {
                        case 1:
                            $estado = "Activo";
                            break;
                        case 2:
                            $estado = "Eliminado";
                            break;
                        default:
                            $estado = "Activo";
                    }
                    echo ucfirst($estado);

                    ?>
                </td>
                <td>
                    <a href="<?php echo ROOT_URL; ?>postos/ver/<?php echo $id_posto?>" class="center-t btn btn-secondary mb-4 ">Ver</a>
                    <?php if($estado_actividade == 1):?>
                        <a href="<?php echo ROOT_URL; ?>postos/editar/<?php echo $id_posto?>" class="center-t btn btn-primary mb-4 ">Editar</a>

                        <a href="<?php echo ROOT_URL; ?>postos/eliminar/<?php echo $id_posto?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                    <?php endif;?>
                </td>
            </tr>

        <?php endforeach;?>

        </tbody>
    </table>
</div>
<div class="btn-groupo">
    <a href="<?php echo ROOT_URL; ?>postos/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar Posto</a>

</div>

<?php endif;?>
