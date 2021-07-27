<style>
    .navegacao-lateral__botao, .pesquisa-form__botao--normal {
        display: none !important;
    }
</style>
    
    <div class="btn-groupo">
        <a href="<?php echo ROOT_URL; ?>documentos/publicar" class="btn-groupo__botao center-t btn btn-primary mb-4 ">Publicar Documento</a>
        <a href="<?php echo ROOT_URL; ?>documentos/" class="btn-groupo__botao center-t btn btn-success mb-4 ">Devolver Documento</a>
    </div>
    <?php if($_SESSION['usuario_local']['tipo_local'] === 'posto'): ?>
        <div class="visao-geral mgt-20">
                <div class="visao-geral__total-doc visao-geral__div br-25">
                    <h1 class="visao-geral__titulo"><?php echo $viewmodel['estatisticas'][0]['total_documentos'];?></h1>
                    <p class="visao-geral__texto-normal">Total Documentos</p>
                </div>
                <div class="visao-geral__doc-retido visao-geral__div br-25">
                    <h1 class="visao-geral__titulo"><?php echo $viewmodel['estatisticas'][1]['total_documentos'];?></h1>
                    <p class="visao-geral__texto-normal">Documentos Retidos</p>
                </div>
                <div class="visao-geral__doc-devolvido visao-geral__div br-25">
                    <h1 class="visao-geral__titulo"><?php echo $viewmodel['estatisticas'][0]['total_documentos'] - $viewmodel['estatisticas'][1]['total_documentos'];?></h1>
                    <p class="visao-geral__texto-normal">Documentos Devolvidos</p>
                </div>

        </div>
    <?php else:?>
        <div class="visao-geral mgt-20">
            <div class="visao-geral__total-doc visao-geral__div br-25">
                <h1 class="visao-geral__titulo"><?php echo $viewmodel['estatisticas'][0]['total_documentos'] + $viewmodel['estatisticas'][1]['total_documentos'];?></h1>
                <p class="visao-geral__texto-normal">Total Documentos</p>
            </div>
            <div class="visao-geral__doc-retido visao-geral__div br-25">
                <h1 class="visao-geral__titulo"><?php echo $viewmodel['estatisticas'][0]['total_documentos'];?></h1>
                <p class="visao-geral__texto-normal">Documentos Retidos</p>
            </div>
            <div class="visao-geral__doc-devolvido visao-geral__div br-25">
                <h1 class="visao-geral__titulo"><?php echo $viewmodel['estatisticas'][1]['total_documentos'];?></h1>
                <p class="visao-geral__texto-normal">Documentos Devolvidos</p>
            </div>

        </div>
    <?php endif;?>
    <div class="documentos-recentes">
    
        <h1 class="titulo--normal">Documentos Perdidos</h1>
    
        <table class="tabela tabela-striped">
  <thead>
    <tr>

      <th scope="col">Nome Completo</th>
      <th scope="col">Documentos</th>
      <th scope="col">Data</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
                <?php foreach($viewmodel['documentos'] as $item) : extract($item);?>

                      <tr>
                        <td><?php echo ucwords($nome_completo);?></td>
                        <td><?php echo $this->verificarRepeticao($categorias)?></td>
                        <td>
                            <?php 
                                echo $this->tratarData($this->pegarPrimeiro($datas), true);
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo ROOT_URL; ?>documentos/editar/<?php echo $id_proprietario?>" class="center-t btn btn-success mb-4 ">Editar</a>
                            <a href="<?php echo ROOT_URL; ?>documentos/ver/<?php echo $id_proprietario?>" class="center-t btn btn-secondary mb-4 ">Ver</a>
                            <a href="<?php echo ROOT_URL; ?>documentos/eliminar/<?php echo $id_proprietario?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                        </td>
                      </tr>

                <?php endforeach;?>

                </tbody>
</table>
    </div>