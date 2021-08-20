<style>
    .agente_link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>

    
    <div class="documentos-recentes">
    
        <h1 class="titulo--normal">Cadastros</h1>
        <div class=" bg-light col p-4 mt-4 mb-4 border rounded">
            


        </div>
        <table class="tabela tabela-striped">
            <thead>
                <tr>

                <th scope="col">Nome Completo</th>
                <th scope="col">NIP</th>
                <th scope="col">Gênero</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($viewmodel as $item) : extract($item);?>

                <tr>
                <td><?php echo "$nome $sobrenome"?></td>
                <td><?php echo $nip?></td>
                <td><?php echo $genero?></td>
                <td>
                <a href="<?php echo ROOT_URL; ?>agentes/permitir/<?php echo $id?>" class="center-t btn btn-success mb-4 ">Permitir</a>
                <a href="<?php echo ROOT_URL; ?>agentes/rejeitar/<?php echo $id?>" class="center-t btn btn-danger mb-4 ">Rejeitar</a>
                </td>

                </tr>

            <?php endforeach;?>
            
            </tbody>
        </table>
    </div>