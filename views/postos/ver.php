<style>
    .navegacao-lateral__item:nth-child(2) {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>

        <div class="caixa-info br-25">
            <?php foreach($viewmodel as $item) : extract($item);?>
                <div class="caixa-info__item">
                    <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                    <div class="caixa-info__descricao"><p ><?php
                            if ($tipo == 1) {
                                $tipo_extenso = "Esquadra";
                            }
                            elseif ($tipo == 2) {
                                $tipo_extenso = "Posto";
                            }
                            elseif ($tipo == 3) {
                                $tipo_extenso = "Destacamento Policial";
                            }

                            echo "$tipo_extenso $nome"
                            ?></p></div>
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
                    <div class="caixa-info__descricao"><p ><?php echo $this->tratarData($data_criacao, true)?></p></div>

                </div>

            <?php endforeach;?>

        </div>
        <a href="<?php echo ROOT_URL?>postos/" class="  btn btn-secondary mgt-10 ">Voltar</a>


