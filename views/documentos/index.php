<style>
    #documentos_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
    .navegacao-lateral__botao, .pesquisa-form__botao--normal {
        display: none !important;
    }
</style>
<div class="btn-groupo">
    <a href="<?php echo ROOT_URL; ?>documentos/publicar" class="btn-groupo__botao center-t btn btn-primary mb-4 ">Publicar Documento</a>

    </div>
<div class="paginacao">
    <p class="paginacao__paragrafo">Páginas</p>
    <div class="paginacao__digitos">
        <span class="paginacao__resultados">1-20 de 38</span>
        <div class="paginacao__controles">
            <a href="<?php echo ROOT_URL; ?>postos" class="paginacao__link">
                <svg class="paginacao__icone ">
                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-chevron-left"></use>
                </svg>
            </a>
            <a href="<?php echo ROOT_URL; ?>postos" class="paginacao__link">
                <svg class="paginacao__icone ">
                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-chevron-right"></use>
                </svg>
            </a>
        </div>
    </div>

</div>

<div class="opcoes-documentos">
    <div class="opcoes-documentos__div opcoes-documento__div--activada">
        <a href="<?php echo ROOT_URL; ?>documentos/listar/recebidos" class="opcoes-documentos__link opcoes-documento__link--activado">
            Recebidos
        </a>
    </div>
    <div class="opcoes-documentos__div ">
        <a href="<?php echo ROOT_URL; ?>documentos/listar/entregues" class="opcoes-documentos__link opcoes-documento__link--desactivado">
            Entregues
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
                <?php foreach($viewmodel['perdidos'] as $item) : extract($item);?>

                      <tr>
                        <td><?php echo ucwords($nome_completo);?></td>
                        <td><?php echo $this->verificarRepeticao($categorias)?></td>
                        <td>
                            <?php 
                                echo $this->tratarData($this->pegarPrimeiro($datas));
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo ROOT_URL; ?>documentos/editar/<?php echo $id_proprietario?>" class="center-t btn btn-secondary mb-4 ">Editar</a>
                            <a href="<?php echo ROOT_URL; ?>documentos/devolver/<?php echo $id_proprietario?>" class="center-t btn btn-success mb-4 ">Devolver</a>
                            <a href="<?php echo ROOT_URL; ?>documentos/ver/<?php echo $id_proprietario?>" class="center-t btn btn-secondary mb-4 ">Ver</a>
                            <a href="<?php echo ROOT_URL; ?>documentos/eliminar/<?php echo $id_proprietario?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                        </td>
                      </tr>

                <?php endforeach;?>

                </tbody>
</table>