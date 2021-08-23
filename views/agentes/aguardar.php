    <style>
        .cabecalho--top, .barra-lateral {
            display: none;
        }
    </style>
    <div class="caixa-info br-25">
        <?php foreach($viewmodel as $item) : extract($item);?>
        <div class="caixa-info__titulo">
            <?php if($estado_conta == 0): ?>
                <p>Aguarde até sua conta ser activada</p>
                <?php elseif($estado_conta == 4):?>
                <p>Aguarde a sua solicitação ser aceite</p>
            <?php endif;?>
        </div>
        <?php endforeach;?>
        
        
        
        
    </div>
    
