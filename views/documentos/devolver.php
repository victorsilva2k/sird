
        <div class="btn-grupo mgt-10 mgb-10">
            <form method="POST" class="">
                <button type="submit" name="submit" value="Devolver" type="submit" name="submit"  class="  btn btn-success ">Devolver Documentos</button>
                <?php foreach($viewmodel['documento'] as $item) : extract($item);?>
                <input type="hidden" name="devolverIdDocumento" value="<?php 
                $id_raw = explode(",",$ids );
                echo $id_raw[0]?>
                
                ">
                <?php endforeach;?>
                <a href="<?php echo ROOT_URL; ?>documentos" class="  btn btn-secondary mb-4 ">Voltar</a>
            </form>    
        </div>
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
                <div class="caixa-info__descricao"><p><?php echo $this->verificarRepeticao($categorias)?></p></div>
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
    <?php foreach($viewmodel['documento'] as $item){
           extract($item);

            $foto_array = explode(",",$fotos);

        } 
        ?> 
        <?php foreach($foto_array as $foto) : ?>
                 
        <div class="br-25 bd-1 mgb-10 galeria__item">
            <img     class="cartoes__img-ver img--perfil" src="<?php echo ROOT_IMG; ?>documentos/<?php echo $foto; ?>" alt="Nome do Cidadão">
        </div>
        <?php endforeach;?>    

                
    </div>


