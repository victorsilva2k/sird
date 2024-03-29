    <style>

    c.navegacao-lateral__botao, .barra-inferior__navegacao, .pesquisa-form__botao--normal, .barra-lateral, .cabecalho-direito__links-direito {
        display: none !important;
    }

    .cabecalho--top {
        width: 100% !important;
        
    }

    .principal {
        margin-left: auto !important;
    }
    .cabecalho-direito__agente {
            display: none !important;
        }
        .cabecalho-direito__cidadao {
            display: flex;
        }
    </style>
      
    <div class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Informações do cidadão</p>
        </div>
        <?php foreach($viewmodel['documento'] as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $nome_proprietario?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Documentos</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $this->verificarRepeticao($categorias)?></p></div>
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
                    } elseif ($tipo_local == "comando_municipal") {
                        echo "Comando Municipal de $municipio ";
                        // HACK será que também uma forma de mostrar comandos provinciais
                    }

                    
                ?>
                

                
                </p></div>
            </div>

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Terminal do Local</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $terminal; ?></p></div>
            </div>
            <?php endforeach;?>
            
        
        
        
    </div>
    <div class="galeria galeria-info"> 
    <?php foreach($viewmodel['documento'] as $item){
           extract($item);
           $fotos = $this->verificarRepeticao($fotos);
            $foto_array = explode(",",$fotos);

        } 
        ?> 
        <?php foreach($foto_array as $foto) : ?>
                 
        <div class="br-25 bd-1 mgb-10 galeria__item">
            <img     class="cartoes__img-ver img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto; ?>" alt="Nome do Cidadão">
        </div>
        <?php endforeach;?>    

                
    </div>


