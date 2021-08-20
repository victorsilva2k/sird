<style>
    .comando_p_link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<?php foreach($viewmodel['comando_provincial'] as $item) : extract($item);?>
<div class="bairros content-div br-25 mgb-20">
                <div class="content-div__cima">

                    <h1 class="titulo--normal content-div__titulo">Comando Provincial de <?php echo $nome_cp?></h1>
                </div>


            
            <div class="content-div__baixo">
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                    <div class="caixa-info__descricao"><p >Comando Provincial de <?php echo $nome_cp?></p></div>
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



</div>
    <a href="<?php echo ROOT_URL; ?>comandosprovinciais/editar/<?php echo $id_cp?>" class="mgb-20 center-t btn btn-success mb-4 ">Editar</a>
    <a href="<?php echo ROOT_URL; ?>comandosprovinciais/registros/<?php echo $id_cp?>" class=" mgb-20 center-t btn btn-secondary mb-4 ">Ver mais</a>

<?php endforeach;?>


    <!-- COMANDOS MUNICIPAIS -->

<div class="bairros content-div br-25">
    <div class="content-div__cima">


        <h1 class="titulo--normal content-div__titulo">Comandos Municipais</h1>
    </div>

    <div class="content-div__baixo">

        <table class="tabela tabela-striped">
            <thead>
            <tr>

                <th scope="col">Nome</th>
                <th scope="col">Província</th>
                <th scope="col">Terminal</th>
                <th scope="col">Estado</th>
                <th scope="col">Ações</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($viewmodel['comando_municipal'] as $item) : extract($item);?>

                <tr>

                    <td><?php echo $municipio?></td>
                    <td><?php echo $provincia?></td>
                    <td><?php echo $terminal?></td>
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
                        <a href="<?php echo ROOT_URL; ?>comandosmunicipais/ver/<?php echo $id_cm?>" class="center-t btn btn-secondary mb-4 ">Ver</a>
                        <?php if($estado_actividade == 1):?>
                            <a href="<?php echo ROOT_URL; ?>comandosmunicipais/editar/<?php echo $id_cm?>" class="center-t btn btn-primary mb-4 ">Editar</a>

                            <a href="<?php echo ROOT_URL; ?>comandosmunicipais/eliminar/<?php echo $id_cm?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                        <?php endif;?>
                    </td>

                </tr>

            <?php endforeach;?>

            </tbody>
        </table>
        <div class="btn-groupo">
            <a href="<?php echo ROOT_URL; ?>comandosmunicipais/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar comando municipal</a>

        </div>
    </div>
</div>
 

            <a href="<?php echo ROOT_URL; ?>comandonacional/" class="caixa-info__botao  btn btn-secondary mgt-10 ">Voltar</a>