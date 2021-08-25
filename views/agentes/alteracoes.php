<style>
    .agente_link {
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
                        <td><?php echo "$nome  " . "$sobrenome"?></td>
                        <td><?php if ($campo_editado == "foto_arquivo"):?>
                                <?php if ($estado == 1):?>
                                <img src="<?php echo ROOT_IMG; ?>agentes/<?php echo $novo_valor; ?>" alt="Foto Usuário" class="img-thumbnail tabela--imagem">
                                    <?php else:?>
                                        <?php echo "Foto";?>
                                <?php endif;?>
                                <?php else:?>
                            <?php echo ucfirst($campo_editado) . ": $novo_valor "?>

                                <?php endif;?>
                            
                            
                            
                            
                    </td>
                        <td><?php switch ($estado) {
                            case 1:
                                            $estado_extenso = 'Pendente';
                                            break;
                                        case 2:
                                            $estado_extenso = 'Aceito';
                                            break;
                                        case 3:
                                            $estado_extenso = 'Negado';
                                            break;
                                        default:
                                            $estado_extenso = 'Pendente';

                                            break;
                                    }
                                    echo $estado_extenso;
                        ?></td>
                        <td><?php echo $this->tratarData($data);?></td>

                        <?php 
                        $oficial_responsavel = $responsavel_nome . " " . $responsavel_sobrenome;
                            if ($responsavel_nome == NULL OR $responsavel_sobrenome == NULL) {
                                $oficial_responsavel = "N/A";
                            } 
                        ?>

                        <td><?php  echo $oficial_responsavel;?></td>
                        <td>
                        <?php if($estado == 1):?>   
                        <a href="<?php echo ROOT_URL; ?>agentes/permitiralteracao/<?php echo $id_permissao?>" class="center-t btn btn-success mb-4 ">Permitir</a>
                        <a href="<?php echo ROOT_URL; ?>agentes/negaralteracao/<?php echo $id_permissao?>" class="center-t btn btn-danger mb-4 ">Negar</a>
                        <?php endif;?>
                        </td>

                        </tr>

                    <?php endforeach;?>
                    
                    </tbody>
                </table>
                    <div class="btn-groupo">
                        <a href="<?php echo ROOT_URL; ?>agentes/" class="center-t btn btn-secondary mb-4 ">Voltar</a>

                    </div>
                </div>
            </div>
    