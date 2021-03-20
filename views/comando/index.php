
    <div class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Informações do Comando Municipal</p>
        </div>
            <?php foreach($viewmodel as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p >Comando Municipal de <?php echo $municipio?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Província</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $provincia?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Município</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $municipio?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $distrito?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $bairro?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $rua?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Data de Criação</h3></div>
                <!-- TODO tratar a data para aparecer em português -->
                <div class="caixa-info__descricao"><p ><?php echo $this->tratarData($data_criacao, true)?></p></div>
            </div>
            <?php endforeach;?>
           
            
        
        
        
        
    </div>
    <a href="<?php echo ROOT_URL?>comando/editar" class="  btn btn-success mgt-10 ">Editar</a>

