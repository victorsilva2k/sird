
      
    <div class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Informações do cidadão</p>
        </div>
        <?php foreach($viewmodel['documento'] as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $nome_completo?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Documentos</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $categorias?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Data</h3></div>
                <div class="caixa-info__descricao"><p >
                <?php 


                    $data_array = explode(",",$datas);
                    $data = $data_array[0];
                    echo $this->tratarData($data, true);

                    
                ?>
                </p></div>
            </div>
            <?php endforeach;?>
            <?php foreach($viewmodel['local'] as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Localização</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo ucfirst($municipio) . ", " .  ucfirst($distrito) . ", " .  ucfirst($bairro) . ", Rua " . $rua?></p></div>
            </div>
            
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Posto/Esquadra</h3></div>
                <div class="caixa-info__descricao"><p >
                <?php 
                    if ($tipo_local == 'posto') {
                        echo ucwords($nome);
                    } else {
                        echo "Comando Municipal de Talatona ";
                    }

                    
                ?>
                

                
                </p></div>
            </div>
            <?php endforeach;?>
            
        
        
        
    </div>
    <div class="galeria galeria-info"> 
        <?php foreach($viewmodel['documento'] as $item) : extract($item);
            $foto_array = explode(",",$fotos);
            $foto1 = $foto_array[0];
            $foto2 = $foto_array[1];
        ?>              
        <div class="br-25 bd-1 mgb-10 galeria__item">
            <img     class="cartoes__img img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto1; ?>" alt="Nome do Cidadão">
        </div>
        <div class="br-25 bd-1 mgb-10 galeria__item">
            <img     class="cartoes__img img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto2; ?>" alt="Nome do Cidadão">
        </div>
        <?php endforeach;?>
                
    </div>


