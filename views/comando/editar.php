
      
    <form method="post" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Informações do Comando Municipal</p>
        </div>
            <?php foreach($viewmodel as $item) : extract($item);?>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p >Comando Municipal de <?php echo $municipio?></p></div>
            </div>
    
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Distrito</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="cm_distrito" value="<?php echo $distrito?>" id="">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Bairro</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="cm_bairro" value="<?php echo $bairro?>" id="">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Rua</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" name="cm_rua" value="<?php echo $rua?>" id="">
                </div>
            </div>
            <button type="submit" name="submit" class="caixa-info__botao  btn btn-success mgt-10 ">Guardar alterações</button>
            <?php endforeach;?>
           

    </form>


