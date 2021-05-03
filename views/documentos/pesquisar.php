
        <div class="galeria cartoes"> 

            <?php foreach($viewmodel as $item) : extract($item);
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
