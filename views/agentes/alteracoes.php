<style>
    .navegacao-lateral__item:nth-child(3) {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>

        <div class="alteracoe-agente content-div br-25">
                <div class="content-div__cima">


                    <h1 class="titulo--normal content-div__titulo">Alterações</h1>
                </div>

                <div class="content-div__baixo">
                <table class="tabela tabela-striped">
                    <thead>
                        <tr>

                        <th scope="col">Agente</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Data</th>
                        <th scope="col">Responsável</th>
                        <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($viewmodel as $item) : extract($item);?>

                        <tr>
                        <td><?php echo "$sobrenome"?></td>
                        <td><?php echo ucfirst($campo_editado) . ": $novo_valor "?></td>
                        <td><?php switch ($estado) {
                                        case 1:
                                            $estado = 'Pendente';
                                            break;
                                        case 2:
                                            $estado = 'Aceito';
                                            break;
                                        case 3:
                                            $estado = 'Negado';
                                            break;
                                        default:
                                            $estado = 'Pendente';

                                            break;
                                    }
                                    echo $estado;
                        ?></td>
                        <td><?php  echo $oficial_responsavel;?></td>
                        <td>
                        <a href="<?php echo ROOT_URL; ?>agentes/aceitar/<?php echo $id?>" class="center-t btn btn-success mb-4 ">Aceitar</a>
                        <a href="<?php echo ROOT_URL; ?>agentes/negar/<?php echo $id?>" class="center-t btn btn-danger mb-4 ">Negar</a>
                        </td>

                        </tr>

                    <?php endforeach;?>
                    
                    </tbody>
                </table>
                    <div class="btn-groupo">
                        <a href="<?php echo ROOT_URL; ?>categorias/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar Categoria</a>

                    </div>
                </div>
            </div>
    