<style>
    .mais-link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>


        <div class="btn-groupo mgb-10">
            <a href="<?php echo ROOT_URL; ?>mais/index/bairro" class="center-t btn btn-secondary mb-4 ">Bairros e Distritos</a>
            <a href="<?php echo ROOT_URL; ?>mais/index/municipio" class="center-t btn btn-secondary mb-4 ">Municipios e Provincias</a>
            <a href="<?php echo ROOT_URL; ?>mais/index/categoria" class="center-t btn btn-secondary mb-4 ">Categorias</a>

        </div>
        <div class="mais">
            <!-- Mostra as abas de Bairros e Distritos -->
            <?php if($this->param == "bairro" OR $this->param == NULL OR $this->param == ""):?>


                


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

                <div class="distritos content-div br-25">
                    <div class="content-div__cima">


                        <h1 class="titulo--normal content-div__titulo">Distritos</h1>
                    </div>

                    <div class="content-div__baixo">

                        <table class="tabela tabela-striped">
                            <thead>
                            <tr>
                                <th scope="col">Distrito</th>
                                <th scope="col">Município</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($viewmodel["distritos"] as $item) : extract($item);?>

                            <tr>


                                <td><?php echo $distrito?></td>
                                <td><?php echo $municipio?></td>
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
            <!-- Mostra as abas de Municipio e Provincias, de acordo com o parametro que recebe -->
            <?php elseif($this->param == "municipio"): ?>

                <div class="municipios content-div br-25">
                    <div class="content-div__cima">


                        <h1 class="titulo--normal content-div__titulo">Municipios</h1>
                    </div>

                    <div class="content-div__baixo">

                        <table class="tabela tabela-striped">
                            <thead>
                            <tr>
                                <th scope="col">Município</th>
                                <th scope="col">Província</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($viewmodel["municipios"] as $item) : extract($item);?>

                            <tr>

                                <td><?php echo $municipio?></td>
                                <td><?php echo $provincia?></td>
                                <td>
                                    <a href="<?php echo ROOT_URL; ?>municipios/editar/<?php echo $id_municipio?>" class="center-t btn btn-success mb-4 ">Editar</a>
                                <!-- Não há opção de eliminar pois isso iria alterar os locais que já têm esse municipio ou localização GERAL -->
                                </td>


                                <?php endforeach;?>

                            </tbody>
                        </table>
                        <div class="btn-groupo">
                            <a href="<?php echo ROOT_URL; ?>municipios/adicionar" class="center-t btn btn-primary mb-4 ">Adicionar Municipio</a>

                        </div>
                    </div>
                </div>

                <div class="provincias content-div br-25">
                    <div class="content-div__cima">


                        <h1 class="titulo--normal content-div__titulo">Provincias</h1>
                    </div>

                    <div class="content-div__baixo">

                        <table class="tabela tabela-striped">
                            <thead>
                            <tr>
                                <th scope="col">Provincia</th>
                                <th scope="col">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($viewmodel["provincias"] as $item) : extract($item);?>

                            <tr>


                                <td><?php echo $provincia?></td>
                                <td>
                                    <a href="<?php echo ROOT_URL; ?>provincias/editar/<?php echo $id_provincia?>" class="center-t btn btn-success mb-4 ">Editar</a>
            
                                </td>


                                <?php endforeach;?>

                            </tbody>
                        </table>
                        <div class="btn-groupo">
                            <a href="<?php echo ROOT_URL; ?>bairros/provincias" class="center-t btn btn-prim   ary mb-4 ">Adicionar Provincia</a>

                        </div>
                    </div>
                </div>


            <?php elseif($this->param == "categoria"): ?>
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
            <?php endif;?>


        </div>



