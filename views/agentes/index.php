<style>
    .navegacao-lateral__item:nth-child(3) {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    
    <div class="btn-groupo">
    <a href="<?php echo ROOT_URL; ?>agentes/cadastros" class="center-t btn btn-success mb-4 ">Cadastros</a>
    <a href="<?php echo ROOT_URL; ?>agentes/edicoes" class="center-t btn btn-primary mb-4 ">Edições</a>

    </div>
    
    <div class="documentos-recentes">
    
        <h1 class="titulo--normal">Agentes</h1>
    
        <table class="tabela tabela-striped">
            <thead>
                <tr>

                <th scope="col">Nome Completo</th>
                <th scope="col">NIP</th>
                <th scope="col">Posto</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($viewmodel as $item) : extract($item);?>

                <tr>
                <td><?php echo "$agente_nome $sobrenome"?></td>
                <td><?php echo $nip?></td>
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
                    ?>

                    <?php echo "$tipo_extenso $posto_nome"?></td>
                <td>
                <a href="<?php echo ROOT_URL; ?>agentes/editar/<?php echo $id_agente?>" class="center-t btn btn-success mb-4 ">Editar</a>
                <a href="<?php echo ROOT_URL; ?>agentes/eliminar/<?php echo $id_agente?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                </td>

                </tr>

            <?php endforeach;?>
            
            </tbody>
        </table>
    </div>