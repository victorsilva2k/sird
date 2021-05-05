<style>
    .agentes_nav {
        border-left: 3px solid var(--color-grey-dark-1);
        background-color: var(--color-grey-light-4);
    }
</style>
    <h1 class="titulo--normal no-border">Perfil</h1>
        <div  class="caixa-info br-25">

            <?php foreach($viewmodel as $item) : extract($item);?>
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



            <?php endforeach;?>



    </div>

    <a href="<?php echo ROOT_URL; ?>agentes/alterar/" class="  btn btn-primary mgt-10 ">Editar Perfil</a>
    <a href="<?php echo ROOT_URL; ?>agentes/editar/passe" class="  btn btn-primary mgt-10 ">Editar Palavra Passe</a>
    <a href="<?php echo ROOT_URL; ?>inicio/agente" class="  btn btn-secondary mgt-10 ">Voltar</a>
