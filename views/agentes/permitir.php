<style>
    .agente_link {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>

<form method="POST" class="caixa-info br-25">
    <div class="caixa-info__titulo">
        <p>Agente</p>
    </div>
    <?php foreach($viewmodel["agente"] as $item) : extract($item);?>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>Foto</h3>
        </div>
        <div class="caixa-info__descricao">
            <img src="<?php echo ROOT_IMG; ?>agentes/<?php echo $foto?>" alt="Foto Usuário"
                class="caixa-info__foto-usuario caixa-info__img img--perfil">
        </div>
    </div>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>Nome</h3>
        </div>
        <div class="caixa-info__descricao">
            <p><?php echo "$nome $sobrenome"?></p>
        </div>
    </div>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>NIP</h3>
        </div>
        <div class="caixa-info__descricao">
            <p><?php echo $nip?></p>
        </div>
    </div>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>Data de Nascimento</h3>
        </div>
        <div class="caixa-info__descricao">
            <p><?php echo $this->tratarData($data_nascimento)?></p>
        </div>
    </div>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>Gênero</h3>
        </div>
        <div class="caixa-info__descricao">
            <p><?php echo $genero?></p>
        </div>
    </div>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>Tipo de estabelecimento</h3>
        </div>
        <div class="caixa-info__descricao  ">
            <select class="caixa-info__input input--text" name="permitirTipoEstabelecimento" id="">

                <?php  if(Controller::verificarLugar(2)): ?>
                    <!-- Agente de Comando Municipal -->
                    <option id="posto_check" value="Posto">Posto</option>

                <?php endif;?>
                <?php  if(Controller::verificarLugar(3)): ?>
                    <!-- Agente de Comando Provincial -->

                    <option id="comando_municipal_check" value="comando_municipal">Comando Municipal</option>
                
                <?php endif;?>
                <?php  if(Controller::verificarLugar(4)): ?>
                    <!-- Agente de Comando Nacional -->
                    <option id="comando_provincial_check" value="comando_provincial">Comando Provincial</option>
                    <option id="comando_nacional_check" value="comando_nacional">Comando Nacional</option>
                <?php endif;?>
            </select>
        </div>

    </div>
    <div class="caixa-info__item">
        <div class="caixa-info__cabecalho">
            <h3>Escolher</h3>
        </div>
        <div class="caixa-info__descricao  ">
            <div class="caixa-info__descricao  " id="selecionarPostos">
                <select class="caixa-info__input input--text" name="permitirPosto" id="">
                    <?php foreach($viewmodel["postos"] as $item) : extract($item);
                            if ($tipo == 1) {
                                $tipo_extenso = "Esquadra";
                            }
                            elseif ($tipo == 2) {
                                $tipo_extenso = "Posto";
                            }
                            elseif ($tipo == 3) {
                                $tipo_extenso = "Destacamento Policial";
                            }
                        ?>
                    <option value="<?php echo $id_posto?>"><?php echo "$tipo_extenso $nome"?></option>

                    <?php endforeach;?>
                </select>
            </div>
            <div class="caixa-info__descricao  " id="selecionarComandoMunicipal">
                <select class="caixa-info__input input--text" name="permitirComandoMunicipal" id="">
                    <?php foreach($viewmodel["comando_municipal"] as $item) : extract($item);?>

                    <option value="<?php echo $id_comando_municipal ?>"><?php echo "Comando Municipal de $municipio"?>
                    </option>

                    <?php endforeach;?>
                </select>
            </div>
            <div class="caixa-info__descricao  " id="selecionarComandoProvincial">
                <select class="caixa-info__input input--text" name="permitirComandoProvincial" id="">
                    <?php foreach($viewmodel["comando_provincial"] as $item) : extract($item);?>

                    <option value="<?php echo $id_comando_provincial?>"><?php echo "Comando Provincial de $nome"?>
                    </option>

                    <?php endforeach;?>
                </select>
            </div>
            <div class="caixa-info__descricao  " id="selecionarComandoNacional">
                <?php foreach($viewmodel["comando_nacional"] as $item) : extract($item);?>
                <input type="text" name="permitirComandoNacional" value="Comando Nacional de Angola" id=""
                    placeholder="Comando Nacional de Angola" class="caixa-info__input input--text" disabled>
                <input type="hidden" name="permitirComandoNacional" value="<?php echo $id_comando_nacional?>" hidden>
                <?php endforeach;?>
            </div>


        </div>
    </div>
    <button type="submit" name="submit" value="Permitir" class="caixa-info__botao  btn btn-success mgt-10 ">Permitir
        Cadastro</button>
    <a href="<?php echo ROOT_URL; ?>agentes/cadastros" class="center-t btn btn-secondary mb-4 ">Voltar</a>
    </div>


    <?php endforeach;?>


</form>


<!-- ERRO - botões não aparecem - CORREÇÃO: movi os botões para um elemento acima -->