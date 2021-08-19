
<style>
    .navegacao-lateral__item:nth-child(2) {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <form method="POST" class="caixa-info br-25">
        <div class="caixa-info__titulo">
            <p>Escolher local para mover ficheiros</p>
        </div>

            <input type="hidden" name="PostoEliminado" value="<?php echo $this->param?>">

            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Local</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="PostoEscolhido" id="">
                        <?php foreach($viewmodel as $item) : extract($item);?>

                            <div class="caixa-info__descricao"><p ></p></div>

                        <option value="<?php echo $id_posto?>"><?php
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
                            ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>


            <button type="submit" name="submit" value="Confirmar" class="caixa-info__botao  btn btn-success mgt-10 ">Confirmar</button>

           




