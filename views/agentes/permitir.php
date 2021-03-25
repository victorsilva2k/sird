<style>
    .navegacao-lateral__item:nth-child(3) {
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
                <div class="caixa-info__cabecalho"><h3 >Foto</h3></div>
                <div class="caixa-info__descricao">
                    <img src="<?php echo ROOT_IMG; ?>agentes/<?php echo $foto?>" alt="Foto Usuário" class="caixa-info__foto-usuario caixa-info__img img--perfil">
                </div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Nome</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo "$nome $sobrenome"?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >NIP</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $nip?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Data de Nascimento</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $this->tratarData($data_nascimento)?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Gênero</h3></div>
                <div class="caixa-info__descricao"><p ><?php echo $genero?></p></div>
            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Tipo de estabelecimento</h3></div>
                <div class="caixa-info__descricao  ">
                    <select class="caixa-info__input input--text" name="permitirTipoEstabelecimento" id="">
                        <option id="posto_check" value="Posto">Posto</option>
                        <option id="comando_check" value="Comando">Comando Municipal</option>
                    </select>
                </div>

            </div>
            <div class="caixa-info__item">
                <div class="caixa-info__cabecalho"><h3 >Escolher</h3></div>
                <div class="caixa-info__descricao  ">
                    <input  type="text" class="caixa-info__input input--text" placeholder="Comando Municipal do Talatona" id="selecionarComando" disabled>
                    <input  type="hidden" name="permitirComando"  value="1" hidden>
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

                        <option  value="<?php echo $id_posto?>"><?php echo "$tipo_extenso $nome"?></option>
                        
                    <?php endforeach;?>
                    </select>
                </div>
                </div>
            </div>
            
            <button type="submit" name="submit" value="Permitir" class="caixa-info__botao  btn btn-success mgt-10 ">Permitir Cadastro</button>
            <a href="<?php echo ROOT_URL; ?>agentes/cadastros" class="center-t btn btn-secondary mb-4 ">Voltar</a>

            <?php endforeach;?>
           

    </form>


