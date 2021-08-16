<style>
    .comando-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
<?php foreach($viewmodel['comando_nacional'] as $item) : extract($item);?>
<div class="bairros content-div br-25 mgb-20">
                <div class="content-div__cima">

                    <h1 class="titulo--normal content-div__titulo">Comando Nacional de Angola</h1>
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

</div>


</div>
    <div class="btn-group">
        <a href="<?php echo ROOT_URL; ?>comandonacional/editar/<?php echo $id_cn?>" class="mgb-20 center-t btn btn-success mb-4 ">Editar</a>
        <a href="<?php echo ROOT_URL; ?>comandonacional/registros/<?php echo $id_cn?>" class="center-t btn btn-secondary mb-4 ">Ver mais</a>
    </div>
<?php endforeach;?>


    <!-- COMANDOS PROVINCIAIS -->

    <div class="bairros content-div br-25">
                <div class="content-div__cima">


                    <h1 class="titulo--normal content-div__titulo">Comandos Provinciais</h1>
                </div>

                <div class="content-div__baixo">

                <table class="tabela tabela-striped">
                <thead>
                <tr>

                    <th scope="col">Nome</th>
                    <th scope="col">Província</th>
                    <th scope="col">Terminal</th>
                    <th scope="col">Ações</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($viewmodel['comando_provincial'] as $item) : extract($item);?>

                    <tr>

                        <td><?php echo $nome_cp?></td>
                        <td><?php echo $provincia?></td>
                        <td><?php echo $terminal?></td>
                        <td>
                            <a href="<?php echo ROOT_URL; ?>comandosprovinciais/ver/<?php echo $id_cp?>" class="center-t btn btn-secondary mb-4 ">Ver</a>
 
                            <a href="<?php echo ROOT_URL; ?>comandosprovinciais/editar/<?php echo $id_cp?>" class="center-t btn btn-primary mb-4 ">Editar</a>

                            <a href="<?php echo ROOT_URL; ?>comandosprovinciais/eliminar/<?php echo $id_cp?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>

                        </td>
                    </tr>

                <?php endforeach;?>

                </tbody>
            </table>
                    <div class="btn-groupo">
                        <a href="<?php echo ROOT_URL; ?>comandosprovinciais/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar comando provincial</a>

                    </div>
                </div>
            </div>
 

