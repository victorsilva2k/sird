<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>


        <div class="btn-groupo mgb-10">
            <a href="<?php echo ROOT_URL; ?>mais/index/distrito" class="center-t btn btn-secondary mb-4 ">Distritos</a>
            <a href="<?php echo ROOT_URL; ?>mais/index/bairro" class="center-t btn btn-secondary mb-4 ">Categorias e Bairros</a>

        </div>
        <div class="mais">

            <?php if($this->param == "bairro" OR $this->param == NULL OR $this->param == ""):?>


            <div class="categoria-documentos content-div br-25">
                <div class="content-div__cima">


                    <h1 class="titulo--normal content-div__titulo">Categoria de Documentos</h1>
                </div>

                <div class="content-div__baixo">
                    <table class="tabela tabela-striped">
                        <thead>
                        <tr>


                            <th scope="col">Categoria</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($viewmodel["categorias"] as $item) : extract($item);?>

                        <tr>

                            <td><?php echo $categoria?></td>
                            <td>
                                <a href="<?php echo ROOT_URL; ?>categorias/editar/<?php echo $id_categoria_documento?>" class="center-t btn btn-success mb-4 ">Editar</a>
                                <a href="<?php echo ROOT_URL; ?>categorias/eliminar/<?php echo $id_categoria_documento?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
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


            <div class="bairros content-div br-25">
                <div class="content-div__cima">


                    <h1 class="titulo--normal content-div__titulo">Bairros</h1>
                </div>

                <div class="content-div__baixo">

                    <table class="tabela tabela-striped">
                        <thead>
                        <tr>
                            <th scope="col">Bairro</th>
                            <th scope="col">Distrito</th>
                            <th scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($viewmodel["bairros"] as $item) : extract($item);?>

                        <tr>

                            <td><?php echo $bairro?></td>
                            <td><?php echo $distrito?></td>
                            <td>
                                <a href="<?php echo ROOT_URL; ?>bairros/editar/<?php echo $id_bairro?>" class="center-t btn btn-success mb-4 ">Editar</a>
                                <a href="<?php echo ROOT_URL; ?>bairros/eliminar/<?php echo $id_bairro?>" class="center-t btn btn-danger mb-4 ">Eliminar</a>
                            </td>


                            <?php endforeach;?>

                        </tbody>
                    </table>
                    <div class="btn-groupo">
                        <a href="<?php echo ROOT_URL; ?>bairros/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar Bairro</a>

                    </div>
                </div>
            </div>

            <?php elseif($this->param = "distrito"): ?>

                <div class="distritos content-div br-25">
                    <div class="content-div__cima">


                        <h1 class="titulo--normal content-div__titulo">Distritos</h1>
                    </div>

                    <div class="content-div__baixo">

                        <table class="tabela tabela-striped">
                            <thead>
                            <tr>
                                <th scope="col">Distrito</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($viewmodel["distritos"] as $item) : extract($item);?>

                            <tr>


                                <td><?php echo $distrito?></td>
                                <td>
                                    <a href="<?php echo ROOT_URL; ?>distritos/editar/<?php echo $id_distrito?>" class="center-t btn btn-success mb-4 ">Editar</a>

                                </td>


                                <?php endforeach;?>

                            </tbody>
                        </table>
                        <div class="btn-groupo">
                            <a href="<?php echo ROOT_URL; ?>distritos/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar Distrito</a>

                        </div>
                    </div>
                </div>


            <?php endif;?>


        </div>



