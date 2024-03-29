<style>
    .navegacao-lateral__item:nth-child(2) {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>


    <?php  if(Controller::verificarLugar(2)): ?>


        <div class="btn-groupo">
            <a href="<?php echo ROOT_URL; ?>postos/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar Posto</a>

        </div>

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
                <?php foreach($viewmodel as $item) : extract($item);?>

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
    <?php elseif($_SESSION['usuario_local']['tipo_local'] === "posto"):?>
        <div class="caixa-info br-25">
            <div class="caixa-info__titulo">
                <p>Informações Posto</p>
            </div>
            <?php foreach($viewmodel["posto"] as $item) : extract($item);?>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                    <div class="caixa-info__descricao"><p ><?php
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
                            ?></p></div>
                </div>

                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Município</h3></div>
                    <div class="caixa-info__descricao"><p ><?php echo $municipio?></p></div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
                    <div class="caixa-info__descricao"><p ><?php echo $distrito?></p></div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
                    <div class="caixa-info__descricao"><p ><?php echo $bairro?></p></div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
                    <div class="caixa-info__descricao"><p ><?php echo $rua?></p></div>
                </div>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Data de Criação</h3></div>
                    <div class="caixa-info__descricao"><p ><?php echo $this->tratarData($data_criacao, true)?></p></div>
                </div>

                
            <?php endforeach;?>






        </div>

    <?php endif;?>


