        <?php 
            $pagina = $viewmodel['pesquisar']['pagina'];
            $valor = $viewmodel['pesquisar']['valor'];

        ?>
        <div class="container px-4">
            <div class="row gx-5">

                <div class="col">
                    <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        <li class="page-item">
             
                        <a class="page-link" href="<?php echo ROOT_URL . "documentos/pesquisar?pesquisar=" . $valor . "?pagina=";
                        
                        if ($pagina <= 1) {
                            echo 1;
                        } else {
                            echo ($pagina - 1);
                        }
                        ?>">Anterior</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">
                            <?php  
                            if (strlen($pagina) > 3) {
                                echo 1;
                            }else {
                                echo $pagina;
                                
                            }
                            ?>
                        </a></li>
                        <a class="page-link" href="<?php echo ROOT_URL . "documentos/pesquisar?pesquisar=" . $valor . "?pagina=" ;
                        
                        if ($pagina <= 1) {
                            echo "2";
                        } else {
                         
                            echo ($pagina + 1);
                        }
                        ?>">Próximo</a>
                        </li>
                    </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="galeria cartoes"> 
            
            <?php foreach($viewmodel['documentos'] as $item) : extract($item);
                $foto_array = explode(",",$fotos);
                $foto = $foto_array[0];
            ?>
                <a href="<?php echo ROOT_URL; ?>documentos/ver/<?php echo $id_proprietario; ?>" class="responsive-item ">
                    <div class="cartoes__cartao br-25 ">
                        <div class="cartoes__div-img">
                            <img     class="cartoes__img img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto; ?>" alt="Nome do Cidadão">
                        </div>
                        <div class="cartoes__texto">
                            <ul class="cartoes__lista">
                                <li>Nome: <?php echo $nome_completo; ?></li>
                                <li>Documentos: <?php echo $this->verificarRepeticao($categorias); ?></li>
                            </ul>
                        </div>
                        
                    </div>
                </a>
            <?php endforeach;?>
