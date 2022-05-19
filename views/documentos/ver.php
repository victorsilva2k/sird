
      
    <div class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Informações do cidadão</p>
        </div>
        <?php foreach($viewmodel['documento'] as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome Do Proprietário</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $nome_proprietario?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Número de Telefone/s</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $this->verificarRepeticao($telefone_proprietario)?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome do Entregador</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $nome_entregador?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Número do Entregador</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $telefone_entregador?></p></div>
            </div>2
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
                    } else {
                        echo "Comando Municipal de Talatona ";
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

    <div class="alteracoes-documento registro-alteracoes">
            <h1 class="titulo--normal">Registro de Alterações</h1>

            <table class="tabela tabela-striped">
                <thead>
                <tr>

                    <th scope="col">Agente</th>
                    <th scope="col">Acção</th>
                    <th scope="col">Data</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($viewmodel["alteracoes"] as $item) : extract($item);?>

                    <tr>
                        
                        <td><?php echo "$nome $sobrenome"?></td>
                        <td><?php
                            if ($tipo == 1) {
                                $tipo_extenso = "Criado";
                            }
                            elseif ($tipo == 2) {
                                $tipo_extenso = "Editado";
                            }
                            elseif ($tipo == 3) {
                                $tipo_extenso = "Eliminado";
                            }
                            elseif ($tipo == 4) {
                                $tipo_extenso = "Entregue";
                            }

                            echo "$tipo_extenso";
                            ?>

                        </td>
                        <td><?php echo $this->tratarData($data, true)?></td>

                    </tr>

                <?php endforeach;?>



