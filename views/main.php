<?php if(!(isset($_SESSION['is_logged_in']))): ?>
    <style>
        .cabecalho--top {
            width: 100% !important;
            
        }

        .principal {
            margin-left: auto !important;
        }
    </style>
<?php endif;?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo ROOT_CSS; ?>main.css">
    <link rel="icon" href="<?php echo ROOT_IMG; ?>site/logo_pna.ico">


    <title>SIRD - PNA</title>
</head>

<body>

    <div class="modal">
    
    </div>
    
    <div class="conteudo">
        <?php if(isset($_SESSION['is_logged_in'])): ?>
            <nav class="barra-lateral">
                <div class="cabecalho__link-aplicacao">
                    
                    <!-- PARA O agente -->
                    
                    <a href="<?php echo ROOT_URL; ?>inicio/agente" class="cabecalho__link">
                        <div class="cabecalho__nav">
                            <img src="<?php echo ROOT_IMG; ?>site/logo_pna.png" alt="Aplicação" class="cabecalho__logo cabecalho__img">
                            <span class="cabecalho__nome-aplicacao">SIRD</span>
                        </div>
                    </a>
                    
                    <button class="cabecalho__botao btn-icone esconde-grande">
                        <svg class="cabecalho__icone icone--padrao">
                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-menu"></use> 
                        </svg>
                    </button>
                
                    
                
                </div>
                <div class="barra-lateral__navegacao">
                    <ul class="navegacao-lateral">
                        <li class="navegacao-lateral__item" id="documentos_nav">
                            <a href="<?php echo ROOT_URL; ?>documentos" class="navegacao-lateral__link">
                                <svg class="navegacao-lateral__icone">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-archive"></use>
                                </svg>
                                <span>Documentos</span>
                            </a>
                        </li>
                        <li class="navegacao-lateral__item" id="postos_nav">
                            <a href="<?php echo ROOT_URL; ?>postos" class="navegacao-lateral__link">
                                <svg class="navegacao-lateral__icone">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use>
                                </svg>
                                <span>Postos</span>
                            </a>
                        </li>

                        <?php if($_SESSION['usuario_local']['tipo_local'] === "comando"): ?>
                            <li class="navegacao-lateral__item" id="agentes_nav">
                                <a href="<?php echo ROOT_URL; ?>agentes" class="navegacao-lateral__link">
                                    <svg class="navegacao-lateral__icone">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-user"></use>
                                    </svg>
                                    <span>agentes</span>
                                </a>
                            </li>
                        <?php endif;?>
                        <li class="navegacao-lateral__item" id="comando_nav">
                            <a href="<?php echo ROOT_URL; ?>comando" class="navegacao-lateral__link">
                                <svg class="navegacao-lateral__icone">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-office"></use>
                                </svg>
                                <span>Comando Municipal</span>
                            </a>
                        </li>
                        <li class="navegacao-lateral__item mais-link" id="mais_nav">
                            <a href="<?php echo ROOT_URL; ?>mais" class="navegacao-lateral__link">
                                <svg class="navegacao-lateral__icone">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-plus"></use>
                                </svg>
                                <span>Mais</span>
                            </a>
                        </li>
                        <li class="navegacao-lateral__item">

                            <a href="<?php echo ROOT_URL; ?>documentos" class="center-t navegacao-lateral__link navegacao-lateral__botao  btn btn-success mb-4 ">Devolver</a>

                        </li>
                    </ul>

                    <ul class="navegacao-lateral">
                        <li class="navegacao-lateral__item">
                            <a href="<?php echo ROOT_URL; ?>agentes/sair" class="navegacao-lateral__link">
                                <svg class="navegacao-lateral__icone">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-arrow-left"></use>
                                </svg>
                                <span>Sair</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
      
        <?php endif;?>
        

        <main role="main" class=" main">
                <header class=" cabecalho--top">

                    <div class=" cabecalho">

                    
                        
                        <div class="cabecalho-direito cabecalho-direito__agente cont cont--side">
                            
                            <form class="pesquisa-form" action="<?php echo ROOT_URL; ?>documentos/pesquisar" method="get">
                                <input class="pesquisa-form__input input--text" type="text" name="pesquisar" id="" placeholder="Pesquisar por nome, BI, Número">
                                <button class="pesquisa-form__botao btn-icone">
                                    <svg class="pesquisa-form__icone  icone-padrao">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                                    </svg>
                                </button>
                                
                            </form> 
                            <div class="cabecalho-direito__links-direito">
                                
                            <a href="<?php echo ROOT_URL; ?>agentes/sair" class="cabecalho-direito__botao-menu esconde-grande" >
                                <!-- HACK -->
                                <svg class="cabecalho-direito__icone  icone-padrao">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-arrow-left"></use> 
                                </svg>
                            </a>
                            <div class="cabecalho-direito__links-2">
                                <a href="<?php echo ROOT_URL; ?>documentos/publicar" class="pesquisa-form__botao--normal btn btn-primary mb-4 ">Publicar</a>
                                <a href="<?php echo ROOT_URL; ?>agentes/perfil" class="cabecalho__link-usuario">
                                    <div class="cabecalho__nav cabecalho__usuario-nav mge-10">
                                        <?php
                                           if($_SESSION['usuario_local']['tipo_local'] === "comando"){
                                               $nivel = "Of. ";
                                           } else {
                                               $nivel = "Ag. ";
                                           } 
                                        ?>

                                        <span class="cabecalho__nome-usuario"><?php echo $nivel . $_SESSION['dados_usuario']['nome']; ?></span>
                                        <img src="<?php echo ROOT_IMG; ?>agentes/<?php echo $_SESSION['dados_usuario']['foto']; ?>" alt="Foto Usuário" class="cabecalho__foto-usuario cabecalho__img">
                                    </div>
                                </a>
                            </div>
                            </div>
                        </div>
                        <div class="barra-inferior__navegacao">
                        <ul class="navegacao-inferior">
                            <li class="navegacao-lateral__item" id="documentos_nav">
                                <a href="<?php echo ROOT_URL; ?>documentos" class="navegacao-inferior__link">
                                    <svg class="navegacao-inferior__icone">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-archive"></use>
                                    </svg>
                                    
                                </a>
                            </li>
                            <li class="navegacao-lateral__item" id="postos_nav">
                                <a href="<?php echo ROOT_URL; ?>postos" class="navegacao-inferior__link">
                                    <svg class="navegacao-inferior__icone">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use>
                                    </svg>
                                    
                                </a>
                            </li>

                            <?php if(($_SESSION['usuario_local']['tipo_local'] === "comando") AND !(isset($_SESSION['usuario_local']))): ?>
                                <li class="navegacao-lateral__item" id="agentes_nav">
                                    <a href="<?php echo ROOT_URL; ?>agentes" class="navegacao-inferior__link">
                                        <svg class="navegacao-inferior__icone">
                                            <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-user"></use>
                                        </svg>
                                        
                                    </a>
                                </li>
                            <?php endif;?>
                            <li class="navegacao-lateral__item" id="comando_nav">
                                <a href="<?php echo ROOT_URL; ?>comando" class="navegacao-inferior__link">
                                    <svg class="navegacao-inferior__icone">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-office"></use>
                                    </svg>
                                    
                                </a>
                            </li>
                            <li class="navegacao-lateral__item mais-link" id="mais_nav">
                                <a href="<?php echo ROOT_URL; ?>mais" class="navegacao-inferior__link">
                                    <svg class="navegacao-inferior__icone">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-plus"></use>
                                    </svg>
                                   
                                </a>
                            </li>

                        </ul>

                    </div>              
                            <div class="cabecalho-direito cabecalho-direito__cidadao cont cont--side">
                            <!-- PARA O CIDADÃO -->
                            <a href="<?php echo ROOT_URL; ?>cidadaos" class="pl-10">
                                <svg class="icone--padrao cabecalho-direito__icone">
                                    <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-home"></use>
                                </svg>

                            </a>
                            <form class="pesquisa-form" action="<?php echo ROOT_URL; ?>cidadaos/pesquisar" method="get">
                                <input class="pesquisa-form__input input--text" type="text" name="pesquisar" id="" placeholder="Pesquisar por nome, BI, Número">
                                <button class="pesquisa-form__botao btn-icone">
                                    <svg class="pesquisa-form__icone  icone-padrao">
                                        <use xlink:href="<?php echo ROOT_IMG; ?>site/sprite.svg#icon-search"></use> 
                                    </svg>
                                </button>
                                
                            </form> 

                            
                        </div>

                    </div>

                </header>
                
            
                
                <?php 
                echo '<div class="cont principal mgt-20 mgb-20">';
                
                Messages::displayMessage();
                require $view; 
                echo '</div>';
                ?>
            

        </main><!-- /.container -->
    </div>
</body>
<script src="<?php echo ROOT_JS; ?>app.js"></script>    
<script src="<?php echo ROOT_JS; ?>jquery-3.2.1.js"></script>
</html>