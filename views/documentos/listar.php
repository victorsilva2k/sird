<style>
    #documentos_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
    .navegacao-lateral__botao, .pesquisa-form__botao--normal {
        display: none !important;
    }

</style>


<div class="container px-4">
  <div class="row gx-5">
    <div class="col">
        <div class="btn-groupo">
        <a href="<?php echo ROOT_URL; ?>documentos/publicar" class="btn-groupo__botao center-t btn btn-primary mb-4 ">Publicar Documento</a>

        </div>
    </div>

  </div>
</div>
<div class="opcoes-documentos">
    <div class="opcoes-documentos__div <?php echo ($this->param === 'recebidos' ?  'opcoes-documento__div--activada' :  'opcoes-documento__link--desactivado'); ?>">
        <a href="<?php echo ROOT_URL; ?>documentos/recebidos" class="opcoes-documentos__link opcoes-documento__link--activado">
            Recebidos
        </a>
    </div>
    <div class="opcoes-documentos__div  <?php echo ($this->param === 'entregues' ?  'opcoes-documento__div--activada' :  'opcoes-documento__link--desactivado'); ?>">
        <a href="<?php echo ROOT_URL; ?>documentos/entregues" class="opcoes-documentos__link opcoes-documento__link--activado ">
            Entregues
        </a>
    </div>
    <div class="opcoes-documentos__div  <?php echo ($this->param === 'eliminados' ?  'opcoes-documento__div--activada' :  'opcoes-documento__link--desactivado'); ?>">
        <a href="<?php echo ROOT_URL; ?>documentos/eliminados" class="opcoes-documentos__link opcoes-documento__link--activado ">
            Eliminados
        </a>
    </div>
</div>
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
                <?php foreach($viewmodel as $item) : extract($item);?>

                      <tr>
                        <td><?php echo ucwords($nome_completo);?></td>
                        <td><?php echo $this->verificarRepeticao($categorias)?></td>
                        <td>
                            <?php 
                                echo $this->tratarData($this->pegarPrimeiro($datas));
                            ?>
                        </td>
                        <td>
                            
                            <a href="<?php echo ROOT_URL; ?>documentos/ver/<?php echo $id_proprietario?>" class="center-t btn btn-secondary mb-4 ">Ver</a>
                            
                            <?php if($this->param !== 'entregues' AND $tipo_local == $_SESSION['usuario_local']['tipo_local'] AND $id_local == $_SESSION['usuario_local']['id_local']): ?>
                                <a href="<?php echo ROOT_URL; ?>documentos/editar/<?php echo $id_proprietario?>" class="center-t btn btn-secondary mb-4 ">Editar</a>
                                <a href="<?php echo ROOT_URL; ?>documentos/devolver/<?php echo $id_proprietario?>" class="center-t btn btn-success mb-4 ">Devolver</a>
                                <a href="<?php echo ROOT_URL; ?>documentos/eliminar/<?php echo $id_proprietario?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                            <?php endif;?>
                        </td>
                      </tr>

                <?php endforeach;?>

                </tbody>
</table>